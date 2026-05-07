#!/bin/bash
# ----------------------------------------------------------------------------
# staging-deploy.sh
#
# ローカルPHPサーバー (http://localhost:8769) で動いている個別指導レビュー
# 現行サイトを wget でミラー → 静的HTML化 → Cloudflare Pages にデプロイする。
#
# 公開先: https://kobetsu-review-staging.pages.dev/  (noindex 厳守)
#
# 前提:
#   - ローカルPHPサーバーが localhost:8769 で起動していること
#       例) php -S localhost:8769 -t "<このスクリプトのあるディレクトリ>"
#   - wget が入っていること (brew install wget)
#   - ~/.zshrc に CLOUDFLARE_API_TOKEN が設定されていること
#
# 使い方:
#   bash staging-deploy.sh
# ----------------------------------------------------------------------------
set -euo pipefail

PROJECT_NAME="kobetsu-review-staging"
LOCAL_URL="http://localhost:8769"
STAGING_DIR="/tmp/${PROJECT_NAME}"
SOURCE_DIR="$(cd "$(dirname "$0")" && pwd)"

echo "==> source dir : ${SOURCE_DIR}"
echo "==> staging dir: ${STAGING_DIR}"
echo "==> project    : ${PROJECT_NAME}"
echo

# --------------------------------------------------------------------------
# Step 1: ローカルPHPサーバー起動確認
# --------------------------------------------------------------------------
echo "==> Step 1: localhost PHP server check"
if ! curl -fsS -o /dev/null "${LOCAL_URL}/"; then
  echo "ERROR: PHP server is not running at ${LOCAL_URL}"
  echo "Please start it first, e.g.:"
  echo "  php -S localhost:8769 -t \"${SOURCE_DIR}\""
  exit 1
fi
echo "    OK: ${LOCAL_URL}/ returned 200"
echo

# --------------------------------------------------------------------------
# Step 2: 既存の作業ディレクトリをクリーンアップ
# --------------------------------------------------------------------------
echo "==> Step 2: clean ${STAGING_DIR}"
rm -rf "${STAGING_DIR}"
mkdir -p "${STAGING_DIR}"
echo

# --------------------------------------------------------------------------
# Step 3: wget で再帰ミラー取得
#   - --mirror で再帰取得
#   - --adjust-extension で .php → .html 変換
#   - --convert-links で取得後リンクを相対化
#   - --reject で不要パターンを除外（クエリ付きURL、メールフォーム関連 等）
# --------------------------------------------------------------------------
echo "==> Step 3: wget mirror"
cd "${STAGING_DIR}"

# wget は個別アセットの 404（一部画像欠落など）でも exit code 8 を返すため、
# 「致命傷」と「個別404」を区別する。
# - exit 0: 全成功
# - exit 8: HTTP エラーありだが mirror は完了している（個別アセット欠落）
# - その他: 致命的（ネットワーク・ディスク・コマンド異常）
# Step 4 で rsync によるアセット補完を行うため、exit 8 は警告扱いで続行。
WGET_LOG="${STAGING_DIR}/.wget.log"
set +e
wget \
  --mirror \
  --page-requisites \
  --convert-links \
  --adjust-extension \
  --no-host-directories \
  --no-parent \
  --execute robots=off \
  --reject "*\\?*" \
  --reject "*.bak,*.bak.*" \
  --exclude-directories="/inquiry/mailformpro,/inquiry/include,/inquiry/config,/inquiry/postcodes,/inquiry/logs,/inquiry/commons,/inquiry/materials,/screenshots,/scss,/Templates,/nbproject" \
  -nv \
  -o "${WGET_LOG}" \
  "${LOCAL_URL}/"
WGET_RC=$?
set -e

if [ "${WGET_RC}" -eq 0 ]; then
  echo "    OK: mirror finished cleanly"
elif [ "${WGET_RC}" -eq 8 ]; then
  echo "    WARN: mirror finished with HTTP errors (exit 8). Listing 404s:"
  grep -E "404|エラー|error" "${WGET_LOG}" | head -10 | sed 's/^/      /' || true
  echo "    (continuing — Step 4 will compensate from source)"
else
  echo "ERROR: wget failed with exit code ${WGET_RC}. See ${WGET_LOG}"
  exit "${WGET_RC}"
fi
echo

# --------------------------------------------------------------------------
# Step 3.5: wget が拾い損ねた単発HTMLを直接取得
#   - koushu.html は JS で koushu.php にリダイレクトする静的スタブで、
#     どこからもリンクされていないため wget --mirror では取れない。
# --------------------------------------------------------------------------
echo "==> Step 3.5: fetch standalone html stubs"
EXTRA_PATHS=(
  "/course/koushu.html"
)
for p in "${EXTRA_PATHS[@]}"; do
  out_path="${STAGING_DIR}${p}"
  mkdir -p "$(dirname "${out_path}")"
  if curl -fsS -o "${out_path}" "${LOCAL_URL}${p}"; then
    echo "    OK: ${p}"
  else
    echo "    WARN: failed to fetch ${p}"
  fi
done
echo

# --------------------------------------------------------------------------
# Step 3.6: 拡張子整理 (*/index.php.html -> */index.html)
#   wget は "/about/index.php" を取得して "/about/index.php.html" に保存する。
#   Cloudflare Pages の自動ディレクトリインデックスは "/about/index.html" を
#   見るため、リネームしないと https://.../about/ が 404 になる。
#   さらに HTML 内の "index.php.html" / "index.php" 参照を
#   ディレクトリ末尾スラッシュ形式に統一する。
# --------------------------------------------------------------------------
echo "==> Step 3.6: rename *.php.html -> *.html and rewrite links"

# (1) index.php.html -> index.html （既存 index.html があれば上書きしない判断はせず、後勝ち）
while IFS= read -r -d '' f; do
  dir="$(dirname "${f}")"
  target="${dir}/index.html"
  # 既に index.html があり、それが今回 wget が出した同名ファイルなら問題ない（同じ内容のはず）
  if [ -f "${target}" ] && [ "${target}" != "${f}" ]; then
    # 同一なら index.php.html だけ消す
    if cmp -s "${target}" "${f}"; then
      rm -f "${f}"
      continue
    fi
  fi
  mv -f "${f}" "${target}"
done < <(find "${STAGING_DIR}" -type f -name "index.php.html" -print0)

# (2) その他 *.php.html (例: course/koushu.php.html) を *.html にリネーム
#     ※ wget が "course/koushu.php" を取得して "course/koushu.php.html" に保存。
#        URL `/course/koushu.php` と `/course/koushu.html` の両方を 200 で返したいので、
#        ・物理ファイルは `course/koushu.html` （素直な拡張子）
#        ・`course/koushu.php` -> `course/koushu.html` の `_redirects` を後段で出力
#     ただし、もし step 3.5 で取得した `koushu.html` （JS リダイレクトスタブ）と
#     名前衝突する場合は、衝突を避けるため koushu.php.html を koushu.php として残す。
while IFS= read -r -d '' f; do
  base="${f%.php.html}"          # /tmp/.../course/koushu
  if [ -f "${base}.html" ]; then
    # すでに .html がある（=スタブ）→ .php として保存（実体）
    mv -f "${f}" "${base}.php"
  else
    # スタブが無い場合は .html にする
    mv -f "${f}" "${base}.html"
  fi
done < <(find "${STAGING_DIR}" -type f -name "*.php.html" ! -name "index.php.html" -print0)

# (3) HTML 内のリンク書き換え：
#     "xxx/index.php.html" -> "xxx/"
#     "index.php.html"     -> "./"
#     "index.php"          -> "./"
#     "koushu.php.html"    -> "koushu.php"   (実体ファイル名に合わせる)
echo "    rewriting links in html files..."
while IFS= read -r -d '' html; do
  perl -i -pe '
    s|([\w/\.-]*)/index\.php\.html|$1/|g;       # foo/index.php.html -> foo/
    s|(?<![\w/])index\.php\.html|./|g;          # 単発 index.php.html -> ./
    s|(?<![\w/])index\.php(?!\w)|./|g;          # 単発 index.php -> ./
    s|([\w-]+)\.php\.html|$1.php|g;             # koushu.php.html -> koushu.php
  ' "${html}"
done < <(find "${STAGING_DIR}" -type f -name "*.html" -print0)

# (4) 残骸 *.php.html を掃除
find "${STAGING_DIR}" -type f -name "*.php.html" -delete

echo "    OK"
echo

# --------------------------------------------------------------------------
# Step 4: 必要な静的アセットをソースから補完コピー
#   wget は HTML から参照されているリソースしか取得しないため、
#   ヘッダー/フッターから動的に出力される画像・CSS・JS が
#   万一抜けていてもここで救う。
# --------------------------------------------------------------------------
echo "==> Step 4: rsync static assets from source"

# 画像（.php や .bak はコピーしない）
if [ -d "${SOURCE_DIR}/images" ]; then
  rsync -a \
    --exclude="*.php" \
    --exclude="*.bak" \
    --exclude="*.bak.*" \
    --exclude=".DS_Store" \
    --exclude="screenshots/" \
    "${SOURCE_DIR}/images/" "${STAGING_DIR}/images/"
fi

# CSS / JS
[ -d "${SOURCE_DIR}/css" ] && rsync -a --exclude=".DS_Store" "${SOURCE_DIR}/css/" "${STAGING_DIR}/css/"
[ -d "${SOURCE_DIR}/js"  ] && rsync -a --exclude=".DS_Store" "${SOURCE_DIR}/js/"  "${STAGING_DIR}/js/"

# mp4 — Cloudflare Pages は 1 ファイル 25MiB 超の配信ができないため、
#       25MiB 超は配置しない（wget が落としたファイルがあれば削除する）。
#       HTML 側で video src を書き換えて
#       本番 (https://kobetsu-review.com/mp4/...) を参照させる。
if [ -d "${SOURCE_DIR}/mp4" ]; then
  mkdir -p "${STAGING_DIR}/mp4"
  # まず staging 上の 25MiB 超 mp4 を削除（wget で落ちている可能性）
  while IFS= read -r -d '' mp4; do
    base="$(basename "${mp4}")"
    size_bytes=$(stat -f%z "${mp4}")
    if [ "${size_bytes}" -gt $((25 * 1024 * 1024)) ]; then
      echo "    REMOVE (>25MiB): mp4/${base}"
      rm -f "${mp4}"
    fi
  done < <(find "${STAGING_DIR}/mp4" -maxdepth 1 -type f -name "*.mp4" -print0)

  # 続いてソースから不足分を補完
  while IFS= read -r -d '' mp4; do
    base="$(basename "${mp4}")"
    size_bytes=$(stat -f%z "${mp4}")
    if [ "${size_bytes}" -gt $((25 * 1024 * 1024)) ]; then
      echo "    SKIP   (>25MiB): mp4/${base}  → 本番URLにフォールバック予定"
    else
      [ -f "${STAGING_DIR}/mp4/${base}" ] || cp -p "${mp4}" "${STAGING_DIR}/mp4/${base}"
    fi
  done < <(find "${SOURCE_DIR}/mp4" -maxdepth 1 -type f -name "*.mp4" -print0)
fi

# favicon
[ -f "${SOURCE_DIR}/favicon.ico" ] && cp -p "${SOURCE_DIR}/favicon.ico" "${STAGING_DIR}/favicon.ico"

# inquiry セクションの静的アセット（画像のみ）
if [ -d "${SOURCE_DIR}/inquiry/images" ]; then
  rsync -a --exclude=".DS_Store" "${SOURCE_DIR}/inquiry/images/" "${STAGING_DIR}/inquiry/images/"
fi

echo "    OK: assets synced"
echo

# --------------------------------------------------------------------------
# Step 4.4: 25MiB超で staging に置けなかった mp4 を本番ドメインにフォールバック
# --------------------------------------------------------------------------
echo "==> Step 4.4: rewrite oversized mp4 references to production domain"
PROD_BASE="https://kobetsu-review.com"
if [ -d "${SOURCE_DIR}/mp4" ]; then
  while IFS= read -r -d '' mp4; do
    base="$(basename "${mp4}")"
    if [ ! -f "${STAGING_DIR}/mp4/${base}" ]; then
      # 該当 mp4 を staging に置けていない → HTML の参照を本番URLに置換
      # 相対参照例: src="../mp4/xxx.mp4" / src="mp4/xxx.mp4" / href="/mp4/xxx.mp4"
      while IFS= read -r -d '' html; do
        perl -i -pe "s|(\\.\\./)?mp4/${base}|${PROD_BASE}/mp4/${base}|g" "${html}"
      done < <(find "${STAGING_DIR}" -type f -name "*.html" -print0)
      echo "    rewrote refs to ${base} -> ${PROD_BASE}/mp4/${base}"
    fi
  done < <(find "${SOURCE_DIR}/mp4" -maxdepth 1 -type f -name "*.mp4" -print0)
fi
echo

# --------------------------------------------------------------------------
# Step 4.5: Cloudflare Pages 用ヘッダー / リダイレクト
#
# (A) _headers
#   - 全レスポンスに X-Robots-Tag: noindex, nofollow を返す（noindex 二重防御）
#   - .php / .htm / .html 全てに text/html; charset=utf-8 を明示
#
# (B) _redirects
#   - /index.php       -> /          (301)
#   - /xxx/index.php   -> /xxx/      (301)
#   - /course/koushu.php (ファイルとして残しておくが、200 を返したい場合は
#     Cloudflare Pages がそのまま静的に配信する。
#     ただし .php は Pages 側で text/html を勝手につけないため、
#     _headers で Content-Type を指定している)
# --------------------------------------------------------------------------
echo "==> Step 4.5: write _headers / _redirects"

cat > "${STAGING_DIR}/_headers" <<'EOF'
/*
  X-Robots-Tag: noindex, nofollow

/*.php
  Content-Type: text/html; charset=utf-8

/*.html
  Content-Type: text/html; charset=utf-8
EOF

cat > "${STAGING_DIR}/_redirects" <<'EOF'
# index.php → ディレクトリ末尾スラッシュ
/index.php             /                301
/about/index.php       /about/          301
/course/index.php      /course/         301
/program/index.php     /program/        301
/charge/index.php      /charge/         301
/access/index.php      /access/         301
/inquiry/index.php     /inquiry/        301
/privacy/index.php     /privacy/        301
EOF

echo "    OK"
echo

# --------------------------------------------------------------------------
# Step 5: noindex 設定（robots.txt）
# --------------------------------------------------------------------------
echo "==> Step 5: write robots.txt (Disallow: /)"
cat > "${STAGING_DIR}/robots.txt" <<'EOF'
User-agent: *
Disallow: /
EOF
echo

# --------------------------------------------------------------------------
# Step 6: 全HTMLに <meta name="robots" content="noindex,nofollow"> を追加
#   既に robots metaタグがある場合は重複させない。
# --------------------------------------------------------------------------
echo "==> Step 6: inject <meta name=\"robots\" content=\"noindex,nofollow\">"
INJECTED_COUNT=0
while IFS= read -r -d '' html; do
  if grep -q 'name="robots"' "${html}"; then
    # 既存の robots metaタグを noindex,nofollow に置換
    perl -i -pe 's|<meta\s+name="robots"[^>]*>|<meta name="robots" content="noindex,nofollow">|i' "${html}"
  else
    # </head> の直前に挿入
    perl -i -pe 's|</head>|<meta name="robots" content="noindex,nofollow"></head>|i' "${html}"
  fi
  INJECTED_COUNT=$((INJECTED_COUNT + 1))
done < <(find "${STAGING_DIR}" -name "*.html" -print0)
echo "    OK: processed ${INJECTED_COUNT} html files"
echo

# --------------------------------------------------------------------------
# Step 7: Cloudflare Pages デプロイ
#   - プロジェクトが無ければ作成
#   - その後 deploy
# --------------------------------------------------------------------------
echo "==> Step 7: Cloudflare Pages deploy"

# 念のため zshrc から API Token を読み込む
# 注：zshrc 内に bun completion 等の bash 非互換構文があると `source` が失敗するため、
#     export 行だけを抽出して eval する方式にしている。
if [ -z "${CLOUDFLARE_API_TOKEN:-}" ] && [ -f "${HOME}/.zshrc" ]; then
  CFTOKEN_LINE="$(grep -E '^[[:space:]]*export[[:space:]]+CLOUDFLARE_API_TOKEN=' "${HOME}/.zshrc" | tail -1 || true)"
  if [ -n "${CFTOKEN_LINE}" ]; then
    eval "${CFTOKEN_LINE}"
  fi
fi

if [ -z "${CLOUDFLARE_API_TOKEN:-}" ]; then
  echo "ERROR: CLOUDFLARE_API_TOKEN is not set."
  echo "Please add it to ~/.zshrc and re-run: export CLOUDFLARE_API_TOKEN=..."
  exit 1
fi

# プロジェクト存在確認（テーブル形式の行のどこかに ${PROJECT_NAME} が現れるかどうか）
PROJECT_LIST_OUT="$(npx --yes wrangler pages project list 2>&1 || true)"
if ! printf '%s' "${PROJECT_LIST_OUT}" | grep -qE "[[:space:]]${PROJECT_NAME}[[:space:]]"; then
  echo "    project not found, creating: ${PROJECT_NAME}"
  npx --yes wrangler pages project create "${PROJECT_NAME}" \
    --production-branch main
else
  echo "    project already exists: ${PROJECT_NAME}"
fi

cd "${STAGING_DIR}"
npx --yes wrangler pages deploy . \
  --project-name="${PROJECT_NAME}" \
  --branch=main \
  --commit-dirty=true \
  --commit-message="staging snapshot $(date +%Y%m%d-%H%M%S)"

echo
echo "==> Deploy complete: https://${PROJECT_NAME}.pages.dev/"

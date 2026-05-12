<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ペルソナ攻略 | ゲーム攻略アプリ</title>
  <meta name="description" content="ゲーム攻略アプリのペルソナ攻略ページ。ダークでスタイリッシュなUIで弱点、スキル、合体ルートを素早く確認できます。" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Noto+Sans+JP:wght@400;700;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <main class="persona-page">
    <section class="hero" aria-labelledby="page-title">
      <div class="hero__slashes" aria-hidden="true"></div>
      <header class="hero__nav">
        <a class="hero__logo" href="../index.php" aria-label="トップページへ戻る">GUIDE<span>PHANTOM</span></a>
        <nav class="hero__links" aria-label="ページ内ナビゲーション">
          <a href="#profile">PROFILE</a>
          <a href="#weakness">WEAKNESS</a>
          <a href="#route">ROUTE</a>
        </nav>
      </header>

      <div class="hero__content">
        <p class="hero__eyebrow">GAME GUIDE APP / PERSONA FILE</p>
        <h1 id="page-title">ペルソナ攻略<br /><span>怪盗ログ</span></h1>
        <p class="hero__lead">赤・黒・白の強いコントラスト、斜めのカード、コミック調の見出しで、ペルソナらしいスピード感のある攻略ページに刷新しました。</p>
        <div class="hero__actions">
          <a class="button button--primary" href="#weakness">弱点を確認</a>
          <a class="button button--ghost" href="#route">合体ルートへ</a>
        </div>
      </div>

      <aside class="hero__card" aria-label="注目ペルソナ情報">
        <p class="hero__card-kicker">TODAY'S TARGET</p>
        <h2>ARSENE</h2>
        <dl>
          <div>
            <dt>ARCANA</dt>
            <dd>愚者</dd>
          </div>
          <div>
            <dt>ROLE</dt>
            <dd>初期アタッカー</dd>
          </div>
          <div>
            <dt>KEY SKILL</dt>
            <dd>呪怨 / 物理</dd>
          </div>
        </dl>
      </aside>
    </section>

    <section id="profile" class="section section--profile" aria-labelledby="profile-title">
      <div class="section__heading">
        <span>01</span>
        <h2 id="profile-title">PROFILE</h2>
      </div>
      <div class="profile-grid">
        <article class="profile-card profile-card--featured">
          <p class="tag">おすすめ運用</p>
          <h3>序盤は状態異常と先制攻撃で流れを作る</h3>
          <p>探索前に習得スキル、耐性、入手ルートをひと目で比較できるよう、情報をカード化。攻略アプリ上でもタップしやすい余白を確保しています。</p>
        </article>
        <article class="profile-card">
          <p class="tag">LV</p>
          <strong>1 - 99</strong>
          <span>成長段階を素早く確認</span>
        </article>
        <article class="profile-card">
          <p class="tag">STYLE</p>
          <strong>AGILE</strong>
          <span>スピード重視の編成向け</span>
        </article>
      </div>
    </section>

    <section id="weakness" class="section section--dark" aria-labelledby="weakness-title">
      <div class="section__heading section__heading--light">
        <span>02</span>
        <h2 id="weakness-title">WEAKNESS CHECK</h2>
      </div>
      <div class="weakness-board" role="list" aria-label="属性相性一覧">
        <div class="weakness-cell weakness-cell--resist" role="listitem"><span>物</span><strong>耐</strong></div>
        <div class="weakness-cell" role="listitem"><span>銃</span><strong>-</strong></div>
        <div class="weakness-cell weakness-cell--weak" role="listitem"><span>氷</span><strong>弱</strong></div>
        <div class="weakness-cell" role="listitem"><span>電</span><strong>-</strong></div>
        <div class="weakness-cell weakness-cell--block" role="listitem"><span>呪</span><strong>無</strong></div>
        <div class="weakness-cell weakness-cell--weak" role="listitem"><span>祝</span><strong>弱</strong></div>
      </div>
      <p class="note">弱点セルは赤い警告表示、耐性セルは黒地の反転表示にして、バトル直前でも見落としにくいUIにしています。</p>
    </section>

    <section id="route" class="section" aria-labelledby="route-title">
      <div class="section__heading">
        <span>03</span>
        <h2 id="route-title">FUSION ROUTE</h2>
      </div>
      <ol class="route-list">
        <li>
          <span>STEP 1</span>
          <strong>素材ペルソナを選択</strong>
          <p>所持済み・未所持を切り替えながら候補を絞り込みます。</p>
        </li>
        <li>
          <span>STEP 2</span>
          <strong>継承スキルを確認</strong>
          <p>使いたい属性をピン留めして、候補カードを比較します。</p>
        </li>
        <li>
          <span>STEP 3</span>
          <strong>完成ビルドを保存</strong>
          <p>周回やボス戦に合わせたビルドメモとして保存できます。</p>
        </li>
      </ol>
    </section>
  </main>
</body>
</html>

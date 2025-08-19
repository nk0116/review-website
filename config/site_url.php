<?php
// config/site_url.php
if (!function_exists('get_site_url')) {
  function get_site_url(): string {
    $host = $_SERVER['HTTP_HOST'] ?? '';

    // ローカル判定：localhost, 127.0.0.1, review.local をローカル扱い
    $isLocal =
      preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/i', $host) ||
      preg_match('/^review\.local(:\d+)?$/i', $host);

    if ($isLocal) {
      // ローカルはルート相対で動かす（コードを本番と共通に保ちやすい）
      return '/';
    }

    // 既存のステージング／別環境
    if (stripos($host, 'sunplads.onamaeweb.jp') !== false) {
      return 'https://sunplads.onamaeweb.jp/test_up/okayama/kobetsu-review.com/';
    }
    if (stripos($host, 'kobetsu-review-com.sunplads-staging.com') !== false) {
      return 'https://kobetsu-review-com.sunplads-staging.com/';
    }
    if (stripos($host, 'web-pack.jp') !== false) {
      return 'http://kobetsu-review.web-pack.jp/';
    }

    // デフォルト：本番
    return 'https://kobetsu-review.com/';
  }
}

$siteUrl = get_site_url(); // 末尾に / が付いたURL（ローカルは "/"）
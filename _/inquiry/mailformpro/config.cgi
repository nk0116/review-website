## 2009-03-31 mailform pro Ver.2.x.x config file

##スクリプトのURL / ※基本的にここは変更しなくてOKです
$config{"url"} = 'http://' . $ENV{'SERVER_NAME'} . $ENV{'SCRIPT_NAME'};

##リファラードメインチェック / ドメインチェックをしない場合は行頭に半角＃を入れてください
$config{"domain"} = $ENV{'HTTP_HOST'};

##全文英語のスパム候補を除外(0:除外 / 1:除外しない)
$config{"english_spam"} = 0;

##リンク系スパム候補を除外(0:除外 / 1:除外しない)
$config{"link_spam"} = 0;

##sendmailのパス
$config{"sendmail"} = '/usr/lib/sendmail';

##フォームからの送信先 設定したほうの先頭の#を削除してください
# ひとつの場合
@mailto = ('review@x.gmobb.jp');
# 複数の場合 (シングルクォートでくくったメールアドレスをカンマで区切って指定)
#@mailto = ('xxxxx@example.jp','yyyyy@example.jp');

##フォームからの差出人
$config{"mailfrom"} = $mailto[0];

##フォームの差出人名
$config{"fromname"} = '個別指導レビュー総社駅前校【お問い合わせ】';

##サンクスページのURL
$config{"thanks_url"} = '../thanks.html';

##サンクスページに通し番号を渡す(1:ON / 0:OFF)
$config{"thanks_serial"} = 1;

##入力時間の平均時間をHTMLに表示する場合の書式
$config{"input_time_format"} = '<p>このフォームの入力にはおおよそ <strong><avg></strong> 程度掛かります。</p>';

##自動返信メールに通し番号を付けるかどうか(1:つける / 0:つけない)
$config{"return_subject_serial"} = 1;

##通し番号に日付を付けるかどうか(1:つける / 0:つけない)
$config{"return_subject_serial_date"} = 1;

##ログファイルのパス
#$config{"log_file"} = 'postlog.cgi';

##ログファイルのパスワード
#$config{"password"} = 'password';

##送信有効期限 ※有効期限を設定する場合はエラーページを用意して下さい。
##期限の書式は YYYY-MM-DD HH:MM:SS です。
##受付開始日時
#$config{"expires_break"} = '2009-01-22 06:21:00';
##受付終了日時
#$config{"expires"} = '2009-03-22 06:30:00';

##送信有効期限をHTMLに表示する場合の書式
$config{"expires_time_format"} = '<p class="expires">このフォームは <strong><expires></strong> で締め切りとさせて頂きます。</p>';
$config{"expires_time_timeout"} = '<p class="expires">このフォームの送信は <expires> で既に締め切りました。</p>';
$config{"expires_time_break"} = '<p class="expires">このフォームからのご応募は <expires> から開始いたします。</p>';

##送信数制限 ※送信数制限を設定する場合はエラーページを用意して下さい。
#$config{"limit"} = 100;

##送信数制限をHTMLに表示する場合の書式
$config{"limit_format"} = '<p class="limit">残り応募数はあと <strong><limit></strong> 枠です。</p>';
$config{"limit_over"} = '<p class="limit"><strong>このフォームの応募数を超えました。</strong></p>';

##エラーページURL
#$config{"error_url"} = 'http://cgi.synck.com/mailform/pro2.0.0/error.html';

##設置者に届くメールの件名
$config{"subject"} = '個別指導レビュー総社駅前校ホームページ【お問い合わせ】より';

##設置者に届くメールの本文整形 / 自動生成の場合 NULL / 特殊整形文字 <resbody>:送信内容一式 / <date>:日付 / <serial>:通し番号 / <input_time>:入力秒
$config{"posted_body"} = <<'__posted_body__';
<date>
お問い合わせフォームより以下のメールを受付ました。
────────────────────────────────────
受付番号：<serial>
入力時間：<input_time>
　送信元：<http_referer>
<resbody>
────────────────────────────────────

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

個別指導レビュー総社駅前校

〒 719-1136
岡山県総社市駅前2-2-10 新世紀観光ビル2F
電話：0866-95-2100
Email:review@x.gmobb.jp

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
__posted_body__

##送信者に届く自動返信メールの件名
$config{"return_subject"} = 'お問い合わせいただき、ありがとうございました';

##送信者に届く自動返信メールの本文 / 特殊整形文字 <resbody>:送信内容一式 / <date>:日付 / <serial>:通し番号 / <input_time>:入力秒
$config{"return_body"} = <<'__return_body__';
<お名前> 様
────────────────────────────────────

この度はお問い合わせいただき、誠にありがとうございました。
改めて担当者よりご連絡をさせていただきます。

─ご送信内容の確認───────────────────────────
受付番号：<serial>
<resbody>
────────────────────────────────────

このメールに心当たりの無い場合は、お手数ですが
下記連絡先までお問い合わせください。


━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

個別指導レビュー総社駅前校

〒 719-1136
岡山県総社市駅前2-2-10 新世紀観光ビル2F
電話：0866-95-2100
Email:review@x.gmobb.jp

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
__return_body__

##件名につける通し番号用ファイル
$config{"serial_file"} = 'serial.dat';

##入力時間の合計を記憶するファイル
$config{"input_time_file"} = 'time.dat';

##コンバージョンレート算出用ログファイル
$config{"conversion_file"} = 'unique.dat';


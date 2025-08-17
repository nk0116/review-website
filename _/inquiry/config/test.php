<?php

mb_language("japanese");
mb_internal_encoding("UTF-8");

//ソースを全部読み込ませる
//パスは自分がPHPMailerをインストールした場所で
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/POP3.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/OAuth.php';
require 'PHPMailer/language/phpmailer.lang-ja.php';

//公式通り
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//メール本体
mb_language("Japanese");
mb_internal_encoding("UTF-8");
$mailer = new PHPMailer();//インスタンス生成
$mailer->IsSMTP();//SMTPを作成
$mailer->Host = 'smtp.hetemail.jp';//Cloud Gate UNO
$mailer->CharSet = 'utf-8';//文字セットこれでOK
$mailer->SMTPAuth = TRUE;//SMTP認証を有効にする

$mailer->SMTPSecure = '';//SSLも使えると公式で言ってます
$mailer->Port = 587;//cloud gate uno
$mailer->SMTPDebug = 1;//2は詳細デバッグ1は簡易デバッグ本番はコメントアウトして
$mailer->Username='info@kobetsu-review.com';
$mailer->Password='A8NFQbHTW4gsAu';

$mailer->setFrom('ds-maildebug@sunpla.com', mb_encode_mimeheader('送信テスト'));  
$mailer->Subject  = mb_convert_encoding('送信テスト',"UTF-8","AUTO");//件名の設定
$mailer->Body     = mb_convert_encoding('送信テストです',"UTF-8","AUTO");//メッセージ本体
$mailer->AddAddress('ds-maildebug@sunpla.com');

//送信する
if($mailer->Send()){}

else{
 echo "<BR><BR><font color=red>送信に失敗しました</font><BR><BR><BR>" . $mailer->ErrorInfo;
}

?>
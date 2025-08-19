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

include 'form_validation.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$form_Url = 'index.html';//本番用

$kengakuAdult =[
    '大人'=>'大人','1名'=>'1名','2名'=>'2名','3名'=>'3名','4名'=>'4名','5名'=>'5名','6名'=>'6名'
];
$kengakuChild =[
    '小人'=>'小人','0名'=>'0名','1名'=>'1名','2名'=>'2名','3名'=>'3名','4名'=>'4名','5名'=>'5名','6名'=>'6名'
];
$kengakuTime = [
    'ご希望の時間帯'=>'ご希望の時間帯',
    '10:00～12:00'=>'10:00～12:00',
    '13:00～15:00'=>'13:00～15:00',
    '15:00～17:00'=>'15:00～17:00'
];
$yosan = [
    'ご希望の予算'=>'ご希望の予算',
    '～4,000万円'=>'～4,000万円',
    '～4,500万円'=>'～4,500万円',
    '～5,000万円'=>'～5,000万円',
    '～5,500万円'=>'～5,500万円',
    '～6,000万円'=>'～6,000万円',
    '～6,500万円'=>'～6,500万円',
];

$month =[
    '選択してください'=>'','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12'
];
$day = [
    '選択してください'=>'','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12',
    '13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24',
    '25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31',
];
$pref = [
''=>'選択してください。','北海道'=>'北海道','青森県'=>'青森県','岩手県'=>'岩手県',
'宮城県'=>'宮城県','秋田県'=>'秋田県','山形県'=>'山形県','福島県'=>'福島県',
'茨城県'=>'茨城県','栃木県'=>'栃木県','群馬県'=>'群馬県','埼玉県'=>'埼玉県',
'千葉県'=>'千葉県','東京都'=>'東京都','神奈川県'=>'神奈川県','新潟県'=>'新潟県',
'富山県'=>'富山県','石川県'=>'石川県','福井県'=>'福井県','山梨県'=>'山梨県',
'長野県'=>'長野県','岐阜県'=>'岐阜県','静岡県'=>'静岡県','愛知県'=>'愛知県',
'三重県'=>'三重県','滋賀県'=>'滋賀県','京都府'=>'京都府','大阪府'=>'大阪府',
'兵庫県'=>'兵庫県','奈良県'=>'奈良県','和歌山県'=>'和歌山県','鳥取県'=>'鳥取県',
'島根県'=>'島根県','岡山県'=>'岡山県','広島県'=>'広島県','山口県'=>'山口県',
'徳島県'=>'徳島県','香川県'=>'香川県','愛媛県'=>'愛媛県','高知県'=>'高知県',
'福岡県'=>'福岡県','佐賀県'=>'佐賀県','長崎県'=>'長崎県','熊本県'=>'熊本県',
'大分県'=>'大分県','宮崎県'=>'宮崎県','鹿児島県'=>'鹿児島県','沖縄県'=>'沖縄県'
];

$subdivisionName = [
    'akashimatsukageyamate' => 'スマートテラス明石松陰山手',
    'nishiakashi' => 'スマートテラス西明石',
];
$Formsubdivision = [
    'スマートテラス明石松陰山手' => 'スマートテラス明石松陰山手',
    'スマートテラス西明石' => 'スマートテラス西明石',
];
$genreName = [
    '1' => '現地見学予約',
    '2' => '資料請求',
];

$formGenreName = [
    '現地見学予約' => '現地見学予約',
    '資料請求' => '資料請求',
];


class FormSettings {
    use FormValidation;
    public $PostData;
    public $FormStep;
    public $Url;
    public function __construct($postdata,$FormStep=0){
        global $form_Url;
        $this->Url = $form_Url;
        $code = substr(mt_rand(10000, 19999), 1, 4);
        $this->receptionNumber = date('Ymd').$code;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!empty($postdata) and is_array($postdata)){
                foreach ($postdata as $key => $val):
                    if(!empty($val) and is_array($val)):
                        foreach ($val as $key2 => $val2):
                            $this->PostData[$key] = filter_input(INPUT_POST, $key, FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
                        endforeach;
                    else:
                        $this->PostData[$key] = filter_input(INPUT_POST, $key);
                    endif;
                endforeach;
            }
            //
            $this->FormStep = $FormStep;
            $this->FormDataSet();
        }
        else {
            if($FormStep===0 ){

            }else {
                header('Location: ' . $this->Url, true , 301);
                exit();
            }

        }
    }
    public function generateCode($length)
    {
        $max = pow(10, $length) - 1;                    // コードの最大値算出
        $rand = random_int(0, $max);                    // 乱数生成
        $code = sprintf('%0'. $length. 'd', $rand);     // 乱数の頭0埋め

        return $code;
    }
    protected function FormDataSet(){
        if($this->FormStep===0){
        }
        else if($this->FormStep===1) {
            if($_POST['csrf'] === $_SESSION['csrf_token']){
                $this->FormReatrunBox();

            }
            else {
                header('Location: ' . $this->Url, true , 301);
               exit();
            }
        }
        else if($this->FormStep===3) {
            if($_POST['csrfthanks'] === $_SESSION['csrf_token_thanks']){
                $this->FormReatrunBox();
            }
            else {
                header('Location: ' . $this->Url, true , 301);
                exit();
            }
        }
        else{

        }
    }
    private function FormReatrunBox() {
        if(!empty($this->PostData) and is_array($this->PostData)){
            foreach ($this->PostData as $key => $val):
                if(!empty($val) and is_array($val)){
                    foreach ($val as $key2 => $val2){
                        $this->form_data[$key][$key2] = $this->FormDataSets($val2);
                    }
                }else {
                    $this->form_data[$key] = $this->FormDataSets($val);
                }
            endforeach;
            $this->ValidationCheack();
        }
    }
    private function FormDataSets($string = 0) {
        if(!empty($string) and !is_array($string)){
            $string = strip_tags($string);
            $string = preg_replace("/<script.*<\/script>/", "", $string) ;
            $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
            return $string;
        }
    }
    public function FormDataBack(){
        if(!empty($this->form_data) and is_array($this->form_data)){
            foreach ($this->form_data as $key => $val):
                if(!empty($val) and is_array($val)){//チェックボックスどうかをチェックする。
                    foreach ($val as $key2 => $val2){
                        ?>
<input type="hidden" name="<?php echo $key; ?>[<?php echo $key2; ?>]" value="<?php echo $val2; ?>">
<?php
                    }
                }else{//チェックボックス以外。
                    if($key==='csrf'){
                    }else{
                        ?>
<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>">
<?php
                    }
                }
            endforeach;
        }
    }
}


class sendmailcl extends FormSettings {


    private $MailUserTitle;//ユーザーにメールが届いた時の差出人名
    private $MailAddminTitle;
    private $MailUserHeader;//ユーザーに届いた際返信する先のアドレス。
    private $MailAddminAddress;
    private $CommonMailBody;
    private $UserMailBody;
    private $AddminMailBody;
    public $SendMailErr;
    public function sendmail_chack() {
        if($this->FormStep===3 and $this->form_data['csrfthanks'] === $_SESSION['csrf_token_thanks']){
            $this->send_mail_config_setting();
        }else {
            header('Location: ' . $this->Url, true , 301);
            exit();
        }
    }


    private function send_mail_config_setting() {
        $this->MailUserTitle = 'お問い合わせありがとうございました';//【要変更】ユーザー宛メールの題名
        $this->MailUserHeader = "From:review@x.gmobb.jp";//【要変更】ユーザー宛メール差出人（差出人名・メールアドレス設定）

        $this->MailAddminTitle = $this->PostData['name'].'様よりお問い合わせ賜りました';//【要変更】管理者宛メールの題名
        $this->MailAddminAddress = array('review@x.gmobb.jp','ds-maildebug@sunpla.com');//【要変更】管理人用送り先メールアドレス
        $this->UserMailBody_settings();
        $this->AddminMailBody_settings();

        $this->sendmail();
    }

    private function UserMailBody_settings(){
        $this->UserMailBody = '＜自動返信メール＞'.PHP_EOL.PHP_EOL;
        $this->UserMailBody .= 'この度は、当社ウェブサイトよりお問い合わせいただき誠にありがとうございます。'.PHP_EOL;
        $this->UserMailBody .= '以下の内容で受付いたしました。内容を確認後、弊社担当者よりご連絡をさせていただきます。'.PHP_EOL;
        $this->UserMailBody .= PHP_EOL;
        $this->UserMailBody .= $this->same_mail_body();
        $this->UserMailBody .= PHP_EOL;
        $this->UserMailBody .= "--------------------------------------------------------".PHP_EOL;
        $this->UserMailBody .= "個別指導レビュー 総社駅前校".PHP_EOL;
        $this->UserMailBody .= "〒719-1136".PHP_EOL;
        $this->UserMailBody .= "岡山県総社市駅前2-2-10新世紀観光ビル2F".PHP_EOL;
        $this->UserMailBody .= "TEL：0866-95-2100".PHP_EOL;
        $this->UserMailBody .= PHP_EOL;
        $this->UserMailBody .= "オフィシャルサイト".PHP_EOL;
        $this->UserMailBody .= "https://www.kobetsu-review.com/".PHP_EOL;
        $this->UserMailBody .= "--------------------------------------------------------".PHP_EOL;
        $this->UserMailBody .= "※機種依存文字を入力された場合、送信内容が文字化けする可能性がございます。その場合は、再度フォームよりお問い合わせをお願いいたします。".PHP_EOL;
    }
    private function AddminMailBody_settings(){
        $referer = $_SERVER['HTTP_REFERER'];
        $url = parse_url($referer);
        $host = $url['host'];
        $this->AddminMailBody = '＜管理者様宛メール＞'.PHP_EOL.PHP_EOL;
        $this->AddminMailBody .= $this->form_data['name'].'様よりお問い合わせを賜りました。'.PHP_EOL;
        $this->AddminMailBody .= 'ご対応をお願い致します。'.PHP_EOL.PHP_EOL;
        $this->AddminMailBody .= '以下、問い合わせ内容です。'.PHP_EOL;
        $this->AddminMailBody .= PHP_EOL;
        $this->AddminMailBody .= $this->same_mail_body();
        $this->AddminMailBody .= PHP_EOL;
        $this->AddminMailBody .= "--------------------------------------------------------".PHP_EOL;
        $this->AddminMailBody .= "個別指導レビュー 総社駅前校".PHP_EOL;
        $this->AddminMailBody .= "https://www.kobetsu-review.com/".PHP_EOL;
        $this->AddminMailBody .= "--------------------------------------------------------".PHP_EOL;
        $this->AddminMailBody .= "※機種依存文字を入力された場合、送信内容が文字化けする可能性がございます。その場合は、再度フォームよりお問い合わせをお願いいたします。".PHP_EOL;
    }
    private function same_mail_body() {
        $mail_body = "----------------------------------------".PHP_EOL;

        if(!empty($this->PostData['name'])):
            $mail_body .= "【お名前】\n".$this->PostData['name']."".PHP_EOL.PHP_EOL;
        endif;

        if(!empty($this->PostData['prefectures'])):
            $mail_body .= "【都道府県】\n".$this->PostData['prefectures']."".PHP_EOL.PHP_EOL;
        endif;

                if(!empty($this->PostData['prefectures'])):
            $mail_body .= "【都道府県】\n".$this->PostData['prefectures']."".PHP_EOL.PHP_EOL;
        endif;

                if(!empty($this->PostData['city'])):
            $mail_body .= "【市町村】\n".$this->PostData['city']."".PHP_EOL.PHP_EOL;
        endif;

        if(!empty($this->PostData['address'])):
            $mail_body .= "【それ以降の住所】\n".$this->PostData['address']."".PHP_EOL.PHP_EOL;
        endif;



        if(!empty($this->PostData['mobiletel'])):
            $mail_body .= "【携帯番号】\n".$this->PostData['mobiletel']."".PHP_EOL.PHP_EOL;
        endif;

        if(!empty($this->PostData['email'])):
            $mail_body .= "【メールアドレス】\n".$this->PostData['email']."".PHP_EOL.PHP_EOL;
        endif;

        if(!empty($this->PostData['contact'])):
            $mail_body .= "【内容】\n".$this->PostData['contact']."".PHP_EOL.PHP_EOL;
        endif;

        if(!empty($this->PostData['biko'])):
            $mail_body .= "【備考】\n".$this->PostData['biko']."".PHP_EOL.PHP_EOL;
        endif;

        return $mail_body;
    }
   private function sendmail() {
        //ユーザー宛用
        $this->SendMailErr =0;
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $mailer = new PHPMailer();//インスタンス生成
        $mailer->IsSMTP();//SMTPを作成
        $mailer->Host = 'smtp.hetemail.jp';//Cloud Gate UNO
        $mailer->CharSet = 'utf-8';//文字セットこれでOK
        $mailer->SMTPAuth = TRUE;//SMTP認証を有効にする

        $mailer->SMTPSecure = '';//SSLも使えると公式で言ってます
        $mailer->Port = 587;//cloud gate uno

        $mailer->Username='info@kobetsu-review.com';
        $mailer->Password='A8NFQbHTW4gsAu';

        $mailer->setFrom($mailer->Username, mb_encode_mimeheader('個別指導レビュー'));
        $mailer->Subject  = mb_convert_encoding($this->MailUserTitle,"UTF-8","AUTO");//件名の設定
        $mailer->Body     = mb_convert_encoding($this->UserMailBody,"UTF-8","AUTO");//メッセージ本体
        $mailer->AddAddress($this->PostData['email']);
        if($mailer->Send()){

        }
        else{
            $this->SendMailErr++;
            $mailer->ErrorInfo;
        }
        //管理者宛
        $admin_mail_header = "From:".$this->PostData['email']."<".$this->PostData['email'].">";
        $sendName= $this->PostData['name'].'様';
        foreach($this->MailAddminAddress as $key=>$val){
            $admailer = new PHPMailer();//インスタンス生成
            $admailer->IsSMTP();//SMTPを作成
            $admailer->Host = 'smtp.hetemail.jp';//Cloud Gate UNO
            $admailer->CharSet = 'utf-8';//文字セットこれでOK
            $admailer->SMTPAuth = TRUE;//SMTP認証を有効にする

            $admailer->SMTPSecure = '';//SSLも使えると公式で言ってます
            $admailer->Port = 587;//cloud gate uno

            $admailer->Username='info@kobetsu-review.com';
            $admailer->Password='A8NFQbHTW4gsAu';

            $admailer->setFrom('review@x.gmobb.jp', mb_encode_mimeheader($sendName));
            $admailer->Subject  = mb_convert_encoding($this->MailAddminTitle,"UTF-8","AUTO");//件名の設定
            $admailer->Body     = mb_convert_encoding($this->AddminMailBody,"UTF-8","AUTO");//メッセージ本体
            $admailer->AddAddress($val);
            if($admailer->Send()){

            }
            else{
                $this->SendMailErr++;
                $mailer->ErrorInfo;
            }
        }
        if($this->SendMailErr===0) {

        }else {

        }
    }
}

?>
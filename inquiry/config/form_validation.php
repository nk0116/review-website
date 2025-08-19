<?php
trait FormValidation {
    public $err;
    private function ValidationCheack() {
        //print_r($this->PostData);
        
        if(empty($this->PostData['name'])) { $this->err['name'] = '名前は必須項目です。'; }
        
        if(empty($this->PostData['prefectures'])) { $this->err['prefectures'] = '都道府県は必須項目です。'; }
        if(empty($this->PostData['city'])) { $this->err['city'] = '市町村は必須項目です。'; }
        if(empty($this->PostData['city'])) { $this->err['city'] = '市町村は必須項目です。'; }
        if(empty($this->PostData['address'])) { $this->err['address'] = 'それ以降の住所'; }
        
        if (preg_match("/^\d{3}\-\d{4}\-\d{4}$/", $this->PostData['tel']) or preg_match("/^\d{3}\-\d{3}\-\d{4}$/", $this->PostData['tel']) or preg_match("/^\d{4}\-\d{3}\-\d{3}$/", $this->PostData['tel']) or preg_match("/^\d{2}\-\d{4}\-\d{4}$/", $this->PostData['tel']) or preg_match("/^\d{10}$|^\d{11}$/", $this->PostData['tel'])) {
        }else {
            $this->err['tel'] = '電場番号形式ではありません。';
        }

        if(empty($this->PostData['email'])) {
            $this->err['email_02'] = 'メールアドレスを入力してください。';
        }elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $this->PostData['email'])){
            $this->err['email_02'] = 'メールアドレスを入力してください。';
        }else {
            
        }
        
        if(empty($this->PostData['contact'])) { $this->err['contact'] = '内容は必須項目です。'; }
        
        
        
        // if(empty($this->PostData['name'])) { $this->err['name'] = '名前は必須項目です。'; }

        // if(empty($this->PostData['email'])) {
        //     $this->err['email_02'] = 'メールアドレスを入力してください。';
        // }elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $this->PostData['email'])){
        //     $this->err['email_02'] = 'メールアドレスを入力してください。';
        // }else {

        // }

        // if(empty($this->PostData['re_email'])) {
        //     $this->err['email_02'] = 'メールアドレス確認用を入力してください。';
        // }
        // elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $this->PostData['re_email'])){
        //     $this->err['email_02'] = 'メールアドレス確認用を入力してください。';
        // }else {

        // }

        // if($this->PostData['email'] === $this->PostData['re_email']){
        // }else {
        //     $this->err['email_03'] = 'メールアドレスとメールアドレス確認に異なるメールアドレスが入力されています。';
        // }
        // if (preg_match("/^\d{3}\-\d{4}\-\d{4}$/", $this->PostData['tel']) or preg_match("/^\d{3}\-\d{3}\-\d{4}$/", $this->PostData['tel']) or preg_match("/^\d{4}\-\d{3}\-\d{3}$/", $this->PostData['tel']) or preg_match("/^\d{2}\-\d{4}\-\d{4}$/", $this->PostData['tel']) or preg_match("/^\d{10}$|^\d{11}$/", $this->PostData['tel'])) {
        // }else {
        //     $this->err['tel'] = '電場番号形式ではありません。';
        // }
        // if(empty($this->PostData['contact'])) { $this->err['contact'] = 'お問い合わせ内容を入力してください。'; }
    }
}
?>
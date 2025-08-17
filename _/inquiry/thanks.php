<?php
    session_start();
    require_once(dirname(__FILE__) . '/config/mail_config.php');
    $postdatas = new sendmailcl($_POST,3);
    $postdatas->sendmail_chack();
    session_destroy();
?>
<?php include_once('include/common/header/header.php'); ?>
<br />
<!-- InstanceBeginEditable name="main_content" -->
<br />
<br />
<p class="thanks">
    お問合せありがとうございました。<br />
    後日、担当者からご連絡いたしますので<br />
    しばらくおまちください。<br />
    <br />
    <br />
    <a href="../index.html">トップへ戻る</a>
</p>
<!-- InstanceEndEditable -->
<!--idcontents fin-->
<?php include_once('include/common/footer/footer.php'); ?>
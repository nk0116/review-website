<?php
    session_start();
    require_once(dirname(__FILE__) . '/config/mail_config.php');
    $postdatas = new FormSettings($_POST,1);
    if (!isset($_SESSION['csrf_token_thanks'])) {
        $_SESSION['csrf_token_thanks'] = sha1(session_id());
    }
?>
<?php include_once('include/common/header/header.php'); ?>
<!--コンテンツ-->
<?php if(empty($postdatas->err)):  ?>
<?php include 'include/layouts/confirm.php'; $_SESSION['csrf_token'] = array(); ?>
<?php else: //エラーがあった場合 ?>

<?php include 'include/layouts/form.php'; ?>
<?php endif; ?>
<?php include_once('include/common/footer/footer.php'); ?>
<?php session_start() ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/header.php' ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/checkLogin.php' ?>

<?php
$user_id = $_SESSION['login_user']['id'];

$content = $_SESSION['content'];

$err = [];

$token = filter_input(INPUT_POST, 'csrf_token');
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
$err['err'] = '送信フォームから送信してください';
$_SESSION['err'] = $err;
header('Location: register_form.php');
}
unset($_SESSION['csrf_token']);


if(count($err) == 0 ){
    if (BookLogic::registerBooks($user_id,$content)) {
        $_SESSION['content'] = [];
        header('Location: ../index.php');
    }
}

?>

<?php

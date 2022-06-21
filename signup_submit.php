<?php
session_start();
require_once(dirname(__FILE__) . '/inc/header.php');


$err = [];

$token = filter_input(INPUT_POST, 'csrf_token');
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
    exit('不正なリクエストです');
}
unset($_SESSION['csrf_token']);

if (!$name = filter_input(INPUT_POST, 'name')) {
    $err['name'] = '名前が入力されていません';
}
if (!$email = filter_input(INPUT_POST, 'email')) {
    $err['email_signup'] = 'メールアドレスが入力されていません';
}
if ($email = filter_input(INPUT_POST, 'email')) {
    if (!$email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err['email_signup'] = 'メールアドレスの値が不正です';
    }
}
if (!$password = filter_input(INPUT_POST, 'password')) {
    $err['password_signup'] = 'パスワードが入力されていません';
}
if ($password = filter_input(INPUT_POST,'password')) {
    if (!preg_match("/\A[a-z\d]{8,16}+\z/i", $password)) {
        $err['password_signup'] = 'パスワードは英数字8文字以上16文字以下にしてください';
    }
}
if (!$confirm_password = filter_input(INPUT_POST, 'confirm_password')) {
    $err['confirm_password'] = '確認用パスワードが入力されていません';
}
if ($confirm_password = filter_input(INPUT_POST,'confirm_password')) {
    if($password !== $confirm_password) {
        $err['confirm_password'] = 'パスワードの値が一致しません';
    }
}

$isCreated = false;

if (count($err) > 0) {
    $_SESSION = $err;
    header('Location: signup_form.php');
    return;
}
if (count($err) === 0) {
    $isCreated = UserLogic::createUser($_POST);
    if($isCreated){
        $_SESSION = [];
        $_SESSION['success'] = '登録成功です。さあ、ログインして始めよう';
        header('Location: login_form.php');
        return;
    } else {
    $err['failure'] = 'そのメールアドレスは既に登録されています';
    $_SESSION = $err;
    header('Location: signup_form.php');
    return;
    }
}


?>


<?php require_once(dirname(__FILE__) . '/inc/footer.php'); ?>

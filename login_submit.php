<?php
session_start();
require_once(dirname(__FILE__) . '/inc/header.php');


$err = [];


if (!$email = filter_input(INPUT_POST, 'email')) {
    $err['email_login'] = 'メールアドレスを入力してください';
}
if(!$password = filter_input(INPUT_POST, 'password')) {
    $err ['password_login'] = 'パスワードを入力してください';
}


if (count($err) > 0) {
    $_SESSION = $err;
    echo "<script>location.href='/login_form.php'</script>";
    exit;
}

//ログイン成功時の処理
$result = UserLogic::login($email,$password);

if(!$result){
    echo "<script>location.href='/login_form.php'</script>";
    exit;
}

echo "<script>location.href='/index.php'</script>";
exit;



?>

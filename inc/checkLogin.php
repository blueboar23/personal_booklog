<?php

$err = [];
if (!UserLogic::checkLogin()) {
    $err['msg'] = 'ログインせずに直接アクセスできません';
    $_SESSION = $err;
    header('Location: ../login_form.php');
}

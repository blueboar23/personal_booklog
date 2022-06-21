<?php

$err = [];
if (!UserLogic::checkLogin()) {
    $err['msg'] = 'ログインせずに直接アクセスできません';
    $_SESSION = $err;
    echo "<script>location.href='/login_form.php'</script>";
    exit;
}

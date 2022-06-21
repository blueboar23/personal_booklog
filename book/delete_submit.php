<?php session_start() ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/header.php' ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/checkLogin.php' ?>

<?php

$token = filter_input(INPUT_POST, 'csrf_token');
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
    $err_msg = [];
    $err_msg['failure'] = '削除ボタンからアクセスしてください';
    $_SESSION['err_msg'] = $err_msg;
    echo "<script>location.href='/index.php'</script>";
    exit;
}
$id = $_POST['updated_id'];
unset($_SESSION['csrf_token']);

if (isset($_POST['delete'])) {
    BookLogic::deleteEachBook($id);
}

    ?>

</div>

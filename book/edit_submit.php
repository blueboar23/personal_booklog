<?php session_start() ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/header.php' ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/checkLogin.php' ?>
<?php $user_id = $_SESSION['login_user']['id']; ?>


<br>
<?php

if (!isset($_POST['submit'])) {
    $err_msg = [];
    $err_msg['failure'] = '編集ボタンからアクセスしてください';
    $_SESSION['err_msg'] = $err_msg;
    header('Location: ../index.php');
}

$err = [];


if ($_POST['genre'] === 'ジャンルを登録してください') {
    $err['err'] = 'ジャンルを登録しないと、本を登録できません。';
}
if (!$title = filter_input(INPUT_POST, 'title')) {
    $err['title'] = 'タイトルは入力必須項目です';
}
if (!$author = filter_input(INPUT_POST, 'author')) {
    $err['author'] = '著者は入力必須項目です';
}

$id= $_POST['updated_id'];

if (count($err) > 0) {
    $_SESSION['err'] = $err;
    header("Location: edit.php?id=$id");
}

?>

<?php


if (count($err) === 0) {
    $updatedData = [];
    $updatedData ['id'] = $_POST['updated_id'];
    $updatedData ['title'] = escape($_POST['title']);
    $updatedData ['author']= escape($_POST['author']);
    $updatedData ['memo'] = escape($_POST['memo']);
    $updatedData ['lesson'] = escape($_POST['lesson']);
    $updatedData ['vocabulary'] = escape($_POST['vocabulary']);
    $updatedData ['genre'] = $_POST['genre'];
    $updatedData ['rank'] = $_POST['rank'];

    BookLogic::updateBooks($updatedData);
}

?>

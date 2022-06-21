<?php session_start() ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/header.php' ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/checkLogin.php' ?>



<div>
    <?php

    $user_id = $_SESSION['login_user']['id'];
    $id = $_POST['updated_id'];
    $genre = $_POST['genre'];
    $err = [];


    if (isset($_POST['delete'])) {
        $dbh = DbLogic::dbConnect();
        $statement = $dbh->prepare("DELETE FROM genres where id = :id");
        $statement->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $statement->execute();
        $err['message'] = '「' . escape($genre) . '」' . 'が削除されました。';
        $_SESSION['err'] = $err;
        header('Location: register.php');
    }

    ?>

</div>

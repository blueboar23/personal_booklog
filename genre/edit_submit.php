<?php session_start() ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/header.php' ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/checkLogin.php' ?>

<div>
    <?php
    if (empty($_POST['submit'])) {
        $genre_err_msg = [];
        $genre_err_msg['failure'] = '編集ボタンからアクセスしてください</br>';
        $_SESSION['genre_err_msg'] = $genre_err_msg;
        echo "<script>location.href='/genre/register.php'</script>";
        exit;
    }
    $user_id = $_SESSION['login_user']['id'];
    $genre = $_POST['genre'];
    $id = $_POST['updated_id'];
    $err = [];
    $success = [];

    if (isset($_POST['submit'])) {
        if (empty($_POST['genre'])) {
            $err['message'] = '変更するジャンルの値を入力してください';
            $_SESSION['err'] = $err;
            echo "<script>location.href='/genre/register.php'</script>";
            exit;
        } elseif (isset($_POST['genre'])) {
            $dbh = DbLogic::dbConnect();
            $check = $dbh->query("SELECT * FROM genres WHERE user_id = $user_id AND genre ='" .  $genre . "'");
            if ($check->fetchColumn() != 0) {
                $err['message'] = '「' . escape($genre) . '」' . 'は既に登録されています';
                $_SESSION['err'] = $err;
                echo "<script>location.href='/genre/register.php'</script>";
                exit;
            } else {
                $statement = $dbh->prepare("UPDATE genres SET genre = :genre where id = :id");
                $statement->bindValue(':genre', $genre, PDO::PARAM_STR);
                $statement->bindValue(':id', $id, PDO::PARAM_INT);
                $statement->execute();
                $success['message'] = '「' . escape($genre) . '」' . 'に更新されました';
                $_SESSION['success'] = $success;
                echo "<script>location.href='/genre/register.php'</script>";
                exit;

            }
        }
    }

    ?>

</div>
<?php require_once dirname(dirname(__FILE__)) . '/inc/footer.php' ?>

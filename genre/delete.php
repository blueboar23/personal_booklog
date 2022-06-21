<?php session_start() ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/header.php' ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/checkLogin.php' ?>


<?php
if (empty($_GET['id'])) {
    $genre_err_msg = [];
    $genre_err_msg['failure'] = '削除ボタンからアクセスしてください。</br>';
    $_SESSION['genre_err_msg'] = $genre_err_msg;
    header('Location: register.php');
}

// DBのデータを表示
$id = $_GET['id'];
$user_id = $_SESSION['login_user']['id'];

$dbh = DbLogic::dbConnect();

$statement = $dbh->prepare('SELECT * FROM genres WHERE id= :id AND user_id = :user_id');
$statement->bindValue(':id', (int)$id, PDO::PARAM_INT);
$statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
$statement->execute();
$genre = $statement->fetch(PDO::FETCH_ASSOC);

if (!$genre) {
    $genre_err_msg = [];
    $genre_err_msg['failure'] = 'そのデータは登録されていません。</br>';
    $_SESSION['genre_err_msg'] = $genre_err_msg;
    header('Location: register.php');
}
?>


<div class="row">
    <div class="col-lg-6 mx-auto mb-5">
        <div class="card card-body bg-light mt-5 pb-5">
            <div class="card-header">
                <h2 class="text-center">ジャンル削除フォーム</h2>
            </div>
            <div class="card-body">
                <h4 class="text-center">「<?php echo escape($genre['genre']) ?>」 を削除しますか？</h4>
                <form action="delete_submit.php" method="post">
                    <input type="hidden" name="updated_id" value="<?php echo escape($id) ?>">
                    <input type="hidden" name="genre" value="<?php echo escape($genre['genre']) ?>">
                    <br><br>
                    <div class="row">
                        <div class="col">
                            <a href="register.php" class="btn btn-secondary btn-block">戻る</a>
                        </div>
                        <div class="col">
                            <input type="submit" value="削除する" name="delete" class="btn btn-danger btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php


?>


<?php require_once dirname(dirname(__FILE__)) . '/inc/footer.php' ?>

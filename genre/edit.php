<?php session_start() ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/header.php' ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/checkLogin.php' ?>


<?php
if (empty($_GET['id'])) {
    $genre_err_msg = [];
    $genre_err_msg['failure'] = '編集ボタンからアクセスしてください。</br>';
    $_SESSION['genre_err_msg'] = $genre_err_msg;
    header('Location: register.php');
}

$id = $_GET['id'];
$user_id = $_SESSION['login_user']['id'];
$genre = GenreLogic::getEachGenre($id,$user_id);

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
                <h2 class="text-center">ジャンル編集フォーム</h2>
            </div>
            <div class="card-body">
                <h4 class="text-center">「<?php echo escape($genre['genre']) ?>」 を編集してください</h4>
                <form action="edit_submit.php" method="post">
                    <label for="genre">ジャンル：</label>
                    <input class="form-control form-control-lg" type="text" id="genre" name="genre" value="<?php echo escape($genre['genre']) ?>"><br>
                    <input type="hidden" name="updated_id" value="<?php echo escape($id) ?>">
                    <br><br>
                    <div class="row">
                        <div class="col">
                            <a href="register.php" class="btn btn-secondary btn-block">戻る</a>
                        </div>
                        <div class="col">
                            <input type="submit" value="更新する" name="submit" class="btn btn-success btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php require_once dirname(dirname(__FILE__)) . '/inc/footer.php' ?>

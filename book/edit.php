<?php session_start() ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/header.php' ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/checkLogin.php' ?>


<?php
$user_id = $_SESSION['login_user']['id'];

if (empty($_GET['id'])) {
    $err_msg = [];
    $err_msg['failure'] = '編集ボタンからアクセスしてください';
    $_SESSION['err_msg'] = $err_msg;
    echo "<script>location.href='/index.php'</script>";
    exit;
}

$id = $_GET['id'];
$user_id = $_SESSION['login_user']['id'];

$dbh = DbLogic::dbConnect();
$statement = $dbh->prepare('SELECT * FROM books WHERE id= :id AND user_id = :user_id');
$statement->bindValue(':id', (int)$id, PDO::PARAM_INT);
$statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
$statement->execute();
$book = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_SESSION['err'])) {
    $err = $_SESSION['err'];
    $_SESSION['err'] = [];
}

if (!$book) {
    $err_msg['failure'] = 'そのデータは登録されていません';
    $_SESSION['err_msg'] = $err_msg;
    echo "<script>location.href='/index.php'</script>";
    exit;
}

?>

<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto mb-5">
            <div class="card card-body bg-light mt-5 pb-5">
                <div class="card-header">
                    <h2 class="text-center">読書ログ編集フォーム</h2>
                </div>
                <br>
                <h5 class="text-center">気になった箇所を編集してください</h5>
                <div class="card-body">
                    <form action="edit_submit.php" method="post">
                        <label for="title">タイトル：</label>
                        <input class="form-control form-control-lg" type="text" id="title" name="title" value="<?php echo escape($book['title']) ?>"><br>
                        <?php if (isset($err['title'])) : ?>
                            <p class="alert-danger"><?php echo escape($err['title']) ?></p>
                        <?php endif ?>
                        <label for="author">著者：</label>
                        <input class="form-control form-control-lg" type="text" id="author" name="author" value="<?php echo escape($book['author']) ?>"><br>
                        <?php if (isset($err['author'])) : ?>
                            <p class="alert-danger"><?php echo escape($err['author']) ?></p>
                        <?php endif ?>
                        <label for="genre">ジャンル：</label>
                        <select class="form-control form-control-lg" name="genre" id="genre">
                            <?php $results = GenreLogic::getAllGenres($user_id); ?>
                            <?php if (!$results) : ?>
                                <option value="<?php echo 'ジャンルを登録してください' ?>"><?php echo 'ジャンルを登録してください' ?>
                                <?php else : ?>
                                    <?php foreach ($results as $result) : ?>
                                <option value="<?php echo $result['id'] ?>" <?php echo in_array($result['id'], $result, true) && $book['genre_id'] == $result['id'] ? 'selected' : ''; ?>><?php echo GenreLogic::getGenreName($result['id']) ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                        </select><br>
                        <label for="rank">ランク：</label>
                        <div class="btn-group" data-toggle="buttons">
                            <div>
                                <label class="form-check-label btn btn-warning btn-lg mr-3" for="third">
                                    <input type="radio" name="rank" value="3軍" <?php if (isset($book['rank']) && $book['rank'] === "3軍") {
                                                                                    echo "checked";
                                                                                } ?>>3軍
                                </label>
                            </div>
                            <div>
                                <label class="form-check-label btn btn-warning btn-lg mr-3" for="second">
                                    <input type="radio" name="rank" value="2軍" <?php if (isset($book['rank']) && $book['rank'] === "2軍") {
                                                                                    echo "checked";
                                                                                } ?>>2軍
                                </label>
                            </div>
                            <div>
                                <label class="form-check-label btn btn-warning btn-lg mr-3" for="first">
                                    <input type="radio" name="rank" value="1軍" <?php if (isset($book['rank']) && $book['rank'] === "1軍") {
                                                                                    echo "checked";
                                                                                } ?>>1軍
                                </label>
                            </div>
                            <div>
                                <label class="form-check-label btn btn-warning btn-lg mr-3" for="legend">
                                    <input type="radio" name="rank" value="殿堂入り" <?php if (isset($book['rank']) && $book['rank'] === "殿堂入り") {
                                                                                        echo "checked";
                                                                                    } ?>>殿堂入り<br>
                                </label>
                            </div>
                        </div><br>
                        <label for="memo">メモ：</label>
                        <textarea class="form-control form-control-lg" name="memo" id="memo" cols="100" rows="8"><?php echo escape($book['memo']) ?></textarea><br>
                        <?php if (isset($err['memo'])) : ?>
                            <p class="alert-danger"><?php echo escape($err['memo']) ?></p>
                        <?php endif ?>
                        <label for="lesson">学び：</label>
                        <textarea class="form-control form-control-lg" name="lesson" id="lesson" cols="100" rows="8"><?php echo escape($book['lesson']) ?></textarea><br>
                        <?php if (isset($err['lesson'])) : ?>
                            <p class="alert-danger"><?php echo escape($err['lesson']) ?></p>
                        <?php endif ?>
                        <label for="vocabulary">語彙：</label>
                        <textarea class="form-control form-control-lg" name="vocabulary" id="vocabulary" cols="100" rows="2"><?php echo escape($book['vocabulary']) ?></textarea><br>
                        <input type="hidden" name="updated_id" value="<?php echo escape($id) ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo escape(setToken()); ?>">

                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <a href="../index.php" class="btn btn-secondary btn-block">戻る</a>
                                </div>
                                <div class="col">
                                    <input type="submit" value="送信する" name="submit" class="btn btn-success btn-block">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php require_once dirname(dirname(__FILE__)) . '/inc/footer.php' ?>

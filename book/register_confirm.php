<?php session_start() ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/header.php' ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/checkLogin.php' ?>
<?php $user_id = $_SESSION['login_user']['id']; ?>

<?php

$err = [];


if ($_POST['genre'] === 'ジャンルを登録してください') {
    $err['err'] = 'ジャンルを登録しないと、本を登録できません';
}
if (!$title = filter_input(INPUT_POST, 'title')) {
    $err['title'] = 'タイトルは入力必須項目です';
}
if (!$author = filter_input(INPUT_POST, 'author')) {
    $err['author'] = '著者は入力必須項目です';
}


if (count($err) > 0) {
    $_SESSION['err'] = $err;
    echo "<script>location.href='/book/register_form.php'</script>";
    exit;
}

?>

<?php

$content = [];

$title = escape($_POST['title']);
$author = escape($_POST['author']);
$memo = escape($_POST['memo']);
$lesson = escape($_POST['lesson']);
$vocabulary = escape($_POST['vocabulary']);
$genre = $_POST['genre'];
$rank = $_POST['rank'];

$content['title'] = $title;
$content['author'] = $author;
$content['memo'] = $memo;
$content['lesson'] = $lesson;
$content['vocabulary'] = $vocabulary;
$content['genre'] = $genre; //int
$content['rank'] = $rank;

$_SESSION['content'] = $content;


?>

<div class="container confirm">
    <div class="row">
        <div class="col-lg-10 mx-auto mb-5">
            <div class="card card-body bg-light mt-5 pb-5">
                <div class="text-center">
                    <h2>登録確認フォーム</h2>
                    <br>
                </div>
                <div class="form-group">
                    <h4><strong>タイトル： </strong><?php echo $title ?></h4>
                    <hr>
                </div>
                <div class="form-group">
                    <h4><strong>著者： </strong><?php echo $author ?></h4>
                    <hr>
                </div>
                <div class="form-group">
                    <h4><strong>ジャンル： </strong><?php echo GenreLogic::getGenreName($genre); ?></h4>
                    <hr>
                </div>
                <div class="form-group">
                    <h4><strong>ランク： </strong><?php echo $rank ?></h4>
                    <hr>
                </div>
                <div class="form-group">
                    <h4><strong>メモ： </strong></h4>
                    <h5><?php echo $memo ?></h5>
                    <hr>
                </div>
                <div class="form-group">
                    <h4><strong>学び： </strong></h4>
                    <h5><?php echo $lesson ?></h5>
                    <hr>
                </div>
                <div class="form-group">
                    <h4><strong>語彙： </strong></h4>
                    <h5><?php echo $vocabulary ?></h5>
                    <hr>
                    <div class="text-center">
                        <h3>この内容で登録しますか？</h3>
                        <h3>修正点がある場合は「戻る」を押して、編集してください</h3>
                        <br><br>
                        <div class="row">
                            <div class="col">
                                <form action="register_submit.php" method="post">
                                    <a href="register_form.php"><input type="button" class="btn-secondary btn-block pt-2 pb-2" value="戻る"></a>
                                    <input type="hidden" name="csrf_token" value="<?php echo escape(setToken()); ?>">
                            </div>
                            <div class="col">
                                <input type="submit" value="登録する" class="btn-success btn-block pt-2 pb-2">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<br><br><br>





<?php require_once dirname(dirname(__FILE__)) . '/inc/footer.php' ?>

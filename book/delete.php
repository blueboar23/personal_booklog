<?php session_start() ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/header.php' ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/checkLogin.php' ?>


<?php

if (empty($_GET['id'])) {
    $err_msg = [];
    $err_msg['failure'] = '削除ボタンからアクセスしてください';
    $_SESSION['err_msg'] = $err_msg;
    header('Location: ../index.php');
}

$id = $_GET['id'];
$user_id = $_SESSION['login_user']['id'];
$result = BookLogic::getEachBook($id,$user_id);

if (!$result) {
    $err_msg = [];
    $err_msg['failure'] = 'そのデータは登録されていません';
    $_SESSION['err_msg'] = $err_msg;
    header('Location: ../index.php');
}
?>



<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto mb-5">
            <div class="card card-body bg-light mt-5 pb-5">
                <div class="card-header">
                    <h2 class="text-center">読書ログ削除フォーム</h2>
                </div>
                <br>
                <h4 class="text-center">以下の本の情報を削除しますか？</h4>
                <hr>
                <div class="card-body">
                <div class="confirm">
                    <p><strong>タイトル： </strong><?php echo $result['title'] ?></p>
                    <p><strong>著者： </strong><?php echo $result['author'] ?></p>
                    <?php if($result['genre_id'] === null): ?>
                        <p><strong>ジャンル： </strong><span style='color:red;'>未選択</span></p>
                    <?php else: ?>
                        <p><strong>ジャンル： </strong><?php echo GenreLogic::getGenreName($result['genre_id']) ?></p>
                    <?php endif ?>
                    <p><strong>ランク： </strong><?php echo $result['rank'] ?></p>
                    <p><strong>メモ： </strong><?php echo $result['memo'] ?></p>
                    <p><strong>学び： </strong><?php echo $result['lesson'] ?></p>
                    <p><strong>語彙： </strong><?php echo $result['vocabulary'] ?></p>
                </div>
                <br><br>

                    <div class="row">
                        <div class="col">
                            <a href="../index.php" class="btn btn-secondary btn-block">戻る</a>
                        </div>
                        <div class="col">
                            <form action="delete_submit.php" method="post">
                                <input type="hidden" name="updated_id" value="<?php echo escape($id) ?>">
                                <input type="hidden" name="csrf_token" value="<?php echo escape(setToken()); ?>">
                                <input type="submit" value="削除する" name="delete" class="btn btn-danger btn-block">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php


?>


<?php require_once dirname(dirname(__FILE__)) . '/inc/footer.php' ?>

<?php session_start() ?>
<?php ini_set("display_errors", 0); ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/header.php' ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/checkLogin.php' ?>
<?php
$user_id = $_SESSION['login_user']['id'];

$err = $_SESSION['err'];
$content = $_SESSION['content'];


$_SESSION['err'] = [];
$_SESSION['content'] = [];

$flag = 0;
?>

<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto mb-5">
            <div class="card card-body bg-light mt-5 pb-5">
                <div class="card-header">
                    <h2 class="text-center">読書ログ登録フォーム</h2>
                </div>
                <div class="card-body">

                    <h4 class="text-center">(<strong>＊</strong>がついている箇所は入力必須項目です)</h2>
                        <form action="register_confirm.php" method="post">

                            <?php if (isset($err['err'])) : ?>
                                <p class="alert-danger"><?php echo escape($err['err']) ?>
                            <?php endif ?>

                            <div class="form_group">
                                <h4>
                                    <label for="title"><strong>タイトル：＊ </strong></label>
                                    <input type="text" id="title" name="title" class="form-control form-control-lg" placeholder="本のタイトル名" value="<?php if (isset($content['title'])) {
                                                                                                                                                        echo $content['title'];
                                                                                                                                                    } ?>">
                                </h4>
                                <?php if (isset($err['title'])) : ?>
                                    <p class="alert-danger"><?php echo escape($err['title']) ?>
                                <?php endif ?>
                            </div>
                            <hr>

                            <div class="form-group">
                                <h4>
                                    <label for="author"><strong>著者：＊ </strong></label>
                                    <input type="text" id="author" name="author" placeholder="本の著者名" class="form-control form-control-lg" value="<?php if (isset($content['author'])) {
                                                                                                                                                        echo $content['author'];
                                                                                                                                                    } ?>">
                                </h4>
                                <?php if (isset($err['author'])) : ?>
                                    <p class="alert-danger"><?php echo escape($err['author']) ?>
                                <?php endif ?>
                            </div>
                            <hr>

                            <div class="form-group">
                                <h4>
                                    <label for="genre"><strong>ジャンル：＊ </strong></label>
                                    <select name="genre" id="genre" class="form-control form-control-lg">
                                        <?php $results = GenreLogic::getAllGenres($user_id); ?>
                                        <?php if (!$results) : ?>
                                            <option value="<?php echo 'ジャンルを登録してください' ?>"><?php echo 'ジャンルを登録してください' ?>
                                            <?php $flag = 1; ?>
                                        <?php else : ?>
                                            <?php foreach ($results as $result) : ?>
                                                <option value="<?php echo $result['id'] ?>" <?php echo in_array($result['id'], $content, true) && $content['genre'] == $result['id'] ? 'selected' : ''; ?>><?php echo GenreLogic::getGenreName($result['id']) ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </h4>

                                    <?php if ($flag == 1) : ?>
                                        <p class="alert-danger"><?php echo '⚠️ジャンルを登録しないと、本を登録できません⚠️' ?></p>
                                        <div class="text-center">
                                            <a href="<?php echo URL_ROOT ?>/genre/register.php"><input type="button" class="btn btn-success" value="ジャンルを登録する"></a>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <hr>

                                <h4><label for="genre"><strong>ランク：＊ </strong></label></h4>
                                <div class="btn-group" data-toggle="buttons">
                                    <div>
                                        <label class="form-check-label btn btn-warning btn-lg mr-3" for="third">
                                            <input type="radio" name="rank" value="3軍" id="third" checked> 3軍
                                        </label>
                                    </div>

                                    <div>
                                        <label class="form-check-label btn btn-warning btn-lg mr-3" for="second">
                                            <input type="radio" name="rank" value="2軍" id="second" <?php if (isset($content['rank']) && $content['rank'] === "2軍") {
                                                                                                        echo "checked";
                                                                                                    } ?>> 2軍
                                        </label>
                                    </div>

                                    <div>
                                        <label class="form-check-label btn btn-warning btn-lg mr-3" for="first">
                                            <input type="radio" name="rank" value="1軍" id="first" <?php if (isset($content['rank']) && $content['rank'] === "1軍") {
                                                                                                        echo "checked";
                                                                                                    } ?>> 1軍
                                        </label>
                                    </div>

                                    <div>
                                        <label class="form-check-label btn btn-warning btn-lg mr-3" for="legend">
                                            <input type="radio" name="rank" value="殿堂入り" id="legend" <?php if (isset($content['rank']) && $content['rank'] === "殿堂入り") {
                                                                                                            echo "checked";
                                                                                                        } ?>> 殿堂入り
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <hr>

                                <div class="form-group">
                                    <h4>
                                        <label for="memo"><strong>メモ：</strong></label><br>
                                        <textarea name="memo" id="memo" class="form-control form-control-lg" rows="8" placeholder="内容の要約、&#13;読んだ感想など"><?php if (isset($content['memo'])) {
                                                                                                                                                            echo $content['memo'];
                                                                                                                                                        } ?></textarea>
                                    </h4>
                                    <?php if (isset($err['memo'])) : ?>
                                        <p class="alert-danger"><?php echo escape($err['memo']) ?>
                                    <?php endif ?>
                                </div>
                                <hr>


                                <div class="form-group">
                                    <h4>
                                        <label for="lesson"><strong>学び： </strong></label><br>
                                        <textarea name="lesson" id="lesson" rows="8" class="form-control form-control-lg" placeholder="学んだこと、&#13;自分の考えや行動がどう変わったかなど"><?php if (isset($content['lesson'])) {
                                                                                                                                                                            echo $content['lesson'];
                                                                                                                                                                        } ?></textarea>
                                    </h4>
                                    <?php if (isset($err['lesson'])) : ?>
                                        <p class="alert-danger"><?php echo escape($err['lesson']) ?>
                                    <?php endif ?>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <h4>
                                        <label for="vocabulary"><strong>語彙： </strong></label><br>
                                        <textarea name="vocabulary" id="vocabulary" cols="100" rows="3" class="form-control form-control-lg" placeholder="知らなかった単語、&#13;印象に残ったフレーズなど"><?php if (isset($content['vocabulary'])) {
                                                                                                                                                                                            echo $content['vocabulary'];
                                                                                                                                                                                        } ?></textarea>
                                    </h4>
                                </div>
                                <hr>

                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="text-center">
                                                <input type="submit" value="送信" name="submit" class="btn btn-success py-3 mt-5" style="width:400px">
                                            </p>
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

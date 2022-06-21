<?php
session_start();
require_once(dirname(__FILE__) . '/inc/header.php');

$err = $_SESSION;
$success = $_SESSION;

$_SESSION = [];
session_destroy();

?>

<body>
    <div class="row">
        <div class="col-lg-6 mx-auto mb-5">
            <div class="card card-body bg-light mt-5 pb-5">
                <div class="card-header">
                    <h2 class="text-center">ログインフォーム</h2>
                </div>
                <div class="card-body">

                    <?php if (isset($err['msg'])) : ?>
                        <p class="alert-danger"><?php echo escape($err['msg']) ?></p>
                    <?php endif ?>
                    <?php if (isset($success['success'])) : ?>
                        <p class="alert-success"><?php echo escape($success['success']) ?></p>
                    <?php endif ?>
                    <form action="login_submit.php" method="post">
                        <div class="form-group">
                            <p>
                                <label for="email">メールアドレス：</label>
                                <input type="text" name="email" class="form-control form-control-lg">
                            </p>
                            <?php if (isset($err['email_login'])) : ?>
                                <p class="alert-danger"><?php echo escape($err['email_login']) ?></p>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <p>
                                <label for="password">パスワード：</label>
                                <input type="password" name="password" class="form-control form-control-lg">
                            </p>
                            <?php if (isset($err['password_login'])) : ?>
                                <p class="alert-danger"><?php echo escape($err['password_login']) ?></p>
                            <?php endif ?>
                        </div><br><br>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <input type="submit" value="ログイン" class="btn btn-primary btn-block">
                                </div>
                            </div>
                        </div><br><br>

                        <div class="text-center">
                            <a href="<?php echo URL_ROOT ?>/signup_form.php">未登録の方はこちらから登録</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</body>

<?php require_once(dirname(__FILE__) . '/inc/footer.php'); ?>

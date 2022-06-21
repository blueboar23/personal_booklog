<?php
session_start();
require_once(dirname(__FILE__) . '/inc/header.php');

$err = $_SESSION;

$_SESSION = [];
?>

<body>
    <div class="row">
        <div class="col-lg-6 mx-auto mb-5">
            <div class="card card-body bg-light mt-5 pb-5">
                <div class="card-header">
                    <h2 class="text-center">ユーザー登録フォーム</h2>
                </div>
                <div class="card-body">

                    <form action="signup_submit.php" method="post">

                        <?php if (isset($err['failure'])) : ?>
                            <p class="alert-danger"><?php echo escape($err['failure']) ?></p>
                    <?php endif ?>
                    <div class="form-group">
                        <p>
                            <label for="name">名前：</label><br>
                            <input type="text" name="name" class="form-control form-control-lg">
                        </p>
                        <?php if (isset($err['name'])) : ?>
                            <p class="alert-danger"><?php echo escape($err['name']) ?></p>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <p>
                                <label for="email">メールアドレス：</label><br>
                                <input type="text" name="email" class="form-control form-control-lg">
                            </p>
                            <?php if (isset($err['email_signup'])) : ?>
                                <p class="alert-danger"><?php echo escape($err['email_signup']) ?></p>
                                <?php endif ?>
                            </div>

                    <div class="form-group">
                        <p>
                            <label for="password">パスワード (英数字8文字以上16文字以下)：</label><br>
                            <input type="password" name="password" class="form-control form-control-lg">
                        </p>
                        <?php if (isset($err['password_signup'])) : ?>
                            <p class="alert-danger"><?php echo escape($err['password_signup']) ?></p>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <p>
                                <label for="confirm_password">パスワード確認：</label><br>
                                <input type="password" name="confirm_password" class="form-control form-control-lg">
                            </p>
                            <?php if (isset($err['confirm_password'])) : ?>
                                <p class="alert-danger"><?php echo escape($err['confirm_password']) ?></p>
                                <?php endif ?>
                            </div><br>

                            <input type="hidden" name="csrf_token" value="<?php echo escape(setToken()); ?>">

                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" value="新規登録する" class="btn btn-success btn-block">
                                    </div>
                                </div>
                            </div><br><br>

                            <div class="text-center">
                                <a href="<?php echo URL_ROOT ?>/login_form.php">登録済みの方はこちらからログイン</a>
                            </div>



                </form>

            </div>
            </div>
        </div>
    </div>
</body>

<?php require_once(dirname(__FILE__) . '/inc/footer.php'); ?>

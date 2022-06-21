<?php require_once dirname(dirname(__FILE__)) . '/config/config.php'; ?>
<?php require_once dirname(dirname(__FILE__)) . '/classes/UserLogic.php'; ?>
<?php require_once dirname(dirname(__FILE__)) . '/classes/BookLogic.php'; ?>
<?php require_once dirname(dirname(__FILE__)) . '/classes/GenreLogic.php'; ?>
<?php require_once dirname(dirname(__FILE__)) . '/functions/function.php' ?>

<body>

    <nav class="navbar navbar-dark navbar-expand-lg py-4" style="height:150px;background-color:darkblue">
        <div class="container">
            <a href="<?php echo URL_ROOT ?>" class="navbar-brand"><span style="font-size:35px"><i class="fa-solid fa-book-open"></i> Personal BookLog</span>
            </a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navmenu">
                <span class="navbar-toggler-icon">
                </span>
            </button>
        </div>

        <div class="container">
            <div class="collapse navbar-collapse" id="navmenu">
                <?php if (UserLogic::checkLogin()) : ?>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="<?php echo URL_ROOT ?>/genre.php" class="nav-link text-light btn btn-success mx-2"><i class="fa-solid fa-ranking-star"></i> ランク別で見る</a></li>
                        <li class="nav-item"><a href="<?php echo URL_ROOT ?>/book/register_form.php" class="nav-link text-light btn btn-success mx-2"><i class="fa-solid fa-book"></i> 読書ログを登録する</a></li>
                        <li class="nav-item"><a href="<?php echo URL_ROOT ?>/genre/register.php" class="nav-link text-light btn btn-success mx-2"><i class="fa-solid fa-list"></i> ジャンルを登録する</a></li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <form action="<?php echo URL_ROOT ?>/logout.php" method="POST"><input type="submit" name="logout" class="btn btn-danger btn-block pb-2 mx-2" value="ログアウト"></form>
                        </li>
                    </ul>
                <?php else : ?>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="<?php echo URL_ROOT ?>/signup_form.php" class="nav-link text-light btn btn-success mx-2 px-3">新規登録</a></li>
                        <li class="nav-item"><a href="<?php echo URL_ROOT ?>/login_form.php" class="nav-link text-light btn btn-primary mx-2 px-3">ログイン</button></a></li>
                    </ul>
                <?php endif ?>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

<?php session_start() ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/header.php' ?>
<?php require_once dirname(dirname(__FILE__)) . '/inc/checkLogin.php' ?>



<br>
<div class="container text-center">

    <body>
        <div class="row">
            <div class="col-lg-8 mx-auto mb-5">
                <div class="card card-body bg-light mt-5 pb-5">
                    <div class="card-header">
                        <h2>ジャンル登録フォーム</h2>
                    </div>
                    <div class="card-body">

                        好きなジャンルを登録してください<br>
                        (小説、ビジネス書、歴史、プログラミング、教養、漫画など)<br>
                        登録できるジャンルは30個までです
                        <div class="container text-center">

                            <?php

                            if (isset($_SESSION['genre_err_msg'])) {
                                $failure = $_SESSION['genre_err_msg']['failure'];
                                echo "<br>" . "<p class='alert alert-danger'>" . $failure . "</p>";
                                unset($_SESSION['genre_err_msg']);
                            }

                            $user_id = $_SESSION['login_user']['id'];
                            $book_msg = [];
                            echo '<br>';
                            //フォームの入力をチェック
                            if (isset($_POST['submit'])) {
                                if (empty($_POST['genre'])) {
                                    echo '<p class="alert alert-danger">' . 'ジャンルが入力されていません。' . '</p>';
                                } elseif (isset($_POST['genre'])) {
                                    $genre = $_POST['genre'];
                                    $dbh = DbLogic::dbConnect();
                                    $check = $dbh->query("SELECT * FROM genres WHERE user_id = $user_id AND genre ='" . $genre . "'
                                ");
                                    $check_number = $dbh->query("SELECT * FROM genres WHERE user_id = $user_id");
                                    $row_numbers = $check_number->rowCount();
                                    if ($check->fetchColumn() != 0) {
                                        echo '<p class="alert alert-danger">' . '「' . escape($genre) . '」は既に登録されています' . '</p>';
                                    } elseif ($row_numbers > 29) {
                                        echo '<p class="alert alert-danger">' . 'ジャンルは30個までしか登録できません。' . '</p>';
                                    } else {
                                        $statement = $dbh->prepare("INSERT INTO genres(genre,user_id) VALUE (:genre,:user_id)");
                                        $statement->bindValue(':genre', $genre, PDO::PARAM_STR);
                                        $statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
                                        $statement->execute();
                                        echo '<p class="alert alert-success">' . '「' . escape($genre) . '」が登録されました' .  '</p>';
                                    }
                                }
                            }


                            if (isset($_SESSION['success']['message'])) {
                                $success = $_SESSION['success'];
                                echo '<p class="alert alert-success">'  . $success['message'] . '</p>';
                                $_SESSION['success'] = [];
                            } elseif (isset($_SESSION['err']['message'])) {
                                $err = $_SESSION['err'];
                                echo '<p class="alert alert-danger">'  . $err['message'] . '</p>';
                                $_SESSION['err'] = [];
                            }


                            ?>
                        </div>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <div class="form-group">
                                <p>
                                    <label for="genre"></label>
                                    <input type="text" id="genre" name="genre" class="form-control form-control-lg">
                                </p>
                                <input type="submit" value="登録する" name="submit" class="btn btn-success px-5 mt-4" style="width:300px">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>


<div class="container text-center">

    <h3>登録済みジャンル一覧</h3>
    <?php

    if (!isset($_GET['genre_page'])) {
        $genre_page = 1;
    } else {
        $genre_page = $_GET['genre_page'];
    }

    $total_genres = GenreLogic::getTotalGenres($user_id);

    $genres_per_page = 10;
    $starting_number = ($genre_page - 1) * $genres_per_page;
    $dbh = DbLogic::dbConnect();
    $sql = "SELECT * FROM genres WHERE user_id = :user_id LIMIT {$starting_number} , {$genres_per_page}";
    $statement = $dbh->prepare($sql);
    $statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    $genre_number_count = $starting_number + 1;
    $initial_number = $genre_number_count;
    $final_number = 0;
    ?>
    <table border="1" border-color="black" width="40%" align="center" class="table table-border table-dark table-hover">
        <thead class="thead-dark">
            <tr>
                <th>No.</th>
                <th>ジャンル</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
        </thead>

        <tbody>

            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $genre_number_count . ' '; ?></td>
                    <td><?php echo $row['genre'] . ' '; ?></td>
                    <td><?php echo "<a href='edit.php?id={$row['id']}' class='btn btn-primary px-4' style='color:white;'> " . "編集" . "</a>" . ' '; ?></td>
                    <td><?php echo "<a href='delete.php?id={$row['id']}' class= 'btn btn-danger px-4' style='color:white;'>" . "削除" . "</a>" . '</br>'; ?></td>
                    <?php $final_number = $genre_number_count; ?>
                    <?php $genre_number_count++; ?>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
    <?php $maximum_page = ceil($total_genres / $genres_per_page); ?>

    <br>
    <nav class="aria-label">
        <div class="text-center">
            <ul class="pagination pagination-md justify-content-center">
                <?php if ($total_genres > 10) : ?>
                    <?php for ($i = 1; $i <= $maximum_page; $i++) : ?>
                        <li class="page-item">
                            <a class="page-link" href='register.php?genre_page=<?php echo $i ?>'><?php echo $i ?>ページ</a>
                        </li>
                        <?php if ($i == 3) : ?>
                            <?php break; ?>
                        <?php endif ?>
                    <?php endfor ?>
                <?php endif ?>
            </ul>
        </div>
    </nav>

    <?php
    if ($total_genres === 0) {
        echo '<p>' . '<strong>0</strong>' . '  -  ' . '<strong>' . $final_number . '</strong>' . ' 件表示' . '</p>';
    } else {
        echo '<p>' . '<strong>' . $initial_number . '</strong>' . '  -  ' . '<strong>' . $final_number . '</strong>' . ' 件表示' . '</p>';
    }

    $limit_num = 30 - $total_genres;

    if ($limit_num == 0) {
        echo "<p class='alert alert-danger'>" . 'これ以上登録できません' . '</p>';
    } else {
        echo "<p class='alert alert-warning'>" . 'あと ' . '<strong>' . $limit_num . '</strong>' .  ' 個登録できます' .  '</p>';
    }

    ?>
</div>

</body>
<br><br>

<?php require_once dirname(dirname(__FILE__)) . '/inc/footer.php' ?>

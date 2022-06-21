<?php
session_start();
require_once(dirname(__FILE__) . '/inc/header.php');
?>
<?php ini_set("display_errors", 0)
?>

<div class="container-fluid">

    <?php
    if (isset($_SESSION['login_user'])) {
        $login_user = $_SESSION['login_user'];
    }
    if (UserLogic::checkLogin()) {
        echo "<p class=" . "alert-success" . ">" . "<strong>{$login_user['name']}</strong>さんがログインしています" . "</p>";
    }


    if (isset($_SESSION['register_msg'])) {
        $success = $_SESSION['register_msg']['success'];
        echo "<p class='alert alert-success'>" . $success . "</p>";
        unset($_SESSION['register_msg']);
    }

    if (isset($_SESSION['delete_msg'])) {
        $success = $_SESSION['delete_msg']['success'];
        echo "<p class='alert alert-danger'>" . $success . "</p>";
        unset($_SESSION['delete_msg']);
    }

    if (isset($_SESSION['update_msg'])) {
        $success = $_SESSION['update_msg']['success'];
        echo "<p class='alert alert-success'>" . $success . "</p>";
        unset($_SESSION['update_msg']);
    }

    if (isset($_SESSION['err_msg'])) {
        $failure = $_SESSION['err_msg']['failure'];
        echo "<p class='alert alert-danger'>" . $failure . "</p>";
        unset($_SESSION['err_msg']);
    }
    ?>

</div>

<?php if (UserLogic::checkLogin()) :
    $user_id = $_SESSION['login_user']['id']; ?>

    <div class="container-fluid">


        <hr>

        <h2 class="text-center">登録済みの本一覧</h2>
        <?php

        if (!isset($_GET['book_page'])) {
            $book_page = 1;
        } else {
            $book_page = $_GET['book_page'];
        }

        $total_books = BookLogic::getTotalBooks($user_id);


        $books_per_page = 10;
        $starting_number = ($book_page - 1) * $books_per_page;
        $dbh = DbLogic::dbConnect();
        $sql = "SELECT id,title,author,genre_id,rank,memo,lesson,vocabulary,DATE_FORMAT(created_at,'%Y/%m/%d') new_created_at FROM books WHERE user_id = :user_id LIMIT {$starting_number} , {$books_per_page}";
        $statement = $dbh->prepare($sql);
        $statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $book_number_count = $starting_number + 1;
        $initial_number = $book_number_count;
        $final_number = 0;
        $date_number = 0;
        ?>
        <table border="1" border-color="black" width="100%" class="table table-dark table-striped table-hover text-center">
            <thead class="thead-dark">
                <tr>
                    <th class="text-nowrap">No.</th>
                    <th class="text-nowrap">タイトル</th>
                    <th class="text-nowrap">著者</th>
                    <th class="text-nowrap">ジャンル</th>
                    <th class="text-nowrap">ランク</th>
                    <th class="text-nowrap">メモ</th>
                    <th class="text-nowrap">学び</th>
                    <th class="text-nowrap">語彙</th>
                    <th class="text-nowrap">登録日時</th>
                    <th class="text-nowrap">編集</th>
                    <th class="text-nowrap">削除</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) : ?>

                    <tr>
                        <td><?php echo $book_number_count . ' '; ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo $row['author'] ?></td>
                        <?php if (isset($row['genre_id'])) : ?>
                            <td><?php echo GenreLogic::getGenreName($row['genre_id']) . ' '; ?></td>
                        <?php else : ?>
                            <td style="color:red;">未選択</td>
                        <?php endif ?>
                        <?php if ($row['rank'] === "殿堂入り") : ?>
                            <td class="text-nowrap" style="color:gold"><strong><?php echo $row['rank'] ?></strong></td>
                        <?php elseif ($row['rank'] === "1軍") : ?>
                            <td class="text-nowrap" style="color:aliceblue"><strong><?php echo $row['rank'] ?></strong></td>
                        <?php elseif ($row['rank'] === "2軍") : ?>
                            <td class="text-nowrap" style="color:#C47222"><strong><?php echo $row['rank'] ?></strong></td>
                        <?php elseif ($row['rank'] === "3軍") : ?>
                            <td class="text-nowrap" style="color:blueviolet"><strong><?php echo $row['rank'] ?></strong></td>
                        <?php else : ?>
                            <td class="text-nowrap"><?php echo $row['rank'] ?></td>
                        <?php endif ?>
                        <td style="width:600px;"><?php echo lineBreak($row['memo']) ?></td>
                        <td style="width:600px;"><?php echo lineBreak($row['lesson']) ?></td>
                        <td style="width:300px;"><?php echo lineBreak($row['vocabulary']) ?></td>
                        <td><?php echo $row['new_created_at'] ?></td>
                        <td><?php echo "<a href='book/edit.php?id={$row['id']}' class='btn btn-primary text-nowrap' style='color:white;' >" . "編集" . "</a>" . ' '; ?></td>
                        <td><?php echo "<a href='book/delete.php?id={$row['id']}' class='btn btn-danger text-nowrap' style='color:white;'>" . "削除" . "</a>"; ?></td>
                        <?php $final_number = $book_number_count; ?>
                        <?php $book_number_count++; ?>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
        <br><br>
        <?php $maximum_page = ceil($total_books / $books_per_page); ?>
    </div>

    <?php if ($total_books == 0) : ?>
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12 mx-auto mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center"><strong>このアプリの使い方</strong></h3>
                            <h4 class="text-center" style="color:darkblue">『 読書のアウトプット不足解消と素晴らしい本との運命的な出会いをサポート！ 』</h4>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center">自分の好きな本のジャンルを登録する</h3>
                            <h3 class="text-center">登録したジャンルに属した本の読書ログを登録する</h3>
                            <h3 class="text-center">各ランクに読書ログが登録されたら、ランク毎のランキングが出現</h3>
                            <h3 class="text-center">出現したランキングを基に自分の傾向を把握し、以後の読書でアタリを増やす</h3>
                            <br>
                            <h3 class="text-center">まずはジャンルを登録して、はじめよう!</h3>
                            <div class="text-center">
                                <a href="<?php echo URL_ROOT ?>/genre/register.php"><input type="button" class="btn btn-success" value="ジャンルを登録する"></a>
                            </div>
                            <br>
                            <h3 class="text-center">次に本を最低4冊以上登録して、ランキングを出現させよう!</h3>
                            <div class="text-center">
                                <a href="<?php echo URL_ROOT ?>/book/register_form.php"><input type="button" class="btn btn-success" value="読書ログを登録する"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif ?>

    <div>
        <div class="row">
            <div class="col-lg-12">
                <nav class="aria-label">
                    <div class="text-center">
                        <ul class="pagination pagination-md justify-content-center">
                            <?php if ($total_books > 10) : ?>
                                <?php if ($book_page > 2) : ?>
                                    <li class="page-item">
                                        <a class="page-link" aria-label="前" href="index.php?book_page=1">
                                            <span aria-hidden="true"> |&larr;</span>
                                        </a>
                                    </li>
                                <?php endif ?>
                                <?php if ($book_page > 1) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="index.php?book_page=<?php echo $book_page - 1 ?>">
                                            &larr;</a>
                                    </li>
                                <?php endif ?>
                                <li class="page-item disabled">
                                    <span class="page-link"><?php echo $book_page ?>ページ<span>
                                </li>
                                <?php if ($book_page < $maximum_page) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="index.php?book_page=<?php echo $book_page + 1 ?>">&rarr;</a>
                                    </li>
                                <?php endif ?>
                                <?php if ($book_page < $maximum_page - 1) : ?>
                                    <li class="page-item">
                                        <a class="page-link" aria-label="次" href='index.php?book_page=<?php echo $maximum_page ?>'>
                                            <span aria-hidden="true">&rarr;|</span>
                                        </a>
                                    </li>
                                <?php endif ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <br>
        <div class="row text-center">
            <div class="col-lg-12">
                <?php echo '<strong>' . $total_books . '</strong>' .  ' 件中 ' . '<strong>' . $initial_number . '</strong>' . '  -  ' . '<strong>' . $final_number . '</strong>' . ' 件目を表示'; ?>
            </div>
        </div>
        <?php elseif ($total_books === 0) : ?>
            <div class="row text-center">
                <div class="col-lg-12">
                    <?php echo '<strong>' . $total_books . '</strong>' .  ' 件中 ' . '<strong>0</strong>' . '  -  ' . '<strong>' . $final_number . '</strong>' . ' 件目を表示'; ?>
            </div>
        </div>
    <?php else : ?>
        <div class="row text-center">
            <div class="col-lg-12">
                <?php echo '<strong>' . $total_books . '</strong>' .  ' 件中 ' . '<strong>' . $initial_number . '</strong>' . '  -  ' . '<strong>' . $final_number . '</strong>' . ' 件目を表示'; ?>
            </div>
        </div>
        <?php endif ?>
<?php else : ?>
    <?php header('Location: login_form.php'); ?>
<?php endif ?>
<br><br><br>
    </div>



    <?php require_once(dirname(__FILE__) . '/inc/footer.php'); ?>

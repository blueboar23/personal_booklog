<?php session_start() ?>
<?php require_once dirname(__FILE__) . '/inc/header.php' ?>

<?php
$user_id = $_SESSION['login_user']['id'];

// 全て
$dbh = DbLogic::dbConnect();
$sql = "SELECT count(genre_id) as all_genre_num from books where user_id = :user_id";
$statement = $dbh->prepare($sql);
$statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$all_genre_num = $statement->fetchColumn();
// 全て

// 殿堂入り
$sql = "SELECT count(genre_id) as legend_num from books where user_id = :user_id and rank = '殿堂入り'";
$statement = $dbh->prepare($sql);
$statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$legend_num = $statement->fetchColumn();
// 殿堂入り

// 1軍
$sql = "SELECT count(genre_id) as legend_num from books where user_id = :user_id and rank = '1軍'";
$statement = $dbh->prepare($sql);
$statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$first_num = $statement->fetchColumn();
// 1軍

// 2軍
$sql = "SELECT count(genre_id) as legend_num from books where user_id = :user_id and rank = '2軍'";
$statement = $dbh->prepare($sql);
$statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$second_num = $statement->fetchColumn();
// 2軍

// 3軍
$sql = "SELECT count(genre_id) as legend_num from books where user_id = :user_id and rank = '3軍'";
$statement = $dbh->prepare($sql);
$statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$third_num = $statement->fetchColumn();
// 3軍


//全部のベスト3
$sql = "SELECT genres.genre as all_of_genres from books join genres on books.genre_id = genres.id where books.user_id = :user_id";
$statement = $dbh->prepare($sql);
$statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$all_rank_lists = [];
while ($row = $statement->fetchColumn()) {
    $all_rank_lists[] = $row;
}

$all_rank_array = array_count_values($all_rank_lists);
arsort($all_rank_array);
$all_1st_place_character = key($all_rank_array);
$all_1st_place_number = array_shift($all_rank_array);

$all_2nd_place_character = key($all_rank_array);
$all_2nd_place_number = array_shift($all_rank_array);

$all_3rd_place_character = key($all_rank_array);
$all_3rd_place_number = array_shift($all_rank_array);

//全部のベスト3
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// echo '<hr>';

//殿堂入りのベスト3
$sql = "SELECT genres.genre as legend_rank_genre from books join genres on books.genre_id = genres.id where books.user_id = :user_id and books.rank = '殿堂入り'";
$statement = $dbh->prepare($sql);
$statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$legend_rank_lists = [];
while ($row = $statement->fetchColumn()) {
    $legend_rank_lists[] = $row;
}

$legend_rank_array = array_count_values($legend_rank_lists);
arsort($legend_rank_array);
$legend_1st_place_character = key($legend_rank_array);
$legend_1st_place_number = array_shift($legend_rank_array);


$legend_2nd_place_character = key($legend_rank_array);
$legend_2nd_place_number = array_shift($legend_rank_array);

$legend_3rd_place_character = key($legend_rank_array);
$legend_3rd_place_number = array_shift($legend_rank_array);


//殿堂入りのベスト3
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// echo '<hr>';

//1軍のベスト3
$sql = "SELECT genres.genre as first_rank_genre from books join genres on books.genre_id = genres.id where books.user_id = :user_id and books.rank = '1軍'";
$statement = $dbh->prepare($sql);
$statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$first_rank_lists = [];
while ($row = $statement->fetchColumn()) {
    $first_rank_lists[] = $row;
}

$first_rank_array = array_count_values($first_rank_lists);
arsort($first_rank_array);
$first_1st_place_character = key($first_rank_array);
$first_1st_place_number = array_shift($first_rank_array);

$first_2nd_place_character = key($first_rank_array);
$first_2nd_place_number = array_shift($first_rank_array);

$first_3rd_place_character = key($first_rank_array);
$first_3rd_place_number = array_shift($first_rank_array);

//1軍のベスト3
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// echo '<hr>';

//2軍のベスト3
$sql = "SELECT genres.genre as second_rank_genre from books join genres on books.genre_id = genres.id where books.user_id = :user_id and books.rank = '2軍'";
$statement = $dbh->prepare($sql);
$statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$second_rank_lists = [];
while ($row = $statement->fetchColumn()) {
    $second_rank_lists[] = $row;
}

$second_rank_array = array_count_values($second_rank_lists);
arsort($second_rank_array);
$second_1st_place_character = key($second_rank_array);
$second_1st_place_number = array_shift($second_rank_array);

$second_2nd_place_character = key($second_rank_array);
$second_2nd_place_number = array_shift($second_rank_array);

$second_3rd_place_character = key($second_rank_array);
$second_3rd_place_number = array_shift($second_rank_array);

//2軍のベスト3
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// echo '<hr>';

//3軍のベスト3
$sql = "SELECT genres.genre as third_rank_genre from books join genres on books.genre_id = genres.id where books.user_id = :user_id and books.rank = '3軍'";
$statement = $dbh->prepare($sql);
$statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$third_rank_lists = [];
while ($row = $statement->fetchColumn()) {
    $third_rank_lists[] = $row;
}

$third_rank_array = array_count_values($third_rank_lists);
arsort($third_rank_array);
$third_1st_place_character = key($third_rank_array);
$third_1st_place_number = array_shift($third_rank_array);

$third_2nd_place_character = key($third_rank_array);
$third_2nd_place_number = array_shift($third_rank_array);

$third_3rd_place_character = key($third_rank_array);
$third_3rd_place_number = array_shift($third_rank_array);

//3軍のベスト3
// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// echo '<hr>';

//1軍


?>

<hr>
<?php if ($all_genre_num > 0 && $legend_num > 0 && $first_num > 0 && $second_num > 0 && $third_num > 0) : ?>
    <div class="container">
        <h2 class="text-center">ランク別のジャンルTOP3</h2>
        <div class="row">
            <table width=80% border="1" border-color="black" class="table table-dark table-bordered text-center">
                <thead>
                    <tr style="background:linear-gradient(to right,red,orange,yellow,green,aqua,blue,purple); color:black">
                        <th>殿堂入り</th>
                        <th>ジャンル</th>
                        <th>割合 (合計<?php echo $legend_num ?>冊）</th>
                    </tr>
                </thead>
                <tbody style="color:gold;">
                    <tr>
                        <td><i class="fa-solid fa-crown"> 1位</i></td>
                        <td><?php echo $legend_1st_place_character ?></td>
                        <td><?php echo round(($legend_1st_place_number / $legend_num) * 100) ?>%(<?php echo $legend_1st_place_number ? $legend_1st_place_number : 0 ?>冊）</td>
                    </tr>
                    <tr>
                        <td style="color:white"><i class="fa-solid fa-crown"> 2位</td>
                        <td style="color:white"><?php echo $legend_2nd_place_character ?></td>
                        <td style="color:white"><?php echo round(($legend_2nd_place_number / $legend_num) * 100) ?>%(<?php echo $legend_2nd_place_number ? $legend_2nd_place_number : 0 ?>冊）</td>
                    </tr>
                    <tr>
                        <td style="color:#C47222"><i class="fa-solid fa-crown"> 3位</td>
                        <td style="color:#C47222"><?php echo $legend_3rd_place_character ?></td>
                        <td style="color:#C47222"><?php echo round(($legend_3rd_place_number / $legend_num) * 100) ?>%(<?php echo $legend_3rd_place_number ? $legend_3rd_place_number : 0 ?>冊）</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class=" row">
            <table width=80% border="1" border-color="black" class="table table-dark table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th style="background-color:azure; color:black;">全て</th>
                        <th style="background-color:azure; color:black;">ジャンル</th>
                        <th style="background-color:azure; color:black;">割合 (総計<?php echo $all_genre_num ?>冊）</th>
                        <th>1軍</th>
                        <th>ジャンル</th>
                        <th>割合 (合計<?php echo $first_num ?>冊）</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1位</td>
                        <td><?php echo $all_1st_place_character ?></td>
                        <td><?php echo round(($all_1st_place_number / $all_genre_num) * 100) ?>%(<?php echo $all_1st_place_number ? $all_1st_place_number : 0 ?>冊）</td>
                        <td>1位</td>
                        <td><?php echo $first_1st_place_character ?></td>
                        <td><?php echo round(($first_1st_place_number / $first_num) * 100) ?>%(<?php echo $first_1st_place_number ? $first_1st_place_number : 0 ?>冊）</td>
                    </tr>
                    <tr>
                        <td>2位</td>
                        <td><?php echo $all_2nd_place_character ?></td>
                        <td><?php echo round(($all_2nd_place_number / $all_genre_num) * 100) ?>%(<?php echo $all_2nd_place_number ? $all_2nd_place_number : 0 ?>冊）</td>
                        <td>2位</td>
                        <td><?php echo $first_2nd_place_character ?></td>
                        <td><?php echo round(($first_2nd_place_number / $first_num) * 100) ?>(<?php echo $first_2nd_place_number ? $first_2nd_place_number : 0 ?>冊）</td>
                    </tr>
                    <tr>
                        <td>3位</td>
                        <td><?php echo $all_3rd_place_character ?></td>
                        <td><?php echo round(($all_3rd_place_number / $all_genre_num) * 100) ?>%(<?php echo $all_3rd_place_number ? $all_3rd_place_number : 0 ?>冊）</td>
                        <td>3位</td>
                        <td><?php echo $first_3rd_place_character ?></td>
                        <td><?php echo round(($first_3rd_place_number / $first_num) * 100) ?>%(<?php echo $first_3rd_place_number ? $first_3rd_place_number : 0 ?>冊）</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <table width=80% border="1" border-color="black" class="table table-dark table-bordered text-center">
                <thead>
                    <tr class="thead-dark">
                        <th>2軍</th>
                        <th>ジャンル</th>
                        <th>割合 (合計<?php echo $second_num ?>冊）</th>
                        <th>3軍</th>
                        <th>ジャンル</th>
                        <th>割合 (合計<?php echo $third_num ?>冊）</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1位</td>
                        <td><?php echo $second_1st_place_character ?></td>
                        <td><?php echo round(($second_1st_place_number / $second_num) * 100) ?>%(<?php echo $second_1st_place_number ? $second_1st_place_number : 0 ?>冊）</td>
                        <td style="color:blueviolet">
                            <i class="fa-solid fa-skull"></i> 1位
                        </td>
                        <td style="color:blueviolet"><?php echo $third_1st_place_character ?></td>
                        <td style="color:blueviolet"><?php echo round(($third_1st_place_number / $third_num) * 100) ?>%(<?php echo $third_1st_place_number ? $third_1st_place_number : 0 ?>冊）</td>
                    </tr>
                    <tr>
                        <td>2位</td>
                        <td><?php echo $second_2nd_place_character ?></td>
                        <td><?php echo round(($second_2nd_place_number / $second_num) * 100) ?>%(<?php echo $second_2nd_place_number ? $second_2nd_place_number : 0 ?>冊）</td>
                        <td style="color:blueviolet">
                            2位
                        </td>
                        <td style="color:blueviolet"><?php echo $third_2nd_place_character ?></td>
                        <td style="color:blueviolet"><?php echo round(($third_2nd_place_number / $third_num) * 100) ?>%(<?php echo $third_2nd_place_number ? $third_2nd_place_number : 0 ?>冊）</td>
                    </tr>
                    <tr>
                        <td>3位</td>
                        <td><?php echo $second_3rd_place_character ?></td>
                        <td><?php echo round(($second_3rd_place_number / $second_num) * 100) ?>%(<?php echo $second_3rd_place_number ? $second_3rd_place_number : 0 ?>冊）</td>
                        <td style="color:blueviolet">
                            3位
                        </td>
                        <td style="color:blueviolet"><?php echo $third_3rd_place_character ?></td>
                        <td style="color:blueviolet"><?php echo round(($third_3rd_place_number / $third_num) * 100) ?>%(<?php echo $third_3rd_place_number ? $third_3rd_place_number : 0 ?>冊）</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php else : ?>
    <?php echo '<h2 class="text-center">' .  "各ランクを含んだ読書ログを1つずつ登録すれば、ランク別のジャンルの割合が出現します" . '</h2>' ?>
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
                        </div><br>
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

<br><br>
<?php require_once dirname(__FILE__) . '/inc/footer.php' ?>

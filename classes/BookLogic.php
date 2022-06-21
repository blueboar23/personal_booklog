<?php
require_once dirname(dirname(__FILE__)) . '/classes/DbLogic.php';

class BookLogic
{
    /**
     * 読書ログにデータを登録する
     * @param1 int $user_id
     * @param2 array $userData
     * @return bool true || false
     */
    public static function registerBooks($user_id,$userData)
    {
        $register_msg = [];
        $result = false;
        $sql = 'INSERT INTO books (user_id, genre_id, title, author, rank, memo, lesson, vocabulary) VALUES (:user_id, :genre_id, :title, :author, :rank, :memo, :lesson, :vocabulary)';
        try {
            $dbh = DbLogic::dbConnect();
            $statement = $dbh->prepare($sql);
            $statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
            $statement->bindValue(':genre_id', $userData['genre'], PDO::PARAM_INT);
            $statement->bindValue(':title', $userData['title'], PDO::PARAM_STR);
            $statement->bindValue(':author', $userData['author'], PDO::PARAM_STR);
            $statement->bindValue(':rank', $userData['rank'], PDO::PARAM_STR);
            $statement->bindValue(':memo', $userData['memo'], PDO::PARAM_STR);
            $statement->bindValue(':lesson', $userData['lesson'], PDO::PARAM_STR);
            $statement->bindValue(':vocabulary', $userData['vocabulary'], PDO::PARAM_STR);
            $statement->execute();
            $result = true;
            $register_msg ['success'] = '読書ログの登録に成功しました！';
        } catch (Exception $e){
            echo $e->getMessage();
        }
        $_SESSION['register_msg'] = $register_msg;
        return $result;
    }

    /**
     * ユーザーが登録した本の情報を全て取得する
     * @param int $user_id
     * @return array $results
     */
    public static function getAllBooks($user_id)
    {
        $dbh = DbLogic::dbConnect();
        $sql = "SELECT * FROM books WHERE user_id = :user_id";
        $statement = $dbh->prepare($sql);
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    /**
     * 編集した本の情報を更新する。
     * @param array $updatedData
     * @return bool true | false
     *
     */
    public static function updateBooks($updatedData)
    {
        $update_msg = [];
        $result = false;
        $sql = 'UPDATE books SET genre_id = :genre_id, title = :title, author = :author, rank = :rank, memo = :memo, lesson = :lesson, vocabulary = :vocabulary WHERE id = :id';
        try {
            $dbh = DbLogic::dbConnect();
            $statement = $dbh->prepare($sql);
            $statement->bindValue(':id', $updatedData['id'], PDO::PARAM_INT);
            $statement->bindValue(':genre_id', $updatedData['genre'], PDO::PARAM_INT);
            $statement->bindValue(':title', $updatedData['title'], PDO::PARAM_STR);
            $statement->bindValue(':author', $updatedData['author'], PDO::PARAM_STR);
            $statement->bindValue(':rank', $updatedData['rank'], PDO::PARAM_STR);
            $statement->bindValue(':memo', $updatedData['memo'], PDO::PARAM_STR);
            $statement->bindValue(':lesson', $updatedData['lesson'], PDO::PARAM_STR);
            $statement->bindValue(':vocabulary', $updatedData['vocabulary'], PDO::PARAM_STR);
            $statement->execute();
            $result = true;
            $update_msg ['success'] = '編集に成功しました！';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $_SESSION['update_msg'] = $update_msg;
        echo "<script>location.href='/index.php'</script>";
        return $result;
    }

    /**
     * ユーザーが登録した本のを一つだけ取得する
     * @param int $id & int $user_id
     * @return array $result
     */
    public static function getEachBook($id,$user_id)
    {
        $dbh = DbLogic::dbConnect();
        $sql = "SELECT * FROM books WHERE id = :id AND user_id = :user_id";
        $statement = $dbh->prepare($sql);
        $statement->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 登録した本の情報を1つ削除する
     * @param int $id
     * @return bool $result
     */
    public static function deleteEachBook($id)
    {
        $delete_msg = [];
        $result = false;
        try{
            $dbh = DbLogic::dbConnect();
            $statement = $dbh->prepare("DELETE FROM books where id = :id LIMIT 1");
            $statement->bindValue(':id', (int)$id, PDO::PARAM_INT);
            $statement->execute();
            $delete_msg ['success'] = '削除に成功しました！';
            $result = true;
        } catch (Exception $e) {
            $e->getMessage();
        }
        $_SESSION['delete_msg'] = $delete_msg;
        echo "<script>location.href='/index.php'</script>";
        return $result;
    }

    /**
     * 登録している本の個数を取得する。
     * @param int $user_id
     * @return int $total_books
     */
    public static function getTotalBooks($user_id)
    {
        $dbh = DbLogic::dbConnect();
        $sql = "SELECT COUNT(*) FROM books WHERE user_id = :user_id";
        $statement = $dbh->prepare($sql);
        $statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $total_books = $statement->fetchColumn();
        return $total_books;
    }


}

?>

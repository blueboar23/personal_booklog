<?php
require_once dirname(dirname(__FILE__)) . '/classes/DbLogic.php';

class GenreLogic
{
    /**
     * ログインしたユーザーが登録しているジャンルを全て取得する
     * @param int $user_id
     * @return array $genres
     */
    public static function getAllGenres($user_id)
    {
        $dbh = DbLogic::dbConnect();
        $sql = "SELECT * FROM genres WHERE user_id = :user_id";
        $statement = $dbh->prepare($sql);
        $statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
        $statement->execute();
        $genres = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $genres;
    }

    /**
     *ユーザーが登録しているジャンルを1つだけ取得する
     * @param int $id & int $user_id
     * @return array $genre
     */
    public static function getEachGenre($id,$user_id)
    {
        $dbh = DbLogic::dbConnect();
        $statement = $dbh->prepare('SELECT * FROM genres WHERE id= :id AND user_id=:user_id');
        $statement->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
        $statement->execute();
        $genre = $statement->fetch(PDO::FETCH_ASSOC);
        return $genre;
    }

    /**
     * フォームで選択したジャンルの名前を取得する。
     * @param int $genre_id
     * @return str $result['genre]
     */
    public static function getGenreName($genre_id)
    {
        $dbh = DbLogic::dbConnect();
        $sql = "SELECT * FROM genres WHERE id = :genre_id";
        $statement = $dbh->prepare($sql);
        $statement->bindValue(':genre_id', (int)$genre_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['genre'];
    }

    /**
     * ジャンルの個数を取得する。
     * @param int $user_id
     * @return int $total_genres
     */
    public static function getTotalGenres($user_id)
    {
        $dbh = DbLogic::dbConnect();
        $sql = "SELECT COUNT(*) FROM genres WHERE user_id = :user_id";
        $statement = $dbh->prepare($sql);
        $statement->bindValue('user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        $total_genres = $statement->fetchColumn();
        return $total_genres;
    }
}

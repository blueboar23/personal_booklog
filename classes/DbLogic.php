<?php require_once dirname(dirname(__FILE__)) . '/config/env/env.php';

class DbLogic
{
    /**
     * データベースに接続する
     * @param void
     * @return PDO instance || error message $dbh || $e->getMessage()
     */

    public static function dbConnect()
    {
        $host = DB_HOST;
        $db = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        $dbh = '';

        try {
            $dbh = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            echo '接続失敗' . $e->getMessage();
            exit();
        }
        return $dbh;
    }
}




?>

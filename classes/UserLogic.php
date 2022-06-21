<?php

require_once dirname(dirname(__FILE__)) . '/classes/DbLogic.php';


class UserLogic
{
    /**
     * ユーザを登録する
     * @param array $userData
     * @return bool $result
     */
    public static function createUser($userData)
    {
        $result = false;
        //メールアドレスが重複されているかチェック
        $isAlreadyExists = UserLogic::checkEmail($userData);
        if ($isAlreadyExists) {
            return $result;
        } else {
                $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';
                $array = [];
                $array[] = $userData['name'];
                $array[] = $userData['email'];
            $array[] = password_hash($userData['password'], PASSWORD_DEFAULT);
            try {
                $dbh = DbLogic::dbConnect();
                $statement = $dbh->prepare($sql);
                $result = $statement->execute($array);
                return $result;
            } catch (Exception $e){
                echo $e->getMessage();
                return $result;
            }
        }
    }

    /**
     *メールアドレスが既に登録されていないかチェック
     * @param string $email
     * @return bool $isAlreadyExists
     */
    public static function checkEmail($userData)
    {
        $isAlreadyExists = false;
        $sql = 'SELECT * FROM users WHERE email = ?';
        $array = [];
        $array[] = $userData['email'];

        $dbh = DbLogic::dbConnect();
        $statement = $dbh->prepare($sql);
        $statement -> execute($array);
        $result = $statement->fetch();
        if($result) {
            return $isAlreadyExists = true;
        } else {
            return $isAlreadyExists;
        }

    }


    /**
     * ログイン処理
     * @param string $email
     * @param string $password
     * @return bool $result
     */
    public static function login($email,$password)
    {
        $result = false;
        $user = self::getUserByEmail($email);

        if(!$user) {
            $_SESSION['msg'] = 'メールアドレスが違います';
            return $result;
        }

        if(password_verify($password,$user['password'])) {
            session_regenerate_id(true);
            //sessionには配列を入れられる。
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        }

        $_SESSION['msg'] = 'パスワードが違います';
        return $result;
    }

    /**
     * emailからユーザーを取得
     * @param string $email
     * @return array | bool   $user | false
     */
    public static function getUserByEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email = ?';

        $array = [];
        $array[] = $email;

        try{
            $dbh = DbLogic::dbConnect();
            $statement = $dbh->prepare($sql);
            $statement->execute($array);
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * ログイン状況をチェック
     * @param void
     * @return bool $result
     */
    public static function checkLogin() {
        $result = false;

        if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
            return $result = true;
        }
        return $result;
    }

    /**
     * ログアウト処理
     * @param void
     * @return redirect
     */
    public static function logout() {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php');
    }

}

?>

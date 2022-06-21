<?php

require_once dirname(dirname(__FILE__)) . '/classes/DbLogic.php';

//Usersテーブルの削除
function dropUsersTable() {
    $dbh = DbLogic::dbConnect();
    $statement = $dbh->query('DROP TABLE users');
}

//Usersテーブルの作成
function createUsersTable() {
    $dbh = DbLogic::dbConnect();
    $statement = $dbh->query('CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT NOW(),
    updated_at DATETIME DEFAULT NOW() ON UPDATE NOW()
    )');
}

//Genresテーブルの削除
function dropGenresTable() {
    $dbh = DbLogic::dbConnect();
    $statement = $dbh->query('DROP TABLE genres');
}

// Genresテーブルの作成
function createGenresTable() {
    $dbh = DbLogic::dbConnect();
    $statement = $dbh->query('CREATE TABLE IF NOT EXISTS genres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    genre VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT NOW(),
    updated_at DATETIME DEFAULT NOW() ON UPDATE NOW()
    )');
}


// Booksテーブルの削除
function dropBooksTable() {
    $dbh = DbLogic::dbConnect();
    $statement = $dbh->query('DROP TABLE books');
}

// Booksテーブル作成関数
function createBooksTable() {
    $dbh = DbLogic::dbConnect();
    $statement = $dbh->query('CREATE TABLE IF NOT EXISTS books(
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    genre_id INT ,
    title VARCHAR(50) NOT NULL,
    author VARCHAR(50) NOT NULL,
    rank VARCHAR(20) NOT NULL,
    memo TEXT,
    lesson TEXT,
    vocabulary VARCHAR(255),
    created_at DATETIME DEFAULT NOW(),
    updated_at DATETIME DEFAULT NOW() ON UPDATE NOW()
)');
}

function addForeignKey(){
    $dbh = DbLogic::dbConnect();
    $statement= $dbh->query('ALTER TABLE genres ADD CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE ON UPDATE CASCADE');
    $statement = $dbh->query('ALTER TABLE books ADD CONSTRAINT fk_genre_id FOREIGN KEY (genre_id) REFERENCES genres(id)
    ON DELETE SET NULL ON UPDATE CASCADE');
}


// dropBooksTable();
// dropGenresTable();
// dropUsersTable();

// createUsersTable();
// createGenresTable();
// createBooksTable();


// addForeignKey();

?>

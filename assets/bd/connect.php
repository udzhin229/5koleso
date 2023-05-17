<?php
    // $connect = mysqli_connect('localhost', 'root', '', 'tires');
    // if(!$connect) {
    //     die('Error connect');
    // }
    $dsn = "mysql:host=localhost;dbname=tires;charset=utf8mb4";
    $username = "root";
    $password = "";
    $options = [
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    try {
    $pdo = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
?>
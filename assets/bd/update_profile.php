<?php
session_start();
require_once 'connect.php';
$user_m = $_SESSION['user_mail'];

// Получить информацию о пользователе из базы данных
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
$stmt->bindValue(':email', $user_m);
$stmt->execute();
$user = $stmt->fetch();

// Сравнить каждое поле, полученное из формы, со значением, хранящимся в базе данных
$name = !empty($_POST['name']) ? $_POST['name'] : $user['name'];
$surname = !empty($_POST['surname']) ? $_POST['surname'] : $user['surname'];
$phone = !empty($_POST['phone']) ? $_POST['phone'] : $user['phone'];
// Обновить только незаполненные поля
$stmt = $pdo->prepare('UPDATE users SET name = :name, surname = :surname, phone = :phone WHERE email = :email');
$stmt->bindValue(':name', $name);
$stmt->bindValue(':surname', $surname);
$stmt->bindValue(':phone', $phone);
$stmt->bindValue(':email', $user_m);
$stmt->execute();

header('Location: /profile.php');
exit;
?>
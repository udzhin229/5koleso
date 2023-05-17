<?php
session_start();
require_once 'connect.php';

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$phone = '+' . str_replace([' ', '-', '(', ')'], '', $_POST['phone']);
$pass = $_POST['pass'];

// проверка на уникальность номера и почты
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email OR phone = :phone');
$stmt->execute(['email' => $email, 'phone' => $phone]);
$user = $stmt->fetch();

if ($user) {
  // если пользователь уже существует, выводим ошибку
  if ($user['email'] == $email) {
    echo "Почта занята";
  } elseif ($user['phone'] == $phone) {
    echo "Номер занят";
  }
} else {
  // добавление нового пользователя в базу данных
  $stmt = $pdo->prepare('INSERT INTO users (email, phone, pass, name, surname) VALUES (:email, :phone, :pass, :name, :surname)');
  $stmt->execute(['email' => $email, 'phone' => $phone, 'pass' => password_hash($pass, PASSWORD_DEFAULT), 'name' => $name, 'surname' => $surname]);

  // вывод сообщения об успешной регистрации
  echo "Регистрация успешна";
}
?>
<?php
session_start();
require_once 'connect.php';
// получение данных формы
$email = $_POST['email'];
$password = $_POST['pass'];

// запрос к БД для получения записи с такой почтой
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// проверка пароля
if (!$user) {
  // отправка ошибки на клиент
  echo json_encode(['error' => 'invalid_email']); // или 'invalid_password'
}
elseif (!password_verify($password, $user['pass'])) {
    echo json_encode(['error' => 'invalid_password']); // или 'invalid_password'
} else {
  // успешная авторизация
  session_start();
  $_SESSION['user_mail'] = $user['email'];
  echo json_encode(['success' => true]);
}
?>
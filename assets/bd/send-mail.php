<?php
session_start();
require_once 'connect.php';
// получение данных формы
$email = $_POST['email'];
$current_domain = $_SERVER['HTTP_HOST'];
$reset_link_params = 'email=' . urlencode($email) . '&key=' . md5($email . 'my_secret_key');
$reset_link_encoded = base64_encode($reset_link_params);
$reset_link = 'https://' . $current_domain . '/assets/bd/reset_password.php?params=' . $reset_link_encoded;
// запрос к БД для получения записи с такой почтой
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// проверка пароля
if (!$user) {
  // отправка ошибки на клиент
  echo json_encode(['error' => 'invalid_email']); // или 'invalid_password'
}
else {
    $to = $email;
    $subject = 'Сброс пароля на example.com';
    $message = 'Для сброса пароля на сайте nexon-space перейдите по следующей ссылке: ' . $reset_link;
    $headers = 'From: noreply@example.com' . "\r\n" .
            'Reply-To: noreply@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
    echo json_encode(['success' => true]);
}
?>
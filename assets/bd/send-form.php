<?php
// Define constants for Telegram bot API
// define('BOT_TOKEN', '6284454364:AAGeoAUWJQyBo1Oqhkxs7Rvr8KQ5F-Igycw');
// define('CHAT_ID', '-942175805');

// Устанавливаем параметры сообщения
$name = $_POST['name1'];
$phone = $_POST['phone1'];
$message = "Новая заявка!\nИмя: " . $name . "\nТелефон: " . $phone;

// Устанавливаем параметры запроса
$bot_token = '6284454364:AAGeoAUWJQyBo1Oqhkxs7Rvr8KQ5F-Igycw';
$chat_id = '-942175805';
$url = "https://api.telegram.org/bot$bot_token/sendMessage?chat_id=$chat_id&text=".urlencode($message);

// Отправляем запрос в Telegram API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Обрабатываем ответ от сервера
if (!$response) {
    echo 'Ошибка при отправке сообщения!';
} else {
    echo 'Сообщение отправлено!';
}

?>
<?php
require_once 'connect.php';
$reset_link_encoded = $_GET['params'];
$reset_link_params = base64_decode($reset_link_encoded);
parse_str($reset_link_params, $params);
$email = $params['email'];
$key = $params['key'];
$encoded_email = base64_encode($email);
// далее происходит обработка запроса на сброс пароля
if ($key !== md5($email . 'my_secret_key')) {
    die('Некорректная ссылка для сброса пароля');
}
header('Location: /?email=' . $encoded_email);
?>
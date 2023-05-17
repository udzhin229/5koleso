<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'connect.php';
// Define constants for Telegram bot API
define('BOT_TOKEN', '6284454364:AAGeoAUWJQyBo1Oqhkxs7Rvr8KQ5F-Igycw');
define('CHAT_ID', '-736633938');

// Retrieve form data
$name = $_POST['name'];
$surname = $_POST['surname'];
$phone = $_POST['phone'];
$cart = json_decode($_POST['cart-hid'], true);
$total = $_POST['cart-hid-total'];

// Check if the cart is empty
if (empty($cart)) {
  echo 'empty_cart';
  exit();
}

// Generate message body
$message = "*New order*\n\n";
$message .= "Name: $name\n";
$message .= "Surname: $surname\n";
$message .= "Phone: $phone\n\n";
$message .= "Order details:\n";
foreach ($cart as $itemId => $cartItem) {
  $img = $cartItem['img1'];
  $imageData = 'data:image/png;base64,'.$img.'';
  $img1 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
  $name = (!empty($cartItem['name'])) ? $cartItem['name'].' ' : NULL;
  $marka = (!empty($cartItem['marka'])) ? $cartItem['marka'].' ' : NULL;
  $model = (!empty($cartItem['model'])) ? $cartItem['model'].' ' : NULL;
  $gen = (!empty($cartItem['gen'])) ? $cartItem['gen'].' ' : NULL;
  $year = (!empty($cartItem['year'])) ? $cartItem['year'].' ' : NULL;
  $radius = (!empty($cartItem['radius'])) ? $cartItem['radius'].' ' : NULL;
  $price = $cartItem['price'];
  $l_c = (!empty($cartItem['l_c'])) ? ' ('.$cartItem['l_c'].')' : NULL;
  $r_s = (!empty($cartItem['r_s'])) ? '/'.$cartItem['r_s'].')' : NULL;
  $wd = (!empty($cartItem['wd'])) ? '('.$cartItem['wd'].'/' : NULL;
  $pr = (!empty($cartItem['pr'])) ? $cartItem['pr'] : NULL;
  $quantity = (!empty($cartItem['quantity'])) ? $cartItem['quantity'] : NULL;
  $message .= "- $name$marka$model$gen$year$radius$l_c$wd$pr$r_s x Кол-во: ($quantity шт)\n";
  if (isset($_SESSION['user_mail'])) {
    $userEmail = $_SESSION['user_mail'];
    $date = date('d.m.y');
    $quantity = (int) $quantity; 
    $stmt = $pdo->prepare("INSERT INTO `orders`(`email`, `name`, `img1`, `marka`, `model`, `gen`, `year`, `radius`, `price`, `width`, `profile`, `rim_size`, `load_capacity`, `quantity`, `date`) VALUES (:email, :name, :img1, :marka, :model, :gen, :year, :radius, :price, :width, :profile, :rim_size, :load_capacity, :quantity, :date)");
    $stmt->bindParam(':email', $userEmail);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':img1', $img1, PDO::PARAM_LOB);
    $stmt->bindParam(':marka', $marka);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':gen', $gen);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':radius', $radius);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':width', $cartItem['wd']);
    $stmt->bindParam(':profile', $cartItem['pr']);
    $stmt->bindParam(':rim_size', $cartItem['r_s']);
    $stmt->bindParam(':load_capacity', $cartItem['l_c']);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    }
}
echo 'ok';

// Send message to Telegram chat using cURL
$url = 'https://api.telegram.org/bot' . BOT_TOKEN . '/sendMessage';
$data = array(
    'chat_id' => CHAT_ID,
    'text' => $message,
    'parse_mode' => 'Markdown'
);
$options = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array('Content-Type: application/json')
);
$ch = curl_init($url);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
curl_close($ch);
?>
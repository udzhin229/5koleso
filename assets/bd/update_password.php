<?php
session_start();
require_once 'connect.php';
$email = base64_decode($_POST['email']);
$pass = $_POST['pass'];
$pass1 = $_POST['pass1'];

if ($pass !== $pass1) {
    $response = array('error' => 'invalid_pass');
    echo json_encode($response);
    exit;
}

$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
$sql = 'UPDATE users SET pass = :password WHERE email = :email';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':password', $hashed_pass);
$stmt->bindParam(':email', $email);
$stmt->execute();

$response = array('success' => true);
echo json_encode($response);

$pdo = null;
?>
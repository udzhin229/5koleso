<?php
require_once 'connect.php';
$id = $_POST['id'];

$query = "DELETE FROM `models` WHERE `id` = '$id'";
$pdo->query($query);

$pdo = null;
?>
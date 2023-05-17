<?php
require_once 'connect.php';

// Получаем данные из формы
$name = $_POST['name'];
$name_ru = $_POST['name_ru'];
$text = $_POST['text'];
$text_ru = $_POST['text_ru'];

// Подготовка SQL-запроса для вставки данных
$sql = "INSERT INTO feed (name, name_ru, text, text_ru) VALUES (:name, :name_ru, :text, :text_ru)";
$stmt = $pdo->prepare($sql);

// Привязка параметров
$stmt->bindParam(':name', $name);
$stmt->bindParam(':name_ru', $name_ru);
$stmt->bindParam(':text', $text);
$stmt->bindParam(':text_ru', $text_ru);

// Выполнение запроса
if ($stmt->execute()) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $stmt->errorInfo()[2];
}

// Закрытие соединения с базой данных
$pdo = null;

header("Location: /admin.php");
exit();
?>
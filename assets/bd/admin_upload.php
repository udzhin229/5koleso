<?php
require_once 'connect.php';

// Получаем данные из формы
$brand_name = $_POST['brand_name'];
$brand_image = file_get_contents($_FILES['brand_image']['tmp_name']);

// Подготовка SQL-запроса для вставки данных
$sql = "INSERT INTO car_brands (brand_name, brand_image) VALUES (:brand_name, :brand_image)";
$stmt = $pdo->prepare($sql);

// Привязка параметров
$stmt->bindParam(':brand_name', $brand_name);
$stmt->bindParam(':brand_image', $brand_image, PDO::PARAM_LOB);

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
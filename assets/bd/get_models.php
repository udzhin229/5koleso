<?php
// Подключаемся к базе данных
require_once 'connect.php';

// Получаем марку из запроса
$mark = $_POST['mark'];

// Формируем запрос на выборку моделей для указанной марки
$query = "SELECT DISTINCT model FROM models WHERE marka = :mark ORDER BY model ASC";

// Подготавливаем запрос и выполняем его
$stmt = $pdo->prepare($query);
$stmt->execute(['mark' => $mark]);

// Формируем список опций для select моделей
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$options = '';
foreach ($rows as $row) {
  $options .= "<option value='".$row['model']."'>".$row['model']."</option>";
}

// Возвращаем список опций в формате HTML
echo $options;
?>
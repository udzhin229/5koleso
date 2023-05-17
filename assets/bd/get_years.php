<?php
// Подключаемся к базе данных
require_once 'connect.php';

// Получаем марку из запроса
$model = $_POST['model'];

// Формируем запрос на выборку моделей для указанной марки
$query = "SELECT DISTINCT `gen`, `year` FROM models WHERE model = :model ORDER BY `gen`, `year` ASC";

// Подготавливаем запрос и выполняем его
$stmt = $pdo->prepare($query);
$stmt->execute(['model' => $model]);

// Формируем список опций для select моделей
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$options = '';
foreach ($rows as $row) {
  $gen = !empty($row['gen']) ? $row['gen'] . " " : "";
  $options .= "<option value='".$row['year']."'>".$gen.$row['year']."</option>";
}

// Возвращаем список опций в формате HTML
echo $options;
?>
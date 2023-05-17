<?php
require_once 'connect.php';

// Получаем идентификатор товара из параметров запроса
$itemId = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($itemId > 0) {
  // Выполняем SQL-запрос для получения данных о товаре
  $stmt = $pdo->prepare('SELECT name, name_ru, marka, img1, model, gen, year, radius FROM models WHERE id = ?');
  $stmt->execute([$itemId]);
  $product = $stmt->fetch();

  if ($product) {
    // Возвращаем данные о товаре в формате JSON
    $imageData = base64_encode($product['img1']);

    // Возвращаем данные о товаре и изображении в формате JSON
    header('Content-Type: application/json');
    echo json_encode([
      'name' => $product['name'],
      'name_ru' => $product['name_ru'],
      'marka' => $product['marka'] ? $product['marka'] : '',
      'model' => $product['model'] ? $product['model'] : '',
      'gen' => $product['gen'] ? $product['gen'] : '',
      'year' => $product['year'] ? $product['year'] : '',
      'radius' => $product['radius'] ? $product['radius'] : '',
      'img1' => $imageData,
    ]);
  } else {
    // Если товар не найден, возвращаем ошибку 404
    http_response_code(404);
    echo 'Товар не найден';
  }
} else {
  // Если идентификатор товара не указан или некорректен, возвращаем ошибку 400
  http_response_code(400);
  echo 'Некорректный идентификатор товара';
}
?>
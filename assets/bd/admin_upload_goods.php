<?php
require_once 'connect.php';

if (isset($_FILES['brand_image1']) && $_FILES['brand_image1']['error'] === UPLOAD_ERR_OK) {
    $brand_image1 = file_get_contents($_FILES['brand_image1']['tmp_name']);
} else {
    $brand_image1 = '';
}
if (isset($_FILES['brand_image2']) && $_FILES['brand_image2']['error'] === UPLOAD_ERR_OK) {
    $brand_image2 = file_get_contents($_FILES['brand_image2']['tmp_name']);
} else {
    $brand_image2 = '';
}
if (isset($_FILES['brand_image3']) && $_FILES['brand_image3']['error'] === UPLOAD_ERR_OK) {
    $brand_image3 = file_get_contents($_FILES['brand_image3']['tmp_name']);
} else {
    $brand_image3 = '';
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
else {
    $name = '';
}
if (isset($_POST['marka'])) {
    $marka = $_POST['marka'];
    if ($marka == 'Аксессуары') {
        $marka = '';
    }
}
else {
    $marka = '';
}
if (isset($_POST['model'])) {
    $model = $_POST['model'];
}
else {
    $model = '';
}
if (isset($_POST['gen'])) {
    $gen = $_POST['gen'];
}
else {
    $gen = '';
}
if (isset($_POST['year'])) {
    $year = $_POST['year'];
}
else {
    $year = '';
}
if (isset($_POST['rad'])) {
    $rad = $_POST['rad'];
}
else {
    $rad = '';
}
if (isset($_POST['price'])) {
    $price = $_POST['price'];
}
else {
    $price = '';
}
if (isset($_POST['desc'])) {
    $desc = $_POST['desc'];
    echo $desc."</br>";
    if (!empty($desc)) {
        $desc_str = implode(";", $desc);
        echo $desc_str."not</br>";
    } else {
        $desc_str = NULL;
        echo $desc_str."else</br>";
    }
} else {
    $desc_str = NULL;
}
if (isset($_POST['all_descr'])) {
    $all_descr = $_POST['all_descr'];
}
else {
    $all_descr = '';
}

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    $pdo->exec("USE tires");

    // Устанавливаем режим ошибок PDO в Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO `models` (`img1`, `img2`, `img3`, `name`, `marka`, `model`, `gen`, `year`, `radius`, `price`, `description`, `all_descr`) 
    VALUES (:img1, :img2, :img3, :name, :marka, :model, :gen, :year, :rad, :price, :desc_str, :all_descr)";

    // Подготавливаем запрос для выполнения
    $stmt = $pdo->prepare($sql);

    // Привязываем значения параметров запроса
    $stmt->bindParam(':img1', $brand_image1, PDO::PARAM_LOB);
    $stmt->bindParam(':img2', $brand_image2, PDO::PARAM_LOB);
    $stmt->bindParam(':img3', $brand_image3, PDO::PARAM_LOB);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':marka', $marka, PDO::PARAM_STR);
    $stmt->bindParam(':model', $model, PDO::PARAM_STR);
    $stmt->bindParam(':gen', $gen, PDO::PARAM_STR);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->bindParam(':rad', $rad, PDO::PARAM_INT);
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    $stmt->bindParam(':desc_str', $desc_str, PDO::PARAM_STR);
    $stmt->bindParam(':all_descr', $all_descr, PDO::PARAM_STR);

    // Выполняем запрос
    $stmt->execute();

    echo "Data inserted successfully";
} catch(PDOException $e) {
    echo "Error inserting data: " . $e->getMessage();
}
// Закрываем соединение с базой данных
header('Location: /admin.php');
$pdo = null;
exit();
?>
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
    $name = NULL;
}
if (isset($_POST['all_descr'])) {
    $all_descr = $_POST['all_descr'];
}
else {
    $all_descr = NULL;
}
if (isset($_POST['ttl_descr1'])) {
    $ttl_descr1 = $_POST['ttl_descr1'];
}
else {
    $ttl_descr1 = NULL;
}
if (isset($_POST['descr1'])) {
    $descr1 = $_POST['descr1'];
}
else {
    $descr1 = NULL;
}
if (isset($_POST['ttl_descr2'])) {
    $ttl_descr2 = $_POST['ttl_descr2'];
}
else {
    $ttl_descr2 = NULL;
}
if (isset($_POST['descr2'])) {
    $descr2 = $_POST['descr2'];
}
else {
    $descr2 = NULL;
}
if (isset($_POST['ttl_descr3'])) {
    $ttl_descr3 = $_POST['ttl_descr3'];
}
else {
    $ttl_descr3 = NULL;
}
if (isset($_POST['descr3'])) {
    $descr3 = $_POST['descr3'];
}
else {
    $descr3 = NULL;
}
if (isset($_POST['name_ru'])) {
    $name_ru = $_POST['name_ru'];
}
else {
    $name_ru = NULL;
}
if (isset($_POST['all_descr_ru'])) {
    $all_descr_ru = $_POST['all_descr_ru'];
}
else {
    $all_descr_ru = NULL;
}
if (isset($_POST['ttl_descr1_ru'])) {
    $ttl_descr1_ru = $_POST['ttl_descr1_ru'];
}
else {
    $ttl_descr1_ru = NULL;
}
if (isset($_POST['descr1_ru'])) {
    $descr1_ru = $_POST['descr1_ru'];
}
else {
    $descr1_ru = NULL;
}
if (isset($_POST['ttl_descr2_ru'])) {
    $ttl_descr2_ru = $_POST['ttl_descr2_ru'];
}
else {
    $ttl_descr2_ru = NULL;
}
if (isset($_POST['descr2_ru'])) {
    $descr2_ru = $_POST['descr2_ru'];
}
else {
    $descr2_ru = NULL;
}
if (isset($_POST['ttl_descr3_ru'])) {
    $ttl_descr3_ru = $_POST['ttl_descr3_ru'];
}
else {
    $ttl_descr3_ru = NULL;
}
if (isset($_POST['descr3_ru'])) {
    $descr3_ru = $_POST['descr3_ru'];
}
else {
    $descr3_ru = NULL;
}
if (isset($_POST['width'])) {
    $width = $_POST['width'];
}
else {
    $width = NULL;
}
if (isset($_POST['profile'])) {
    $profile = $_POST['profile'];
}
else {
    $profile = NULL;
}
if (isset($_POST['rim_size'])) {
    $rim_size = $_POST['rim_size'];
}
else {
    $rim_size = NULL;
}
if (isset($_POST['load_capacity'])) {
    $load_capacity = $_POST['load_capacity'];
}
else {
    $load_capacity = NULL;
}
if (isset($_POST['price'])) {
    $price = $_POST['price'];
}
else {
    $price = NULL;
}
if (isset($_POST['price1']) && (!empty($_POST['price1']))) {
    $price1 = $_POST['price1'];
}
else {
    $price1 = NULL;
}
$type = 'ac';
try {
    $pdo = new PDO($dsn, $username, $password, $options);
    $pdo->exec("USE tires");

    // Устанавливаем режим ошибок PDO в Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO `models` (`type`, `img1`, `img2`, `img3`, `name`, `all_descr`, `ttl_descr1`, `descr1`, `ttl_descr2`, `descr2`, `ttl_descr3`, `descr3`, `name_ru`, `all_descr_ru`, `ttl_descr1_ru`, `descr1_ru`, `ttl_descr2_ru`, `descr2_ru`, `ttl_descr3_ru`, `descr3_ru`, `width`, `profile`, `rim_size`, `load_capacity`, `price`, `price1`) 
VALUES (:type, :img1, :img2, :img3, :name, :all_descr, :ttl_descr1, :descr1, :ttl_descr2, :descr2, :ttl_descr3, :descr3, :name_ru, :all_descr_ru, :ttl_descr1_ru, :descr1_ru, :ttl_descr2_ru, :descr2_ru, :ttl_descr3_ru, :descr3_ru, :width, :profile, :rim_size, :load_capacity, :price, :price1)";

    // Подготавливаем запрос для выполнения
    $stmt = $pdo->prepare($sql);

    // Привязываем значения параметров запроса
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->bindParam(':img1', $brand_image1, PDO::PARAM_LOB);
    $stmt->bindParam(':img2', $brand_image2, PDO::PARAM_LOB);
    $stmt->bindParam(':img3', $brand_image3, PDO::PARAM_LOB);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':all_descr', $all_descr, PDO::PARAM_STR);
    $stmt->bindParam(':ttl_descr1', $ttl_descr1, PDO::PARAM_STR);
    $stmt->bindParam(':descr1', $descr1, PDO::PARAM_STR);
    $stmt->bindParam(':ttl_descr2', $ttl_descr2, PDO::PARAM_STR);
    $stmt->bindParam(':descr2', $descr2, PDO::PARAM_STR);
    $stmt->bindParam(':ttl_descr3', $ttl_descr3, PDO::PARAM_STR);
    $stmt->bindParam(':descr3', $descr3, PDO::PARAM_STR);
    $stmt->bindParam(':name_ru', $name_ru, PDO::PARAM_STR);
    $stmt->bindParam(':all_descr_ru', $all_descr_ru, PDO::PARAM_STR);
    $stmt->bindParam(':ttl_descr1_ru', $ttl_descr1_ru, PDO::PARAM_STR);
    $stmt->bindParam(':descr1_ru', $descr1_ru, PDO::PARAM_STR);
    $stmt->bindParam(':ttl_descr2_ru', $ttl_descr2_ru, PDO::PARAM_STR);
    $stmt->bindParam(':descr2_ru', $descr2_ru, PDO::PARAM_STR);
    $stmt->bindParam(':ttl_descr3_ru', $ttl_descr3_ru, PDO::PARAM_STR);
    $stmt->bindParam(':descr3_ru', $descr3_ru, PDO::PARAM_STR);
    $stmt->bindParam(':width', $width, PDO::PARAM_STR);
    $stmt->bindParam(':profile', $profile, PDO::PARAM_STR);
    $stmt->bindParam(':rim_size', $rim_size, PDO::PARAM_STR);
    $stmt->bindParam(':load_capacity', $load_capacity, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    $stmt->bindParam(':price1', $price1, PDO::PARAM_INT);

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
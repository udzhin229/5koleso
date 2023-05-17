<?php
require_once 'connect.php';
$id = $_POST['id'];
$res = $pdo->query("SELECT `img1`, `img2`, `img3` FROM models WHERE `id`=$id");
$row = $res->fetch(PDO::FETCH_ASSOC);
$name = (!empty($_POST['name'])) ? $_POST['name'] : NULL;
$marka = (!empty($_POST['marka'])) ? $_POST['marka'] : NULL;
$model = (!empty($_POST['model'])) ? $_POST['model'] : NULL;
$gen = (!empty($_POST['gen'])) ? $_POST['gen'] : NULL;
$year = (!empty($_POST['year'])) ? $_POST['year'] : NULL;
$rad = (!empty($_POST['rad'])) ? $_POST['rad'] : NULL;
$price = (!empty($_POST['price'])) ? intval($_POST['price']) : NULL;
$desc = (!empty($_POST['desc'])) ? $_POST['desc'] : NULL;

$query = "UPDATE models SET name = '$name', marka = '$marka', model = '$model', gen = '$gen', `year` = '$year', radius = '$rad', price = '$price', `description` = '$desc' WHERE id = '$id'";
$pdo->query($query);

// Проверяем, был ли загружен новый файл img1
if (isset($_FILES['brand_image1']) && $_FILES['brand_image1']['error'] === UPLOAD_ERR_OK) {
    $brand_image1 = addslashes(file_get_contents($_FILES['brand_image1']['tmp_name']));
    $query = "UPDATE models SET img1 = '$brand_image1' WHERE id = '$id'";
    $pdo->query($query);
}

// Проверяем, был ли загружен новый файл img2
if (isset($_FILES['brand_image2']) && $_FILES['brand_image2']['error'] === UPLOAD_ERR_OK) {
    $brand_image2 = addslashes(file_get_contents($_FILES['brand_image2']['tmp_name']));
    $query = "UPDATE models SET img2 = '$brand_image2' WHERE id = '$id'";
    $pdo->query($query);
}

// Проверяем, был ли загружен новый файл img3
if (isset($_FILES['brand_image3']) && $_FILES['brand_image3']['error'] === UPLOAD_ERR_OK) {
    $brand_image3 = addslashes(file_get_contents($_FILES['brand_image3']['tmp_name']));
    $query = "UPDATE models SET img3 = '$brand_image3' WHERE id = '$id'";
    $pdo->query($query);
}
$pdo = null;
?>
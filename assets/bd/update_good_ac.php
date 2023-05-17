<?php
require_once 'connect.php';
$id = $_POST['id'];
$res = $pdo->query("SELECT `img1`, `img2`, `img3` FROM models WHERE `id`=$id");
$row = $res->fetch(PDO::FETCH_ASSOC);
$name = (!empty($_POST['name'])) ? $_POST['name'] : NULL;
$name_ru = (!empty($_POST['name_ru'])) ? $_POST['name_ru'] : NULL;
$type = (!empty($_POST['marka'])) ? 'ac' : NULL;
$all_descr = (!empty($_POST['all_descr'])) ? $_POST['all_descr'] : NULL;
$ttl_descr1 = (!empty($_POST['ttl_descr1'])) ? $_POST['ttl_descr1'] : NULL;
$descr1 = (!empty($_POST['descr1'])) ? $_POST['descr1'] : NULL;
$ttl_descr2 = (!empty($_POST['ttl_descr2'])) ? $_POST['ttl_descr2'] : NULL;
$descr2 = (!empty($_POST['descr2'])) ? $_POST['descr2'] : NULL;
$ttl_descr3 = (!empty($_POST['ttl_descr3'])) ? $_POST['ttl_descr3'] : NULL;
$descr3 = (!empty($_POST['descr3'])) ? $_POST['descr3'] : NULL;
$all_descr_ru = (!empty($_POST['all_descr_ru'])) ? $_POST['all_descr_ru'] : NULL;
$ttl_descr1_ru = (!empty($_POST['ttl_descr1_ru'])) ? $_POST['ttl_descr1_ru'] : NULL;
$descr1_ru = (!empty($_POST['descr1_ru'])) ? $_POST['descr1_ru'] : NULL;
$ttl_descr2_ru = (!empty($_POST['ttl_descr2_ru'])) ? $_POST['ttl_descr2_ru'] : NULL;
$descr2_ru = (!empty($_POST['descr2_ru'])) ? $_POST['descr2_ru'] : NULL;
$ttl_descr3_ru = (!empty($_POST['ttl_descr3_ru'])) ? $_POST['ttl_descr3_ru'] : NULL;
$descr3_ru = (!empty($_POST['descr3_ru'])) ? $_POST['descr3_ru'] : NULL;
$width = (!empty($_POST['width'])) ? $_POST['width'] : NULL;
$profile = (!empty($_POST['profile'])) ? $_POST['profile'] : NULL;
$rim_size = (!empty($_POST["rim_size"])) ? $_POST["rim_size"] : NULL;
$load_capacity = (!empty($_POST["load_capacity"])) ? $_POST["load_capacity"] : NULL;
$price = (!empty($_POST["price"])) ? intval($_POST["price"]) : NULL;
$price1 = (!empty($_POST["price1"])) ? intval($_POST["price1"]) : NULL;

$query = "UPDATE models SET name = ?, name_ru = ?, type = ?, all_descr = ?, ttl_descr1 = ?, `descr1` = ?, ttl_descr2 = ?, `descr2` = ?, ttl_descr3 = ?, `descr3` = ?, all_descr_ru = ?, ttl_descr1_ru = ?, `descr1_ru` = ?, ttl_descr2_ru = ?, `descr2_ru` = ?, ttl_descr3_ru = ?, `descr3_ru` = ?, width = ?, profile = ?, `rim_size` = ?, `load_capacity` = ?, `price` = ?, `price1` = ? WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$name, $name_ru, $type, $all_descr, $ttl_descr1, $descr1, $ttl_descr2, $descr2, $ttl_descr3, $descr3, $all_descr_ru, $ttl_descr1_ru, $descr1_ru, $ttl_descr2_ru, $descr2_ru, $ttl_descr3_ru, $descr3_ru, $width, $profile, $rim_size, $load_capacity, $price, $price1, $id]);

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
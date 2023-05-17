<?php
require_once 'connect.php';

$query = "SELECT * FROM models WHERE 1=1";
$params = [];

if(!empty($_GET['mark'])) {
    $mark = $_GET['mark'];
    $query .= " AND `marka` = ?";
    $params[] = $mark;
}

if(!empty($_GET['model'])) {
    $model = $_GET['model'];
    $query .= " AND `model` = ?";
    $params[] = $model;
}

if(!empty($_GET['year'])) {
    $year = $_GET['year'];
    $query .= " AND `year` = ?";
    $params[] = $year;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Location: /catalog/catalog.php?" . http_build_query($_GET));
exit();
?>
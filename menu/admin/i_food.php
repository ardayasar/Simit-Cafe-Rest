<?php 

require '../db.php';

$food_tr = $_POST['menu_tr'];
$food_en = $_POST['menu_en'];
$food_alt_tr = $_POST['in_tr'];
$food_alt_en = $_POST['in_en'];
$price = $_POST['price'];
$cat = $_POST['cat'];

try{
    $stmt = $mysqli->prepare("INSERT INTO foods(food_tr, food_en, food_alt_tr, food_alt_en, price, category) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $food_tr, $food_en, $food_alt_tr, $food_alt_en, $price, $cat);
    $stmt->execute();
    $stmt->close();
    header('Location: /admin/index.php');
}
catch(Exception $e){
    header('Location: /admin/index.php');
}

?>
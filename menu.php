<?php
require 'db.php';


$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$acceptLang = ['tr', 'en']; 
$lang = in_array($lang, $acceptLang) ? $lang : 'en';

$categorie = $_GET['c'];

$stmt = $mysqli->prepare("SELECT category_tr, category_en FROM categories WHERE category = ?");
$stmt->bind_param("s", $categorie);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows === 0){
    header('Location: /categories.php');
}
$stmt->bind_result($cat_tr, $cat_en);
$stmt->fetch();
if($lang == "en"){
    $head_cat = $cat_en;
}
else{
    $head_cat = $cat_tr;
}
$stmt->close();

?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/menu.css">
    <title>Simit Cafe & Restaurant</title>
</head>
<body>

    <div class="place">
        <div class="header">
            <div class="logo">
                <img src="./assets/img/logo.png" height="130%">
            </div>
            <div class="name">
                <h1><?php echo $head_cat; ?></h1>
            </div>
        </div>
        <div class="menu">



<?php


try{
$stmt = $mysqli->prepare("SELECT * FROM foods WHERE category = ?");
$stmt->bind_param("s", $categorie);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows === 0) exit();
$stmt->bind_result($id, $food_tr, $food_en, $food_alt_tr, $food_alt_en, $price, $categorie); 
while($stmt->fetch()) {

    if($lang == 'tr'){
        echo '<div class="food">
                <div class="in">
                    <h2>' . $food_tr . '</h2>
                    <p>' . $food_alt_tr . '</p>
                </div>
                <div class="price">
                    <h4>' . $price . ' &#8378;</h4>
                </div>
            </div>';
    }
    else{
        echo '<div class="food">
        <div class="in">
            <h2>' . $food_en . '</h2>
            <p>' . $food_alt_en . '</p>
        </div>
        <div class="price">
            <h4>' . $price . ' &#8378;</h4>
        </div>
    </div>';
    }

}
$stmt->close();
}
catch(Exception $e){
    header('Location: /categories.php');
}

?>

</div>
    </div>
    
</body>
</html>
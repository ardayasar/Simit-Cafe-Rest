<?php
require 'db.php';


$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$acceptLang = ['tr', 'en']; 
$lang = in_array($lang, $acceptLang) ? $lang : 'en';


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cat.css">
    <title>Simit Cafe & Restaurant</title>
</head>
<body>
    
    <div class="header page-categories">
        <div class="layer">
            <img src="./assets/img/logo.png" height="100%">
        </div>
    </div>
    <br>
    <div class="categories">


    <?php

try{
    $stmt = $mysqli->prepare("SELECT * FROM categories");
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows === 0) exit();
    $rowC = $stmt->num_rows;
    $rr = 0;
    $stmt->bind_result($id, $category, $cat_tr, $cat_en, $bg); 
    while($stmt->fetch()) {
        if($lang == 'en'){
            $he = $cat_en;
        }
        else{
            $he = $cat_tr;
        }
        $rr++;
        if($rr % 2 == 0){
            echo '<a href="/menu.php?c=' . $category . '">
                    <div class="categorie" style="background-image: url(\'' . $bg . '\')">
                        <div class="layer">
                            <h2>' . $he . '</h2>
                        </div>
                    </div>
                </a>';
            echo '</div>';
        }
        else{
            echo '<div class="row">';
            echo '<a href="/menu.php?c=' . $category . '">
                    <div class="categorie" style="background-image: url(\'' . $bg . '\')">
                        <div class="layer">
                            <h2>' . $he . '</h2>
                        </div>
                    </div>
                </a>';
            if($rr == $rowC){
                echo '</div>';
            }
        }

    }
    $stmt->close();
    }
    catch(Exception $e){
        header('Location: /categories.php');
    }


    ?>




        

    </div>

    <div class="footer">
        <p>All rights reserved by Simit Cafe & Restaurant &copy; 2022</p>
    </div>

</body>
</html>
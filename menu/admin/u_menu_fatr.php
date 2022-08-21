<?php

require '../db.php';

try{
    $content_raw = file_get_contents("php://input"); // THIS IS WHAT YOU NEED
    $spl = explode("&", $content_raw);
    $id = explode("=", $spl[0])[1];
    $text = explode("=", $spl[1])[1];
    $text = urldecode($text);
    
    $stmt = $mysqli->prepare("UPDATE foods SET food_alt_tr = ? WHERE id = ?");
    $stmt->bind_param("si", $text, $id);
    $stmt->execute();
    $stmt->close();
}
catch(Exception $e){
    echo $e;
}


?>
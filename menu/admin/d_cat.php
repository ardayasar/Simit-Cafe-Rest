<?php

require '../db.php';

try{
    $id = $_GET['id']; 

    $stmt = $mysqli->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header('Location: /admin/index.php');
}
catch(Exception $e){
    echo $e;
}

?>
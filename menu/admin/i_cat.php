<?php

require '../db.php';

$ctr = $_POST['cat_tr']; 
$cen = $_POST['cat_en'];
$cca = preg_replace('/[^\00-\255]+/u', '', str_replace(" ", "_", strtolower($ctr)));
$statusMsg = '';

// File upload path
$targetDir = "../assets/img/";
$fileName = basename($_FILES["background"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$dataF = uniqid() . "." . $fileType;
$filename = $targetDir . $dataF;
if(!empty($_FILES["background"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["background"]["tmp_name"], $filename)){
            // Insert image file name into database
            $stmt = $mysqli->prepare("INSERT INTO categories(category, category_tr, category_en, background) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $cca, $ctr, $cen, $dataF);
            $stmt->execute();
            $stmt->close();
            header('Location: /admin/index.php');
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;

?>
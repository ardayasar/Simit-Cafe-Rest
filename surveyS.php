<?php

include 'db.php';

$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$acceptLang = ['tr', 'en']; 
$lang = in_array($lang, $acceptLang) ? $lang : 'en';

$user = $_POST['na_su'];
$mail = $_POST['mail'];
$service = $_POST['service'];
$idea = $_POST['idea'];

// if($user && $mail && $service && $idea){
//     echo $user;
//     echo $mail;
//     echo $service;
//     echo $idea;
// }

try{
    $stmt = $mysqli->prepare("INSERT INTO answers (user, email, service, idea) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $user, $mail, $service, $idea);
    $stmt->execute();
    $stmt->close();
}
catch(Exception $e){
    header('Location: /survey.php');
}

include "feedback_{$lang}.php";

?>
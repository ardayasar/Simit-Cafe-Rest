<?php

$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$acceptLang = ['tr', 'en']; 
$lang = in_array($lang, $acceptLang) ? $lang : 'en';

include "survey_{$lang}.php";

?>
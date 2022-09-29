<?php 
session_start();

$_SESSION['id'] = "";
$_SESSION['pseudo'] = "";
$_SESSION['email'] = "";


session_destroy();

header("Location:index.php");
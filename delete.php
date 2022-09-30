<?php 
session_start();

require_once "classes/database.php";

$idFilm = filter_input(INPUT_GET, 'film', FILTER_SANITIZE_URL);

removeFilm($idFilm);

header("Location: admin_page.php");
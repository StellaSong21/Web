<?php
session_start();
$art_store = new mysqli("localhost", "root", "", "art_store");
if ($art_store->connect_errno) {
    echo "Failed to connect to MySQL: " . $art_store->connect_error;
}
$art_store->query("set names utf8");

$userName = isset($_POST["id"]) ? $_POST["id"] : $_GET["id"];
$password = isset($_POST["p"]) ? $_POST["p"] : $_GET["p"];

$user = $art_store->query("SELECT * FROM `users` WHERE `name` = '" . $userName . "' AND `password` =  '" . $password . "'");

if (mysqli_num_rows($user) > 0) {
    $_SESSION['username'] = $userName;
    echo 'success';
}

$art_store->close();
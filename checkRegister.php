<?php
session_start();
$art_store = new mysqli("localhost", "root", "", "art_store");
if ($art_store->connect_errno) {
    echo "Failed to connect to MySQL: " . $art_store->connect_error;
}
$art_store->query("set names utf8");

$userName = isset($_POST["g"]) ? $_POST["g"] : $_GET["g"];

$user = $art_store->query("SELECT * FROM `users` WHERE `name` = '" . $userName . "'");

if (mysqli_num_rows($user) === 0) {
    $_SESSION['username'] = $userName;
    $id = $art_store->query("SELECT * FROM `users` ORDER BY `userID` DESC LIMIT 0,1");
    $row = $id->fetch_assoc();
    $art_store->query("INSERT INTO `users` (`name`,`email`,`password`,`tel`,`address`) VALUES ('"
        . $_POST["g"] . "','" . $_POST["j"] . "','" . $_POST["h"] . "','" . $_POST["k"] . "','" . $_POST["l"] . "')");

    echo 'success';
}

$art_store->close();
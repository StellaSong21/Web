<?php
session_start();
$userName = $_SESSION['username'];
$artworkID = $_POST['artworkID'];

$art_store = new mysqli("localhost", "root", "", "art_store");
if ($art_store->connect_errno) {
    echo "Failed to connect to MySQL: " . $art_store->connect_error;
}
$art_store->query("set names utf8");

$user = $art_store->query("SELECT * FROM `users` WHERE `name` ='" . $userName . "'");
$result_1 = $user->fetch_assoc();
$art_store->query("SELECT * FROM `carts` WHERE `userID` ='" . $result_1['userID'] . "' AND `artworkID` = " . $artworkID);
if (mysqli_affected_rows($art_store) === 0) {
    $art_store->query("INSERT INTO `carts` SET `userID` = " . $result_1['userID'] . ", `artworkID` = " . $artworkID);
}

<?php
session_start();
$userName = $_SESSION['username'];
$title = isset($_POST['title']) ? $_POST['title'] : $_GET['title'];

$art_store = new mysqli("localhost", "root", "", "art_store");
if ($art_store->connect_errno) {
    echo "Failed to connect to MySQL: " . $art_store->connect_error;
}
$art_store->query("set names utf8");
$user = $art_store->query("SELECT * FROM `users` WHERE `name` ='" . $userName . "'");
$result_1 = $user->fetch_assoc();

$art_work = $art_store->query("SELECT * FROM `artworks` WHERE `title` = '" . $title . "'");
$result_2 = $art_work->fetch_assoc();

$art_store->query("DELETE FROM `carts` WHERE `userID` = " . $result_1['userID'] . " AND `artworkID` = " . $result_2['artworkID']);
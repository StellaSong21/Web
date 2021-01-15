<?php
session_start();
$userName = $_SESSION['username'];

$art_store = new mysqli("localhost", "root", "", "art_store");
if ($art_store->connect_errno) {
    echo "Failed to connect to MySQL: " . $art_store->connect_error;
}
$art_store->query("set names utf8");

$user = $art_store->query("SELECT * FROM `users` WHERE `name` ='" . $userName . "'");
$result_1 = $user->fetch_assoc();

$balance = $result_1['balance'];
$totalPrice = 0;
$personCarts = $art_store->query("SELECT * FROM `carts` WHERE `userID` ='" . $result_1['userID'] . "'");

while ($result_2 = $personCarts->fetch_assoc()) {
    $artworks = $art_store->query("SELECT * FROM `artworks` WHERE `artworkID` ='" . $result_2['artworkID'] . "'");
    while ($price = $artworks->fetch_assoc()) {
        $totalPrice += $price['price'];
    }
}

if ($balance < $totalPrice) {
    echo "false";
} else {
    echo "true";
}
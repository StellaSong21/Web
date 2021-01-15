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
$personCarts = $art_store->query("SELECT * FROM `carts` WHERE `userID` =" . $result_1['userID']);
$total = 0;
$order = $art_store->query("SELECT * FROM `orders` ORDER BY `orderID` DESC LIMIT 0,1");
$order = $art_store->query("SELECT * FROM `orders` ORDER BY `orderID` DESC LIMIT 0,1");
while ($result_2 = $personCarts->fetch_assoc()) {
    $artworks = $art_store->query("SELECT * FROM `artworks` WHERE `artworkID` =" . $result_2['artworkID']);
    while ($price = $artworks->fetch_assoc()) {
        $balance -= $price['price'];
        $total += $price['price'];
        $ownerID = $price['ownerID'];
        $owner = $art_store->query("SELECT * FROM `users` WHERE `userID` =" . $ownerID);
        $ownerM = $owner->fetch_assoc();
        $art_store->query("UPDATE `users` SET `balance` = " . ($ownerM['balance'] + $price['price']) . " WHERE `userID` = " . $ownerID);
        $art_store->query("DELETE FROM `carts` WHERE `userID` = " . $result_1['userID'] . " AND `artworkID` = " . $price['artworkID']);
        while ($row = $order->fetch_assoc()) {
            $art_store->query("UPDATE `artworks` SET `orderID` =" . ($row['orderID'] + 1) . " WHERE `artworkID` =" . $result_2['artworkID']);
        }
    }
    $art_store->query("UPDATE `users` SET `balance` = " . $balance . " WHERE `name` = '" . $userName . "'");
    $art_store->query("INSERT INTO `orders` SET `ownerID` = " . $result_1['userID'] . ", `sum` = " . $total);
}

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
$personalCarts = $art_store->query("SELECT * FROM `carts` WHERE `userID` = " . $result_1['userID']);

if (mysqli_affected_rows($art_store) !== 0) {
    $change = array();
    while ($result_3 = $personalCarts->fetch_assoc()) {

        $artworks = $art_store->query("SELECT * FROM `artworks` WHERE `artworkID` =" . $result_3['artworkID']);
        while ($result_2 = $artworks->fetch_assoc()) {
            if ($result_2['orderID'] !== NULL) {
                $change[] = $result_2['title'];
            }
        }
    }
};
if ($change !== '') {
    echo implode("/", $change);
}
<?php
session_start();
$art_store = new mysqli("localhost", "root", "", "art_store");
if ($art_store->connect_errno) {
    echo "Failed to connect to MySQL: " . $art_store->connect_error;
}
$art_store->query("set names utf8");
$userName = $_SESSION["username"];
$user = $art_store->query("SELECT * FROM `users` WHERE `name` ='" . $userName . "'");
$row = $user->fetch_assoc();
$balance = $row['balance'];
$newBalance = $balance + $_POST['money'];
$art_store->query("UPDATE `users` SET `balance` = " . $newBalance . " WHERE `name` ='" . $userName . "'");

$art_store->close();

echo "success";

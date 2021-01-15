<?php

$id = isset($_POST['id']) ? $_POST['id'] : $_GET['id'];

$art_store = new mysqli("localhost", "root", "", "art_store");
if ($art_store->connect_errno) {
    echo "Failed to connect to MySQL: " . $art_store->connect_error;
}

$artwork = $art_store->query("SELECT * FROM `artworks` WHERE `artworkID` = " . $id);
while ($row = $artwork->fetch_assoc()) {
    if ($row['orderID'] == '') {
        $art_store->query("DELETE FROM `artworks` WHERE `artworkID` = " . $id);
        unlink("./img/" . $id . ".jpg");
        echo "success";
    } else {
        echo "fail";
    }
}

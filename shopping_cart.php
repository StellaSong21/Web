<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store</title>
    <link type="text/css" rel="stylesheet" href="./css/reset.css">
    <link type="text/css" rel="stylesheet" href="./css/general.css">
    <link type="text/css" rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap-theme.css">
    <link type="text/css" rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script type="application/javascript" rel="script" src="./js/jquery-3.3.1.min.js"></script>
    <script type="application/javascript" src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="./js/general.js"></script>
</head>
<body>

<?php
include "header.php";
$art_store = new mysqli("localhost", "root", "", "art_store");
if ($art_store->connect_errno) {
    echo "Failed to connect to MySQL: " . $art_store->connect_error;
}
$art_store->query("set names utf8");

if (!isset($_SESSION['username'])) {
    if (!isset($_POST['username'])) {
        echo "<script>window.location.href = './login.php'</script>";
    } else {
        $_SESSION['username'] = $_POST['username'];
        $userName = $_SESSION['username'];
    }
} else {
    $userName = $_SESSION['username'];
}

$user = $art_store->query("SELECT * FROM `users` WHERE `name` ='" . $userName . "'");
$result_1 = $user->fetch_assoc();
$goods = $art_store->query("SELECT * FROM `carts` WHERE `userID` = '" . $result_1['userID'] . "'");
?>
<div id="cartsBody">
    <div>
        <button id="payment" class="btn-primary">结款</button>
    </div>
    <br>
    <div>
        <?php
        while ($row = $goods->fetch_assoc()) {
            $art_works = $art_store->query("SELECT * FROM `artworks` WHERE `artworkID` ='" . $row['artworkID'] . "'");
            while ($art_work = $art_works->fetch_assoc()) {
                echo " <div class='col-md-12 good' id='";
                echo preg_replace("/ /", "", $art_work['title']) . "0' value = '" . $art_work['title'] . "0'>
        <img class='col-md-4' src='./img/" . $art_work['imageFileName'] . "'>
       
        <div class='col-md-8'>
            <h3>" . $art_work['title'] . "</h3>
            <br>
            <p>" . $art_work['description'] . "</p>
            <br>
            <div>价格：$" . $art_work['price'] . "</div>
            <button class='delete' id='" . preg_replace("/ /", "", $art_work['title']) . "' value='" . $art_work['title'] . "'>删除</button>
        </div>
    </div>";
            }
        }
        ?>

    </div>
    <br>

</div>
<div id="back0"></div>
<div id="balance0">
    <h5>您的余额不足</h5>
    <br>
    <input id="btAlready" type="button" value="确定">
</div>

</body>
</html>
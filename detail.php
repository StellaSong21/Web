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
?>
<div id="detailBody">
    <div id="section_7">
        <?php
        $art_store = new mysqli("localhost", "root", "", "art_store");
        if ($art_store->connect_errno) {
            echo "Failed to connect to MySQL: " . $art_store->connect_error;
        }
        $art_store->query("set names utf8");
        if (!isset($_GET['id'])) {
            echo "<script>window.location.href = 'home.php'</script>";
        } else {
            $artworkID = $_GET['id'];
        }
        $art_work = $art_store->query("SELECT * FROM `artworks` WHERE `artworkID` = '" . $artworkID . "'");
        $row = $art_work->fetch_assoc();
        if ($row['orderID'] === NULL) {
            $status = "(未售出)";
        } else {
            $status = "(已售出)";
        }
        echo "<div class='col-md-4'><img  id='" . $artworkID . "' src='./img/" . $row['imageFileName'] . "'></div><div class='col-md-4'><h3>"
            . $row['title'] . $status . "</h3><a>" . $row['artist'] . "</a><marquee direction='up' loop='-1' height='100' scrollamount='2'>"
            . $row['description'] . "</marquee><table id='detail'><caption>Product Details</caption><tr><td>PRICE：</td><td>" . $row['price'] . "</td></tr><tr><td>YEAR：</td><td>"
            . $row['yearOfWork'] . "</td></tr><tr><td>GENRE：</td><td>" . $row['genre'] . "</td></tr><tr><td>WIDTH：</td><td>"
            . $row['width'] . "</td></tr><tr><td>HEIGHT：</td><td>" . $row['height'] . "</td></tr><tr><td>VIEW：</td><td>"
            . $row['view'] . "</td></tr></table><button class='btn-block' id='addCarts' ";
        if (isset($_SESSION['username']) && $row['orderID'] === NULL) {
            echo ">加入购物车</button></div>";
        } else {
            echo "disabled>加入购物车</button></div>";
        }
        $newView = $row['view'] + 1;
        $art_store->query("UPDATE `artworks` SET `view` = $newView WHERE `artworkID` = $artworkID");
        ?>
    </div>
    <div id="back0"></div>
    <div id="already">
        <h5 id="msg"></h5>
        <br>
        <input id="btAlready" type="button" value="确定">
<!--        确定</input>-->
    </div>
    <div class="col-md-1"></div>
    <div id="section_6" class="col-md-3">
        <table>
            <tr>
                <td>流行艺术家</td>
            </tr>
            <tr>
                <td><a>Cansdio</a></td>
            </tr>
            <tr>
                <td><a>Tom</a></td>
            </tr>
            <tr>
                <td><a>Mary</a></td>
            </tr>
            <tr>
                <td><a>Mike</a></td>
            </tr>
            <tr>
                <td><a>Lily</a></td>
            </tr>
            <tr>
                <td><a>Micheal</a></td>
            </tr>
        </table>

        <table>
            <tr>
                <td>流行流派</td>
            </tr>
            <tr>
                <td><a>Claasic</a></td>
            </tr>
            <tr>
                <td><a>Cubuium</a></td>
            </tr>
            <tr>
                <td><a>Impression</a></td>
            </tr>
            <tr>
                <td><a>Banrosm</a></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
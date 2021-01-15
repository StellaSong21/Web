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
$art_store = new mysqli("localhost", "root", "", "art_store");
if ($art_store->connect_errno) {
    echo "Failed to connect to MySQL: " . $art_store->connect_error;
}
$art_store->query("set names utf8");
?>

<div id="homeBody">
    <?php
    include "header.php";
    ?>

    <!--轮播图片-->
    <div class="section_02">
        <div id="views" class="carousel slide">
            <!-- 轮播（Carousel）指标 -->
            <ol class="carousel-indicators">
                <li data-target="#views" data-slide-to="0" class="active"></li>
                <li data-target="#views" data-slide-to="1"></li>
                <li data-target="#views" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" id="img1">
                <?php
                $view1 = $art_store->query("SELECT * FROM `artworks` WHERE `orderID` IS NULL ORDER BY `view` DESC LIMIT 0,1");
                while ($row = $view1->fetch_assoc()) {
                    echo "<div class='item active'><a href='detail.php?id=" . $row['artworkID'] . "'><img src='./img/" . $row['imageFileName'] . "' alt='" . $row['title'] . "'/></a><div class='description'><p>Theme: " . $row['title'] . "</p><p>Genre: " . $row['genre'] . "</p><p>Artist: " . $row['artist'] . "</p><p>Year: " . $row['yearOfWork'] . "</p></div></div>";
                }
                $view2 = $art_store->query("SELECT * FROM `artworks` WHERE `orderID` IS NULL ORDER BY `view` DESC LIMIT 1,2");
                while ($row = $view2->fetch_assoc()) {
                    echo "<div class='item'><a href='detail.php?id=" . $row['artworkID'] . "'><img src='./img/" . $row['imageFileName'] . "' alt='" . $row['title'] . "'/></a><div class='description'><p>Theme: " . $row['title'] . "</p><p>Genre: " . $row['genre'] . "</p><p>Artist: " . $row['artist'] . "</p><p>Year: " . $row['yearOfWork'] . "</p></div></div>";
                }
                ?>
            </div>
            <!-- 轮播（Carousel）导航 -->
            <a class="left carousel-control" href="#views" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#views" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!--详情图片-->
    <div class="section_03">
        <?php
        $time = $art_store->query("SELECT * FROM `artworks` WHERE `orderID` IS NULL ORDER BY `timeReleased` DESC LIMIT 0,3");
        while ($row = $time->fetch_assoc()) {
            echo "<div class='col-md-4'><img src='./img/" . $row['imageFileName'] . "' alt='" . $row['title'] . "'/><h4>"
                . $row['title'] . "</h4><p class='cont'>" . $row['description'] . "</p><a href='detail.php?id=" . $row['artworkID'] . "'>View Details</a></div>";
        }
        ?>
    </div>

    <!--foot-->
    <footer>Copyright &copy; 2018/6/16 Song</footer>

    <?php
    $art_store->close()
    ?>
</div>

</body>
</html>
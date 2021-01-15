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
<div class="section_01">
    <!--LOGO-->
    <h1>ART STORE</h1>
    <div>Where you find <span>GENIUS</span> and <span>EXTRAORDINARY</span></div>
    <!--右侧导航栏-->
    <div class="section_04">
        <a href="home.php">首页</a>
        <a href="search.php">搜索</a>
        <?php
        if (!isset($_SESSION['username'])) {
            if (!isset($_POST['username'])) {
                ?>
                <a id="a" href="login.php" target="_parent">登陆</a>
                <a id="b" href="register.php" target="_parent">注册</a>
                <?php
            } else {
                $_SESSION['username'] = $_POST['username'];
                echo "<a href='person.php?id=" . $_SESSION['username'] . "'>" . $_SESSION['username'] . "</a><a href='shopping_cart.php?id=" . $_SESSION['username'] . "'>购物车</a><a id='f' href='out.php'>登出</a>";
            }
        } else {
            echo "<a href='person.php?id=" . $_SESSION['username'] . "' id='e'>" . $_SESSION['username'] . "</a><a href='shopping_cart.php?id=" . $_SESSION['username'] . "'>购物车</a><a id='f' href='out.php'>登出</a>";
        } ?>
    </div>
</div>
</body>
</html>
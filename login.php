<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store</title>
    <link type="text/css" rel="stylesheet" href="css/reset.css">
    <link type="text/css" rel="stylesheet" href="css/general.css">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.css">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script type="application/javascript" rel="script" src="js/jquery-3.3.1.min.js"></script>
    <script type="application/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="js/general.js"></script>
</head>
<body>
<div>
    <?php
    $art_store = new mysqli("localhost", "root", "", "art_store");
    if ($art_store->connect_errno) {
        echo "Failed to connect to MySQL: " . $art_store->connect_error;
    }
    $art_store->query("set names utf8");
    ?>

    <div class="section_02">
        <div id="views" class="carousel slide">
            <div class="carousel-inner" id="img1">
                <?php
                $view1 = $art_store->query('SELECT * FROM `artworks` ORDER BY `view` DESC LIMIT 0,1');
                while ($row = $view1->fetch_assoc()) {
                    echo "<div class='item active'><a><img src='./img/" . $row['imageFileName'] . "' alt='" . $row['title'] . "'/></a></div>";
                }
                $view2 = $art_store->query('SELECT * FROM `artworks` ORDER BY `view` DESC LIMIT 1,2');
                while ($row = $view2->fetch_assoc()) {
                    echo "<div class='item'><a><img src='./img/" . $row['imageFileName'] . "' alt='" . $row['title'] . "'/></a></div>";
                }
                ?>
            </div>
        </div>
    </div>
    <!--详情图片-->
    <div class="section_03">
        <?php
        $time = $art_store->query("SELECT * FROM `artworks` ORDER BY `timeReleased` DESC LIMIT 0,3");
        while ($row = $time->fetch_assoc()) {
            echo "<div class='col-md-4'><img src='./img/" . $row['imageFileName'] . "' alt='" . $row['title'] . "'/><h4>"
                . $row['title'] . "</h4><p class='cont'>" . $row['description'] . "</p><a>View Details</a></div>";
        }
        ?>
    </div>
    <!--foot-->
    <footer>Copyright &copy; 2018/6/16 Song</footer>

    <!--弹窗的背景-->
    <div id="back"></div>

    <!--登陆-->
    <form id="login" action="checkLogin.php" method="post">
        <div>
            <label class="col-sm-4">用户名：</label>
            <input id="c" class="col-sm-8" type="text" name="c" placeholder="请输入您的用户名">
            <p class="error error_1">请输入用户名</p>
        </div>

        <div>
            <label class="col-sm-4">密 码：</label>
            <input id="d" class="col-sm-8" type="password" name="d" placeholder="请输入您的密码">
            <p class="error error_2">请输入密码</p>
        </div>

        <div class="button">
            <div class="col-sm-2"></div>
            <button class="col-sm-4 cancel" type="button">取消</button>
            <div class="col-sm-2"></div>
            <button id="btLogin" class="col-sm-4" type="submit" disabled="disabled">登陆</button>
        </div>

    </form>

    <!--登陆失败-->
    <div id="checkLogin">
        <h4>登陆失败，您输入的用户名或密码错误</h4>
        <button type="button" class="ok">确定</button>
    </div>
</div>

</body>
</html>

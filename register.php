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
    <!--注册-->
    <form action="" id="register" method="post">
        <div>
            <label class="col-sm-4">昵称： </label>
            <input id="g" class="col-sm-8" minlength="6" maxlength="9" type="text" placeholder="6~9位,不能为纯数字或字母" name="g">
        </div>
        <p class="error error_3">请输入正确格式的昵称，6~9位，不能为纯数字或字母</p>
        <div>
            <label class="col-sm-4">密码： </label>
            <input id="h" class="col-sm-8" type="password" minlength="6" maxlength="16" placeholder="≥6位，不能与昵称相同" name="h">
        </div>
        <p class="error error_4">请输入密码,≥6位，不能为纯数字</p>
        <div>
            <label class="col-sm-4">确认密码：</label>
            <input id="i" class="col-sm-8" type="password" placeholder="确认密码">
        </div>
        <p class="error error_5">两次输入密码不一致</p>
        <div>
            <label class="col-sm-4">邮箱：</label>
            <input id="j" class="col-sm-8" type="email" placeholder="正确格式：xxxx@example.com" name="j">
        </div>
        <p class="error error_6">请输入邮箱,正确格式：xxxx@example.com</p>
        <div>
            <label class="col-sm-4">号码：</label>
            <input id="k" class="col-sm-8" type="tel" placeholder="请输入您的联系方式,格式为xxx(x)-xxxxxxx(x)" name="k">
        </div>
        <p class="error error_7">请输入您的手机号码,格式为xxx(x)-xxxxxxx(x)</p>
        <div>
            <label class="col-sm-4">地址：</label>
            <input id="l" class="col-sm-8" type="text" placeholder="请输入您的住址" name="l">
        </div>
        <p class="error error_8">地址不得为空</p>
        <div class="button">
            <div class="col-sm-2"></div>
            <button id="btRegister" class="col-sm-4" type="submit" disabled="disabled">注册</button>
            <div class="col-sm-2"></div>
            <button type="button" class="cancel col-sm-4">取消</button>
        </div>
    </form>

    <!--注册失败-->
    <div id="checkRegister">
        <h4>注册失败，该用户名已存在</h4>
        <button type="button" class="ok">确定</button>
    </div>

</div>

</body>
</html>

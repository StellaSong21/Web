<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
$art_works = $art_store->query("SELECT * FROM `artworks` WHERE `ownerID` = " . $result_1['userID']);
$buy = $art_store->query("SELECT * FROM `orders` WHERE `ownerID` = " . $result_1['userID']);
$sell = $art_store->query("SELECT * FROM `artworks` WHERE `ownerID` = " . $result_1['userID'] . " AND `orderID` != ''");
?>

<div id="personBody">
    <?php
    echo "<div class='col-md-3'>
                <p>用户：" . $result_1['name'] . "</p>
                <p>电话：" . $result_1['tel'] . "</p>
                <p>邮箱：" . $result_1['email'] . "</p>
                <p>地址：" . $result_1['address'] . "</p>
                <p>余额：$<span id='balance'>" . $result_1['balance'] . "</span></p>
                <br>
                <button id='top' type='button'>充值</button>
            </div>
            <div class='col-md-9'>
                <div class='panel-group' id='accordion'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h4 class= 'panel-title'>
                                <a data-toggle='collapse' data-parent='#accordion' href='#collapseOne'>我上传过的艺术品：</a>
                                <a href='showPublishForm.php'>上传</a>
                            </h4>
                        </div> 
                        <div id='collapseOne' class='panel-collapse collapse'>
                            <div class='panel-body'>
                                <table id='own'><tr><td>名称</td><td>上传日期</td><td>价格</td></tr>";
    while ($result_2 = $art_works->fetch_assoc()) {
        echo "<tr><td><a href='detail.php?id=" . $result_2['artworkID'] . "'>" . $result_2['title'] . "</a></td><td>"
            . $result_2['timeReleased'] . "</td><td>" . $result_2['price'] . "</td><td><button type='button'><a href='showPublishForm.php?edit=" .
            $result_2['artworkID'] . "'>修改</a></button><button class='btDelete' id='".$result_2['artworkID']."' type='button'>删除</button></td></tr>";
    }
    echo "</table>
                            </div>
                        </div>
                    </div>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h4 class='panel-title'>
                                <a data-toggle='collapse' data-parent='#accordion' href='#collapseTwo'>我购买的艺术品：</a>
                            </h4>
                        </div>
                        <div id='collapseTwo' class='panel-collapse collapse'>
                            <div class='panel-body'>
                                <table>
                                    <tr>
                                        <td>订单编号</td>
                                        <td>艺术品</td>
                                        <td>订单时间</td>
                                        <td>订单总金额</td>
                                    </tr>";
    while ($result_3 = $buy->fetch_assoc()) {
        $buyOwn = $art_store->query("SELECT * FROM `artworks` WHERE `orderID` = " . $result_3['orderID']);
        while ($result_4 = $buyOwn->fetch_assoc()) {
            echo "<tr><td>" . $result_3['orderID'] . "</td><td><a href='detail.php?id=" . $result_4['artworkID'] . "'>"
                . $result_4['title'] . "</a></td><td>" . $result_3['timeCreated'] . "</td><td>" . $result_3['sum'] . "</td></tr>";
        }
    }
    echo "</table>
                            </div>
                        </div>
                    </div>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h4 class='panel-title'>
                                <a data-toggle='collapse' data-parent='#accordion' href='#collapseThree'>我卖出的艺术品：</a>
                            </h4>
                        </div>
                        <div id='collapseThree' class='panel-collapse collapse'>
                            <div class='panel-body'>
                                <table>
                                    <tr>
                                        <td>艺术品名称</td>
                                        <td>时间</td>
                                        <td>价格</td>
                                        <td>购买人</td>
                                        <td>邮箱</td>
                                        <td>电话</td>
                                        <td>地址</td>
                                    </tr>";
    while ($result_5 = $sell->fetch_assoc()) {
        $sellItem = $art_store->query("SELECT * FROM `orders` WHERE `orderID` = " . $result_5['orderID']);
        while ($result_6 = $sellItem->fetch_assoc()) {
            $buyer = $art_store->query("SELECT * FROM `users` WHERE `userID` = " . $result_6['ownerID']);
            while ($result_7 = $buyer->fetch_assoc()) {
                echo "<tr><td><a href='detail.php?id=" . $result_5['artworkID'] . "'>" . $result_5['title'] . "</a></td><td>"
                    . $result_6['timeCreated'] . "</td><td>" . $result_5['price'] . "</td><td>" . $result_7['name'] . "</td><td>" . $result_7['email'] . "</td><td>" .
                    $result_7['tel'] . "</td><td>" . $result_7['address'] . "</td></tr>";
            }
        }
    }
    echo "                          
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>"
    ?>
</div>

<div id="back0"></div>
<form class="recharge" action="./recharge.php">
    您要充值
    <input type="number" id="number">
    元人民币
    <br>
    <input id="username" value="<?php echo $userName; ?>" style="display: none">
    <input type="submit" value='确定' id="btRecharge">

    <button type="button" id="btCancel">取消</button>
</form>

<div id="deleteAnyway">
    <h5>确定删除吗？</h5>
    <br>
    <input id="btDelete" type="button" value="确定">
</div>

<div id="fail">
    <h5>该艺术品已被拍下，无法删除</h5>
    <br>
    <input id="btFail" type="button" value="确定">
</div>
</body>
</html>
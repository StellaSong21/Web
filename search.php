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
    <script type="application/javascript" src="./js/page.js"></script>
</head>
<body>
<?php
$art_store = new mysqli("localhost", "root", "", "art_store");
if ($art_store->connect_errno) {
    echo "Failed to connect to MySQL: " . $art_store->connect_error;
}
$art_store->query("set names utf8");
?>
<div id="searchBody">
    <?php
    include "header.php";
    ?>

    <nav class="navbar navbar-default ">
        <div class="container">
            <div></div>
            <form id="search_1" class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <label>
                        <input id="title" type="checkbox" name="condition" value="title" checked>名称
                        <input id="description" type="checkbox" name="condition" value="description">简介
                        <input id="artist" type="checkbox" name="condition" value="artist">作者
                    </label>
                    <input id="key" type="text" class="form-control" placeholder="Search">
                </div>
                <button id="btSearch" type="button" class="btn">Submit</button>
            </form>
        </div>
    </nav>

    <div></div>

    <main class="container">
        <h3>搜索结果：</h3>
        <form class="text-right" id="search_2">
            <label>
                排序方式
                价格：<input type="radio" name="label" id="price" checked="checked">
                热度：<input type="radio" name="label" id="heat">
            </label>
        </form>

        <div>
            <ul class="caption-style-2" id="ul">

            </ul>
        </div>

        <div id="page">
            <button id="firstPage" class="btn-info col-md-2">FirstPage</button>
            <button id="prePage" class="btn-info col-md-2">PrePage</button>
            <button id="nextPage" class="btn-info col-md-2">NextPage</button>
            <button id="lastPage" class="btn-info col-md-2">LastPage</button>
            <div class="col-md-2"></div>
            <div id="currentPage" class="col-md-2"></div>

        </div>
    </main>

</div>
</body>
</html>
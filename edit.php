<?php
$db = new mysqli("localhost", "root", "", "art_store");
if ($db->connect_error) {
    die("连接失败！" . $db->connect_error);
}
mysqli_query($db, "set names utf8");

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
<div class="main-content" align="center">
    <?php
    session_start();
    if (isset($_SESSION['username'])) {
        if (isset($_GET['artworkID'])) {
            $artworkID = $_GET['artworkID'];
            $result = $db->query("SELECT * FROM artworks WHERE artworkID=$artworkID");
            $row = $result->fetch_assoc();
            if ($row['orderID'] != NULL) {
                echo "<script>window.location.href='./person.php'</script>";
            }
        } else {
            $artworkID = $_GET['artworkID'];
            $title = $_POST['title'];
            $artist = $_POST['artist'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $yearOfWork = $_POST['yearOfWork'];
            $width = $_POST['width'];
            $height = $_POST['height'];
            $genre = $_POST['genre'];
            $user = $_SESSION['username'];

            $sql = "SELECT * FROM artworks WHERE artworkID= '" . $artworkID . "'";
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            try {
                if (!filled_out($_POST)) {
                    throw new Exception('You have not filled the form out correctly - please go back and try again.');
                }
                if (($_FILES["image"]["type"] == "image/gif") || ($_FILES["image"]["type"] == "image/jpeg")
                    || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/png")) {
                    if ($_FILES["image"]["error"] > 0) {
                        throw new Exception('上传图片文件错误');
                    } else {
                        $filePath = "../img/" . $row['imageFileName'];
                        unlink($filePath);

                        $fileName = $_FILES['image']['name'];
                        $oldPath = $_FILES['image']['tmp_name'];
                        move_uploaded_file($oldPath, "../img/$fileName");
                    }
                } else {
                    throw new Exception('上传图片文件格式错误');
                }
                modify($title, $artist, $price, $description, $yearOfWork, $width, $height, $genre, $fileName, $artworkID);

                echo '<a href="./detail.php?id=' . $artworkID . '"><p>您已成功修改，点击查看商品详情</p></a>';
            } catch (Exception $e) {
                echo '<p>问题：<br>' . $e->getMessage() . '</p><br></a>';
            }
        }
    } else {
        echo "<script>window.location.href='./login.php'</script>";
    }

    function filled_out($form_vars)
    {
        foreach ($form_vars as $key => $value) {
            if ((!isset($key)) || ($value == '')) {
                return false;
            }
        }
        return true;
    }

    function modify($title, $artist, $price, $description, $yearOfWork, $width, $height, $genre, $fileName, $artworkID)
    {
        $db = new mysqli("localhost", "root", "", "art_store");
        if ($db->connect_error) {
            die("连接失败！" . $db->connect_error);
        }
        mysqli_query($db, "set names utf8");

//    $sql = "SELECT * FROM users WHERE users.name= '" . $user . "'";
//    $result = $db ->query($sql);
//    $row = $result ->fetch_assoc();
//    $ownerID = $row['userID'];
//    date_default_timezone_set("Asia/Shanghai");
//    $timeReleased = date("Y-m-d H:i:s",time());
//    if(!$result){
//        throw new Exception('Could not execute query.');
//    }
//    $sql = "UPDATE artworks SET orderID = $orderID WHERE artworkID=$artworkID";
        $sql1 = "UPDATE artworks SET artist='$artist',imageFileName='$fileName',title='$title',genre=$genre,description='$description',yearOfWork=$yearOfWork,width=$width,height=$height,price=$price WHERE artworkID = $artworkID";
        $result1 = $db->query($sql1);
        if (!$result1) {
            throw new Exception('Could not publish your art work - please try again later.');
        }
        return;
    }

    ?>
</div>
</body>
</html>

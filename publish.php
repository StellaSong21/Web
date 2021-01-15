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
session_start();
if(isset($_SESSION['username'])){
    $title=$_POST['title'];
    $artist = $_POST['artist'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $yearOfWork = $_POST['yearOfWork'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $genre = $_POST['genre'];
    $user = $_SESSION['username'];

    try{
        $db = new mysqli("localhost","root","","art_store");
        if($db ->connect_error){
            die("连接失败！" . $db ->connect_error);
        }
        mysqli_query($db , "set names utf8");
        if(!filled_out($_POST)){
            throw new Exception('You have not filled the form out correctly - please go back and try again.');
        }
        if (($_FILES["image"]["type"] == "image/gif") || ($_FILES["image"]["type"] == "image/jpeg")
            || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/png")) {
            if ($_FILES["image"]["error"] > 0) {
                throw new Exception('上传图片文件错误');
            } else {
                $fileName=$_FILES['image']['name'];
                $sql = "SELECT * FROM artworks WHERE imageFileName= '" . $fileName . "'";
                $result = $db ->query($sql);
                if($result ->num_rows > 0){
                    throw new Exception('该文件名艺术品已存在，请更改文件名或更改文件重新上传');
                }
                $oldPath=$_FILES['image']['tmp_name'];
                move_uploaded_file($oldPath, "./img/$fileName");
            }
        } else {
            throw new Exception('上传图片文件格式错误');
        }
        $artworkID = publish($title,$artist,$price,$description,$yearOfWork,$width,$height,$genre,$user,$fileName);
        echo '<div class="main-content" align="center"><a href="detail.php?id=' . $artworkID . '"><p>您已成功发布，点击查看</p></a><br><a href="showPublishForm.php"><p>继续发布</p></a></div>';
        }
    catch (Exception $e){
        echo '<div class="main-content" align="center"><p>问题：<br>' . $e->getMessage() . '</p><br><a href="showPublishForm.php"><p>重新发布商品</p></a></div>';
    }

}else{
    echo "<script>window.location.href='./login.php'</script>";
}

function filled_out($form_vars){
    foreach ($form_vars as $key => $value){
        if((!isset($key)) || ($value == '')){
            return false;
        }
    }
    return true;
}

function publish($title,$artist,$price,$description,$yearOfWork,$width,$height,$genre,$user,$fileName){
    $db = new mysqli("localhost","root","","art_store");
    if($db ->connect_error){
        die("连接失败！" . $db ->connect_error);
    }
    mysqli_query($db , "set names utf8");

    $sql = "SELECT * FROM users WHERE users.name= '" . $user . "'";
    $result = $db ->query($sql);
    $row = $result ->fetch_assoc();
    $ownerID = $row['userID'];
    $view = 0;
    date_default_timezone_set("Asia/Shanghai");
    $timeReleased = date("Y-m-d H:i:s",time());
    if(!$result){
        throw new Exception('Could not execute query.');
    }
    $sql1 = "INSERT INTO artworks(artist,imageFileName,title, genre, description, yearOfWork, width, height,price ,view, ownerID,timeReleased) VALUES 
              ('".$artist."','".$fileName."','".$title."','".$genre."','".$description."','".$yearOfWork."','".$width."','".$height."','".$price."','".$view."','".$ownerID."','".$timeReleased."')";
    $result1 = $db ->query($sql1);
    if(!$result1){
        throw new Exception('Could not publish your art work - please try again later.');
    }
    return mysqli_insert_id($db);
}
?>
</body>
</html>
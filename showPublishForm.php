<?php
session_start();
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
    <link type="text/css" rel="stylesheet" href="css/reset.css">
    <link type="text/css" rel="stylesheet" href="css/general.css">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.css">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script type="application/javascript" rel="script" src="js/jquery-3.3.1.min.js"></script>
    <script type="application/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="js/general.js"></script>
    <script type="application/javascript" src="js/publishJudge.js"></script>
</head>
<body>
<?php
include('header.php');
?>

<?php
if ((isset($_SESSION['username']))) {
    if (!isset($_GET['edit'])) {
        $edit = false;
    } else {
        $edit = true;
        $artworkID = $_GET['edit'];
        $result = $db->query("SELECT * FROM artworks WHERE artworkID=$artworkID");
        $row = $result->fetch_assoc();
        if ($row['orderID'] != NULL) {
            echo "<script>window.location.href = edit.php" . $row['artworkID'] . "';</script>";
        }
    }
    ?>

    <div id="form">
        <form method="post" action="<?php echo $edit ? 'edit.php?artworkID=' . $artworkID : 'publish.php'; ?>"
              onsubmit="return publish()" enctype="multipart/form-data">
            <fieldset class="form-group">
                <h3>Publish Works</h3>
                <label for="title">Title</label>
                <input class="form-control" name="title" id="title" onchange="checkTitle()" type="text"
                       value="<?php echo htmlspecialchars($edit ? $row['title'] : ''); ?>" placeholder="Title">
                <p id="text1"></p>
                <label for="artist">Artist</label>
                <input class="form-control" name="artist" id="artist" onchange="checkArtist()" type="text"
                       value="<?php echo htmlspecialchars($edit ? $row['artist'] : ''); ?>" placeholder="Artist">
                <p id="text2"></p>
                <label for="price">Price</label>
                <input class="form-control" name="price" id="price" onchange="checkPrice()" min="1" type="number"
                       value="<?php echo htmlspecialchars($edit ? $row['price'] : ''); ?>" placeholder="Price">
                <p id="text3"></p>
                <label for="description">Description</label>
                <textarea class="form-control" name="description" onchange="checkDescription()" id="description"
                          placeholder="Description"><?php echo htmlspecialchars($edit ? $row['description'] : ''); ?></textarea>
                <p id="text4"></p>
                <label for="yearOfWork">Year of work</label>
                <input class="form-control" name="yearOfWork" id="yearOfWork" onchange="checkYearOfWork()" min="1"
                       type="number" value="<?php echo htmlspecialchars($edit ? $row['yearOfWork'] : ''); ?>"
                       placeholder="Year of work">
                <p id="text5"></p>
                <label for="width">Width</label>
                <input class="form-control" name="width" id="width" onchange="checkWidth()" min="1" type="number"
                       value="<?php echo htmlspecialchars($edit ? $row['width'] : ''); ?>" placeholder="Width">
                <p id="text6"></p>
                <label for="height">Height</label>
                <input class="form-control" name="height" id="height" onchange="checkHeight()" min="1" type="number"
                       value="<?php echo htmlspecialchars($edit ? $row['height'] : ''); ?>" placeholder="Height">
                <p id="text7"></p>
                <label for="genre">Genre</label>
                <input class="form-control" name="genre" id="genre" onchange="checkGenre()" type="text"
                       value="<?php echo htmlspecialchars($edit ? $row['genre'] : ''); ?>" placeholder="Genre">
                <p id="text9"></p>

                <label for="image">Select image</label>
                <input class="form-control" name="image" id="image" type="file" onchange="checkImage()">
                <p id="text8"></p>
                <div id="div">
                    <img id="img" width="400px"
                         src="<?php echo htmlspecialchars($edit ? ("./img/" . $row['imageFileName']) : ''); ?>"><br>
                </div>
                <br>
                <div class="btn-group">
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </fieldset>
        </form>
    </div>
    <?php
} else {
    echo "<script>window.location.href='./login.php'</script>";
}
?>
</body>
</html>

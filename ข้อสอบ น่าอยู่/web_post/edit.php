<?php
require_once('libs/connect.class.php');
session_start();
$username = $_SESSION['username'];
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="container">
        <h1>Edit Post</h1>
        <?php if (isset($_SESSION['username'])) { ?>
            <h3 align="center">for: <?= $username ?></h3>
        <?php } ?>


        <?php
        if (isset($_GET['p_id'])) 
            $p_id = $_GET['p_id'];
        
            $db = new ConnectDb();
            $conn = $db->getConn();

        $sql = "SELECT * FROM posts
        where p_id = '$p_id'";
        $rs = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($rs);
        ?>
        <form action="crud/editsuc.php" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= $data['title'] ?>"><br>

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="10" cols="10"><?= htmlspecialchars($data['content']) ?></textarea>
<br><br>
            <input type="hidden" id="u_id" name="u_id" value="<?= $id ?>">
            <input type="hidden" id="p_id" name="p_id" value="<?= $p_id ?>">
            <input type="submit" value="Edit Post">
        </form>
        <a href="index.php" class="button" id="login" style="background-color: blue; margin-top: -2.5%;">Back</a>

    </div>
</body>

</html>
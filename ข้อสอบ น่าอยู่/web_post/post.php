<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>";
    echo "alert('กรุณาเข้าสู่ระบบ');";
    echo "window.location='index.php';";
    echo "</script>";
    exit;
}

$username = $_SESSION['username'];
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Create a New Post</h1>
        <?php if (isset($_SESSION['username'])) { ?>
            <h3 align="center">for: <?= $username ?></h3>
        <?php } ?>
        <form action="crud/save_post.php" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>
            
            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea><br><br>
            <input type="hidden" id="u_id" name="u_id" value="<?= $id ?>">
            <input type="submit" value="Create Post">
            
        </form>
        <a href="index.php" class="button" id="login" style="background-color: blue; margin-top: -2.5%;">Back</a>
    </div>
</body>
</html>

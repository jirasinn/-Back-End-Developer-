<?php
// รวมไฟล์ที่มีคลาส ConnectDb สำหรับการเชื่อมต่อฐานข้อมูล
require_once('libs/connect.class.php');

// เริ่มเซสชันเพื่อใช้งานตัวแปรเซสชัน
session_start();

// ดึงชื่อผู้ใช้และ ID จากตัวแปรเซสชัน
$username = $_SESSION['username'];
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="styles.css"> <!-- เชื่อมโยงกับไฟล์ CSS -->
</head>

<body>

    <div class="container">
        <h1>Edit Post</h1>

        <!-- ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้วหรือไม่ และแสดงชื่อผู้ใช้ -->
        <?php if (isset($_SESSION['username'])) { ?>
            <h3 align="center">for: <?= htmlspecialchars($username) ?></h3>
        <?php } ?>

        <?php
        // ตรวจสอบว่ามีการส่งพารามิเตอร์ p_id มาจาก URL หรือไม่
        if (isset($_GET['p_id'])) {
            $p_id = $_GET['p_id'];

            // สร้างการเชื่อมต่อฐานข้อมูล
            $db = new ConnectDb();
            $conn = $db->getConn();

            // สร้างคำสั่ง SQL เพื่อดึงข้อมูลโพสต์ที่ตรงกับ p_id
            $sql = "SELECT * FROM posts WHERE p_id = '$p_id'";
            $rs = mysqli_query($conn, $sql);

            // ดึงข้อมูลโพสต์จากผลลัพธ์ของคำสั่ง SQL
            $data = mysqli_fetch_array($rs);
        }
        ?>

        <!-- แบบฟอร์มสำหรับแก้ไขโพสต์ -->
        <form action="crud/editsuc.php" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($data['title']) ?>"><br>

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="10" cols="10"><?= htmlspecialchars($data['content']) ?></textarea>
            <br><br>
            <!-- ซ่อนค่า u_id และ p_id สำหรับการส่งไปยังสคริปต์แก้ไขโพสต์ -->
            <input type="hidden" id="u_id" name="u_id" value="<?= htmlspecialchars($id) ?>">
            <input type="hidden" id="p_id" name="p_id" value="<?= htmlspecialchars($p_id) ?>">
            <input type="submit" value="Edit Post">
        </form>
        <!-- ลิงค์กลับไปที่หน้า index.php -->
        <a href="index.php" class="button" id="login" style="background-color: blue; margin-top: -2.5%;">Back</a>

    </div>
</body>

</html>

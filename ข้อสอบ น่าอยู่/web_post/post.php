<?php
// เริ่มต้นเซสชัน
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    // หากผู้ใช้ยังไม่เข้าสู่ระบบ, แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปยังหน้า index.php
    echo "<script>";
    echo "alert('กรุณาเข้าสู่ระบบ');";
    echo "window.location='index.php';";
    echo "</script>";
    exit; // หยุดการทำงานของสคริปต์
}

// ดึงชื่อผู้ใช้และ ID ของผู้ใช้จากเซสชัน
$username = $_SESSION['username'];
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <!-- เชื่อมโยงไฟล์ CSS สำหรับการจัดรูปแบบ -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Create a New Post</h1>
        <!-- แสดงชื่อผู้ใช้ที่เข้าสู่ระบบ -->
        <?php if (isset($_SESSION['username'])) { ?>
            <h3 align="center">for: <?= htmlspecialchars($username) ?></h3>
        <?php } ?>
        
        <!-- ฟอร์มสำหรับการสร้างโพสต์ใหม่ -->
        <form action="crud/save_post.php" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>
            
            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea><br><br>
            
            <!-- ส่ง ID ของผู้ใช้เป็นข้อมูลซ่อนเพื่อให้ฟอร์มสามารถส่งไปยังเซิร์ฟเวอร์ได้ -->
            <input type="hidden" id="u_id" name="u_id" value="<?= htmlspecialchars($id) ?>">
            
            <input type="submit" value="Create Post">
        </form>
        
        <!-- ลิงค์กลับไปที่หน้าแรก -->
        <a href="index.php" class="button" id="login" style="background-color: blue; margin-top: -2.5%;">Back</a>
    </div>
</body>
</html>

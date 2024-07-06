<?php
// ตรวจสอบว่าฟอร์มได้ถูกส่งหรือไม่
$isSubmitted = isset($_POST["login"]);

if ($isSubmitted) {
    // รวมไฟล์ที่มีคลาส ConnectDb สำหรับการเชื่อมต่อฐานข้อมูล
    require_once('libs/connect.class.php');
    // เริ่มเซสชัน
    session_start();

    // สร้างการเชื่อมต่อฐานข้อมูล
    $db = new ConnectDb();
    $conn = $db->getConn();

    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ดึงข้อมูลจากฟอร์ม
    $username = $_POST['username'];
    $password = $_POST['password'];

    // สร้างคำสั่ง SQL เพื่อค้นหาผู้ใช้ที่มีชื่อผู้ใช้ตรงกัน
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    // ตรวจสอบว่ามีผู้ใช้ที่ตรงตามชื่อผู้ใช้หรือไม่
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // ตรวจสอบรหัสผ่านที่ป้อนมาว่าตรงกับรหัสผ่านที่เก็บไว้ในฐานข้อมูลหรือไม่
        if (password_verify($password, $row['password'])) {
            // หากรหัสผ่านถูกต้อง, เริ่มเซสชันและเปลี่ยนเส้นทางไปที่หน้า index.php
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            header("Location: index.php");
            exit();
        } else {
            // แสดงข้อความหากรหัสผ่านไม่ถูกต้อง
            echo "Invalid password.";
        }
    } else {
        // แสดงข้อความหากไม่พบผู้ใช้ที่ตรงตามชื่อผู้ใช้
        echo "No user found with that username.";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- เชื่อมโยงไฟล์ CSS -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <!-- ฟอร์มสำหรับการเข้าสู่ระบบ -->
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <div class="row" align="center">
                <input type="submit" value="Login" name="login">
            </div>
        </form>

        <br>
        <!-- ลิงค์สำหรับลงทะเบียนผู้ใช้ใหม่ -->
        <div class="row" align="center">
            <a href="register.php" style="background-color: gray; padding: 5px 10px; display: inline-block; color: white; text-decoration: none;">Register</a>
        </div><br>
        <!-- ลิงค์สำหรับกลับไปที่หน้าแรก -->
        <div class="row" align="center">
            <a href="index.php" style="background-color: blue; padding: 5px 10px; display: inline-block; color: white; text-decoration: none;">back home</a>
        </div>
    </div>
</body>

</html>

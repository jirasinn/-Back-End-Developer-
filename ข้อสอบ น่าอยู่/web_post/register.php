<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- เชื่อมโยงไฟล์ CSS สำหรับการจัดรูปแบบ -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        
        <!-- ฟอร์มสำหรับการลงทะเบียน -->
        <form action="crud/regissuc.php" method="post">
            <label for="username">Username:</label>
            <!-- ฟิลด์สำหรับป้อนชื่อผู้ใช้ -->
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Password:</label>
            <!-- ฟิลด์สำหรับป้อนรหัสผ่าน -->
            <input type="password" id="password" name="password" required><br><br>
            
            <!-- ปุ่มส่งข้อมูลฟอร์ม -->
            <input type="submit" value="Register">
        </form>

        <!-- ลิงค์สำหรับกลับไปที่หน้าแรก -->
        <a href="index.php" class="button" id="login" style="background-color: blue; margin-top: -2.5%;">Back</a>

    </div>
</body>
</html>

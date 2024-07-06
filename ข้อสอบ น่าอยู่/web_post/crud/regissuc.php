<?php
// รวมไฟล์ที่มีคลาส ConnectDb สำหรับการเชื่อมต่อฐานข้อมูล
require_once('../libs/connect.class.php');

// สร้างอ็อบเจ็กต์ ConnectDb และเชื่อมต่อฐานข้อมูล
$db = new ConnectDb();
$conn = $db->getConn();

// ตรวจสอบการเชื่อมต่อฐานข้อมูล และหยุดการทำงานหากเชื่อมต่อไม่สำเร็จ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่า username และทำการ hash password ที่รับมาจากแบบฟอร์ม
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูลผู้ใช้ใหม่ลงในตาราง users
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

// ดำเนินการคำสั่ง SQL และตรวจสอบผลลัพธ์
if ($conn->query($sql) === TRUE) {
    // หากลงทะเบียนสำเร็จ แสดงกล่องข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปที่หน้า login.php
    echo "
    <script>
       alert('ลงทะเบียนเรียบร้อยแล้ว');
       window.location='../login.php';
       exit;
    </script>
    ";
} else {
    // หากเกิดข้อผิดพลาดในการลงทะเบียน แสดงข้อผิดพลาดและคำสั่ง SQL ที่ใช้
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>

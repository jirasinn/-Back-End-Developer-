<?php
// รวมไฟล์ที่มีคลาส ConnectDb สำหรับการเชื่อมต่อฐานข้อมูล
require_once('../libs/connect.class.php');

// สร้างอ็อบเจ็กต์ ConnectDb และเชื่อมต่อฐานข้อมูล
$db = new ConnectDb();
$conn = $db->getConn();

// ตรวจสอบการเชื่อมต่อฐานข้อมูล และหยุดการทำงานหากเชื่อมต่อไม่สำเร็จ
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลผิดพลาด: " . $conn->connect_error);
}

// รับค่าจากแบบฟอร์มที่ส่งมาผ่าน POST
$title = $_POST['title'];
$content = $_POST['content'];
$u_id = $_POST['u_id'];

// สร้างคำสั่ง SQL สำหรับเพิ่มโพสต์ใหม่ลงในตาราง posts
$sql = "INSERT INTO posts (u_id, title, content) VALUES ('$u_id', '$title', '$content')";

// ดำเนินการคำสั่ง SQL และตรวจสอบผลลัพธ์
if ($conn->query($sql) === TRUE) {
    // หากสร้างโพสต์ใหม่สำเร็จ แสดงกล่องข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปที่หน้า index.php
    echo "
    <script>
       alert('สร้างโพสต์ใหม่สำเร็จ');
       window.location='../index.php';
       exit;
    </script>
    ";
} else {
    // หากเกิดข้อผิดพลาดในการสร้างโพสต์ แสดงข้อผิดพลาดและคำสั่ง SQL ที่ใช้
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>

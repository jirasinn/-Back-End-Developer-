<?php
// รวมไฟล์ที่มีคลาส ConnectDb สำหรับการเชื่อมต่อฐานข้อมูล
require_once('../libs/connect.class.php');

// สร้างอ็อบเจ็กต์ ConnectDb และรับการเชื่อมต่อฐานข้อมูล
$db = new ConnectDb();
$conn = $db->getConn();

// ตรวจสอบการเชื่อมต่อฐานข้อมูล หากมีข้อผิดพลาดให้หยุดการทำงานของสคริปต์และแสดงข้อความผิดพลาด
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลผิดพลาด: " . $conn->connect_error);
}

// รับค่าจากแบบฟอร์มที่ส่งมาผ่าน POST
$title = $_POST['title'];
$content = $_POST['content'];
$u_id = $_POST['u_id'];
$p_id = $_POST['p_id'];

// สร้างคำสั่ง SQL สำหรับอัปเดตข้อมูลในตาราง posts โดยใช้ p_id เป็นเงื่อนไข
$sql = "UPDATE posts SET 
    u_id = '$u_id',
    title = '$title',
    content = '$content'
    WHERE p_id = $p_id";

// ดำเนินการคำสั่ง SQL และตรวจสอบผลลัพธ์
if ($conn->query($sql) === TRUE) {
    // หากอัปเดตข้อมูลสำเร็จ แสดงกล่องข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปที่ index.php
    echo "
    <script>
       alert('แก้ไขโพสต์สำเร็จ');
       window.location='../index.php';
       exit;
    </script>
    ";
} else {
    // หากเกิดข้อผิดพลาดในการอัปเดตข้อมูล แสดงข้อผิดพลาดและคำสั่ง SQL ที่ใช้
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>

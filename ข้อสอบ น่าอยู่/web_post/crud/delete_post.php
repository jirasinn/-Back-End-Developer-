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

// ตรวจสอบว่ามีการส่งพารามิเตอร์ p_id มาจาก URL หรือไม่
if (isset($_GET['p_id'])) {
    // เก็บค่าของ p_id ที่ส่งมาจาก URL
    $p_id = $_GET['p_id'];

    // สร้างคำสั่ง SQL สำหรับลบข้อมูลจากตาราง posts โดยใช้ p_id เป็นเงื่อนไข
    $sql = "DELETE FROM posts WHERE p_id='$p_id'";

    // ดำเนินการคำสั่ง SQL และตรวจสอบผลลัพธ์
    if ($conn->query($sql) === TRUE) {
        // หากลบข้อมูลสำเร็จ แสดงกล่องข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปที่ index.php
        echo "<script>";
        echo "alert('ลบข้อมูลสำเร็จ');";
        echo "window.location='../index.php'";
        echo "</script>";
    } else {
        // หากเกิดข้อผิดพลาดในการลบข้อมูล แสดงข้อผิดพลาดและเปลี่ยนเส้นทางไปที่ index.php
        echo "<script>";
        echo "alert('เกิดข้อผิดพลาดในการลบข้อมูล: " . $conn->error . "');";
        echo "window.location='../index.php'";
        echo "</script>";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
}
?>

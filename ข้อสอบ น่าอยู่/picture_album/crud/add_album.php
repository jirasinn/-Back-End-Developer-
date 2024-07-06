<?php
// โหลดไฟล์เชื่อมต่อฐานข้อมูล
require_once('../libs/connect.class.php');

// สร้างอ็อบเจ็กต์ของคลาส ConnectDb และรับการเชื่อมต่อฐานข้อมูล
$db = new ConnectDb();
$conn = $db->getConn();

// รับข้อมูลจากฟอร์มที่ส่งมาโดยใช้ POST
$name = $_POST['name'];
$description = $_POST['description'];

// คำสั่ง SQL สำหรับแทรกข้อมูลอัลบั้มใหม่เข้าสู่ตาราง albums
$sql = "INSERT INTO albums (name, description) VALUES ('$name', '$description')";

// ดำเนินการคำสั่ง SQL และตรวจสอบว่าการแทรกข้อมูลสำเร็จหรือไม่
if (mysqli_query($conn, $sql)) {
    // แสดงข้อความแจ้งเตือนเมื่อการแทรกข้อมูลสำเร็จ และเปลี่ยนเส้นทางกลับไปยังหน้า index.php
    echo "
    <script>
        alert('สร้างอัลบั้มสำเร็จ');
        window.location.href = '../index.php';
    </script>";
} else {
    // แสดงข้อความข้อผิดพลาดหากการแทรกข้อมูลไม่สำเร็จ
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>

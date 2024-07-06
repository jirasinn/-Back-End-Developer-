<?php
// โหลดไฟล์เชื่อมต่อฐานข้อมูล
require_once('../libs/connect.class.php');

// สร้างอ็อบเจ็กต์ของคลาส ConnectDb และรับการเชื่อมต่อฐานข้อมูล
$db = new ConnectDb();
$conn = $db->getConn();

// รับข้อมูลจากฟอร์มที่ส่งมาโดยใช้ POST
$album_id = $_POST['album_id'];
$image_id = $_POST['image_id'];

// คำสั่ง SQL สำหรับแทรกข้อมูลรูปภาพเข้าสู่ตาราง album_images
$sql = "INSERT INTO album_images (album_id, image_id) VALUES ('$album_id', '$image_id')";

// ดำเนินการคำสั่ง SQL และตรวจสอบว่าการแทรกข้อมูลสำเร็จหรือไม่
if (mysqli_query($conn, $sql)) {
    // แสดงข้อความแจ้งเตือนเมื่อการแทรกข้อมูลสำเร็จ และเปลี่ยนเส้นทางกลับไปยังหน้า index.php
    echo "
    <script>
        alert('เพิ่มรูปภาพในอัลบั้มสำเร็จ');
        window.location.href = '../index.php';
    </script>";
} else {
    // แสดงข้อความข้อผิดพลาดหากการแทรกข้อมูลไม่สำเร็จ
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>

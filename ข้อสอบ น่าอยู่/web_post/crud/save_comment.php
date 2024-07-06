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

// รับค่าจากแบบฟอร์มที่ส่งมาผ่าน POST
$post_id = $_POST['post_id'];
$u_name = $_POST['u_name'];
$comment = $_POST['comment'];

// สร้างคำสั่ง SQL สำหรับเพิ่มความคิดเห็นใหม่ลงในตาราง comments
$sql = "INSERT INTO comments (post_id, u_name, comment) VALUES ('$post_id', '$u_name', '$comment')";

// ดำเนินการคำสั่ง SQL และตรวจสอบผลลัพธ์
if ($conn->query($sql) === TRUE) {
    // หากเพิ่มความคิดเห็นสำเร็จ ให้ดึงความคิดเห็นทั้งหมดที่เกี่ยวข้องกับ post_id นี้และจัดเรียงตามวันที่
    $comment_sql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at DESC";
    $comment_result = $conn->query($comment_sql);

    // ตรวจสอบว่ามีความคิดเห็นหรือไม่
    if ($comment_result->num_rows > 0) {
        // หากมีความคิดเห็น แสดงแต่ละความคิดเห็น
        while ($comment = $comment_result->fetch_assoc()) {
            echo "<p>" . $comment["u_name"] . ": " . $comment["comment"] . " - <em>" . $comment["created_at"] . "</em></p>";
        }
    } else {
        // หากไม่มีความคิดเห็น แสดงข้อความ "No comments yet."
        echo "<p>No comments yet.</p>";
    }
} else {
    // หากเกิดข้อผิดพลาดในการเพิ่มความคิดเห็น แสดงข้อผิดพลาดและคำสั่ง SQL ที่ใช้
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>

<?php
// เริ่มต้นเซสชัน
session_start();
// ทำลายเซสชันเพื่อออกจากระบบ
session_destroy();
// เปลี่ยนเส้นทางผู้ใช้ไปที่หน้า index.php
header("Location: index.php");
// หยุดการทำงานของสคริปต์หลังจากเปลี่ยนเส้นทาง
exit();
?>

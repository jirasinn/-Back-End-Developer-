<?php
class ConnectDb
{
    // ข้อมูลสำหรับการเชื่อมต่อฐานข้อมูล
    public $host = "127.0.0.1";  // ที่อยู่ของเซิร์ฟเวอร์ฐานข้อมูล
    public $user = "root";       // ชื่อผู้ใช้ฐานข้อมูล
    public $pwd = "";            // รหัสผ่านฐานข้อมูล
    public $db = "nayootest";    // ชื่อฐานข้อมูล
    public $conn;                // ตัวแปรสำหรับเก็บการเชื่อมต่อฐานข้อมูล
    public $rs;                  // ตัวแปรสำหรับเก็บผลลัพธ์ของคำสั่ง SQL (ไม่ใช้ในคลาสนี้)

    // เมธอดคอนสตรัคเตอร์สำหรับสร้างการเชื่อมต่อฐานข้อมูล
    public function __construct()
    {
        // สร้างการเชื่อมต่อฐานข้อมูลโดยใช้ mysqli_connect
        $this->conn = mysqli_connect($this->host, $this->user, $this->pwd, $this->db);
        
        // ตรวจสอบว่าการเชื่อมต่อสำเร็จหรือไม่
        if (!$this->conn) {
            // หากการเชื่อมต่อไม่สำเร็จ แสดงข้อความข้อผิดพลาด
            die("เชื่อมต่อฐานข้อมูลไม่ได้: " . mysqli_connect_error());
        }
    }

    // เมธอดสำหรับคืนค่าการเชื่อมต่อฐานข้อมูล
    public function getConn()
    {
        return $this->conn;
    }
}
?>

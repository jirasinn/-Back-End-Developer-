<?php
class ConnectDb
{
    // กำหนดค่าคอนฟิกฐานข้อมูล
    public $host = "127.0.0.1"; // ที่อยู่ของเซิร์ฟเวอร์ฐานข้อมูล
    public $user = "root";      // ชื่อผู้ใช้ฐานข้อมูล
    public $pwd = "";          // รหัสผ่านฐานข้อมูล
    public $db = "nayootest";  // ชื่อฐานข้อมูล
    public $conn;              // ตัวแปรสำหรับเก็บการเชื่อมต่อฐานข้อมูล
    public $rs;                // ตัวแปรสำหรับเก็บผลลัพธ์ของการคิวรี

    // คอนสตรัคเตอร์ที่ใช้ในการเชื่อมต่อฐานข้อมูลเมื่อสร้างอ็อบเจ็กต์ของคลาส
    public function __construct()
    {
        // เชื่อมต่อฐานข้อมูล
        $this->conn = mysqli_connect($this->host, $this->user, $this->pwd, $this->db);

        // ตรวจสอบการเชื่อมต่อและแสดงข้อผิดพลาดหากไม่สามารถเชื่อมต่อได้
        if (!$this->conn) {
            die("เชื่อมต่อฐานข้อมูลไม่ได้: " . mysqli_connect_error());
        }
    }

    // ฟังก์ชันสำหรับคืนค่าการเชื่อมต่อฐานข้อมูล
    public function getConn()
    {
        return $this->conn;
    }
}

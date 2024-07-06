<?php
class ConnectDb

{
    public $host = "127.0.0.1";
    public $user = "root";
    public $pwd = "";
    public $db = "nayootest";
    public $conn;
    public $rs;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pwd, $this->db);
        if (!$this->conn) {
            die("เชื่อมต่อฐานข้อมูลไม่ได้: " . mysqli_connect_error());
        }
    }
    public function getConn()
    {
        return $this->conn;
    }

}

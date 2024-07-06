<?php
require_once('../libs/connect.class.php');

$db = new ConnectDb();
$conn = $db->getConn();

if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลผิดพลาด: " . $conn->connect_error);
}

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];

$sql = "DELETE FROM posts WHERE p_id='$p_id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>";
    echo "alert('ลบข้อมูลสำเร็จ');";
    echo "window.location='../index.php'";
    echo "</script>";
} else {
    echo "<script>";
    echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . $conn->error;
    echo "window.location='../index.php'";
    echo "</script>";
}

$conn->close();
}
?>
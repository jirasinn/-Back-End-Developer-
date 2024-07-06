<?php
require_once('../libs/connect.class.php');

$db = new ConnectDb();
$conn = $db->getConn();

if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลผิดพลาด: " . $conn->connect_error);
}

$title = $_POST['title'];
$content = $_POST['content'];
$u_id = $_POST['u_id'];
$p_id = $_POST['p_id'];

$sql = "UPDATE posts SET 
    u_id = '$u_id',
    title = '$title',
    content = '$content'
    WHERE p_id = $p_id";

if ($conn->query($sql) === TRUE) {
    echo "
    <script>
       alert ('Edit Post successfully');
       window.location='../index.php';
    exit;
    </script>
        ";
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
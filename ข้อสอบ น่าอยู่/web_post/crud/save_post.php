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

$sql = "INSERT INTO posts (u_id, title, content) VALUES ('$u_id', '$title', '$content')";

if ($conn->query($sql) === TRUE) {
    echo "
    <script>
       alert ('New post created successfully');
       window.location='../index.php';
    exit;
    </script>
        ";
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
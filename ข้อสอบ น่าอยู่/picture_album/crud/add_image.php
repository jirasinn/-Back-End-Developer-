<?php
require_once('../libs/connect.class.php');
$db = new ConnectDb();
$conn = $db->getConn();

$url = $_POST['url'];
$title = $_POST['title'];
$description = $_POST['description'];

$sql = "INSERT INTO images (url, title, description) 
                VALUES ('$url', '$title', '$description')";
if (mysqli_query($conn, $sql)) {
    echo "
    <script>
        alert('เพิ่มรูปภาพสำเร็จ');
        window.location.href = '../index.php';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
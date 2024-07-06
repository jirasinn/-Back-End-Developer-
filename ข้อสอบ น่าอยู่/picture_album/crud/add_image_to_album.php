<?php
require_once('../libs/connect.class.php');
$db = new ConnectDb();
$conn = $db->getConn();

$album_id = $_POST['album_id'];
$image_id = $_POST['image_id'];

$sql = "INSERT INTO album_images (album_id, image_id) VALUES ('$album_id', '$image_id')";
if (mysqli_query($conn, $sql)) {
    echo "
    <script>
        alert('เพิ่มรูปภาพในอัลบั้มสำเร็จ');
        window.location.href = '../index.php';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
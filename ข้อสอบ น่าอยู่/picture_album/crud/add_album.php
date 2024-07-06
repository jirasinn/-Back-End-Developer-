<?php
require_once('../libs/connect.class.php');
$db = new ConnectDb();
$conn = $db->getConn();

$name = $_POST['name'];
$description = $_POST['description'];

$sql = "INSERT INTO albums (name, description) VALUES ('$name', '$description')";
if (mysqli_query($conn, $sql)) {
    echo "
    <script>
        alert('สร้างอัลบั้มสำเร็จ');
        window.location.href = '../index.php';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

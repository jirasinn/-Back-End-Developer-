<?php
require_once('../libs/connect.class.php');

$db = new ConnectDb();
$conn = $db->getConn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "
    <script>
       alert ('Registration successful');
       window.location='../login.php';
    exit;
    </script>
        ";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

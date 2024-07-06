<?php
require_once('../libs/connect.class.php');

$db = new ConnectDb();
$conn = $db->getConn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$post_id = $_POST['post_id'];
$u_name = $_POST['u_name'];
$comment = $_POST['comment'];

$sql = "INSERT INTO comments (post_id, u_name, comment) VALUES ('$post_id', '$u_name', '$comment')";

if ($conn->query($sql) === TRUE) {
    $comment_sql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at DESC";
    $comment_result = $conn->query($comment_sql);

    if ($comment_result->num_rows > 0) {
        while ($comment = $comment_result->fetch_assoc()) {
            echo "<p>" . $comment["u_name"] . ": " . $comment["comment"] . " - <em>" . $comment["created_at"] . "</em></p>";
        }
    } else {
        echo "<p>No comments yet.</p>";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

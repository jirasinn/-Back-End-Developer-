<?php
require_once('libs/connect.class.php');
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

$db = new ConnectDb();
$conn = $db->getConn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM posts 
join users on users.id = posts.u_id
ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="styless.css">
</head>

<body>
    <div class="container">
        <h1>Posted</h1>

        <?php if (isset($_SESSION['username'])) { ?>
            <h3 align="center">Username: <?= $username ?></h3>
        <?php } ?>

        <a href="post.php" class="button">Create New Post</a>

        <?php if (isset($_SESSION['username'])) { ?>
            <a href="logout.php" class="button" id="logout">logout</a>
        <?php } ?>

        <?php if (!isset($_SESSION['username'])) { ?>
            <a href="login.php" class="button" id="login">login</a>
        <?php } ?>
        <hr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<div class='detail'>";
                echo "<h2>" . $row["title"] . "</h2>";
                echo "<p>" . $row["content"] . "</p>";
                echo "<p><em>Created on: " . $row["created_at"] . "</em></p>";
                echo "<h6>Created By: " . $row["username"] . "</h6>";

                if (isset($id) && $id === $row['u_id']) {
        ?>
                    <div class="btn-group">
                        <a href="edit.php?p_id=<?= htmlspecialchars($row["p_id"]) ?>" class="button" id="edit" style="background-color: #cfec17c4; color: black;">Edit Post</a>
                        <a href="crud/delete_post.php?p_id=<?= htmlspecialchars($row["p_id"]) ?>" class="button" id="delete" style="background-color: red; color: black;">Delete Post</a>
                    </div>
                <?php } ?>

        <?php
                echo "</div>";

                echo "<div class=Comments>";
                echo "<h4>Comments</h4>";
                $post_id = $row["p_id"];
                echo "<div id='comments-$post_id' class='comments'>";

                $comment_sql = "SELECT * FROM comments 
                WHERE post_id = $post_id 
                ORDER BY created_at ASC";

                $comment_result = $conn->query($comment_sql);

                if ($comment_result->num_rows > 0) {
                    while ($comment = $comment_result->fetch_assoc()) {
                        echo "<p>" . $comment["u_name"] . ": " . $comment["comment"] . " - <em>" . $comment["created_at"] . "</em></p>";
                    }
                } else {
                    echo "<p>No comments yet.</p>";
                }
                echo "</div>";

                echo "
                <form onsubmit='event.preventDefault(); addComment($post_id);' class='comment-form'>
                
                    <textarea id='comment-$post_id' required placeholder='Add a comment'></textarea><br>
                    <input type='hidden' id='u_name-$post_id' value='" . htmlspecialchars($username) . "'>

                    <input type='submit' value='Comment'>
                </form>";
                echo "</div>";
                echo "</div><hr>";
            }
        } else {
            echo "No posts found.";
        }

        $conn->close();
        ?>
    </div>
</body>

</html>

<script>
    function addComment(postId) {
            var comment = $('#comment-' + postId).val();
            var uName = $('#u_name-' + postId).val(); // รับค่า u_name

            $.ajax({
                url: 'crud/save_comment.php',
                type: 'POST',
                data: {
                    post_id: postId,
                    comment: comment,
                    u_name: uName // ส่งค่า u_name ไปพร้อมกับ comment
                },
                success: function(response) {
                    $('#comments-' + postId).html(response);
                    $('#comment-' + postId).val('');
                }
            });
        }
</script>
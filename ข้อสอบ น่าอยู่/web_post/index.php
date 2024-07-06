<?php
// รวมไฟล์ที่มีคลาส ConnectDb สำหรับการเชื่อมต่อฐานข้อมูล
require_once('libs/connect.class.php');

// เริ่มเซสชันเพื่อดึงข้อมูลเซสชัน
session_start();

// ดึงชื่อผู้ใช้และ ID จากตัวแปรเซสชัน
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

// สร้างการเชื่อมต่อฐานข้อมูล
$db = new ConnectDb();
$conn = $db->getConn();

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลโพสต์ทั้งหมด พร้อมรายละเอียดของผู้ใช้
$sql = "SELECT * FROM posts 
        JOIN users ON users.id = posts.u_id
        ORDER BY created_at DESC";

// ดำเนินการคำสั่ง SQL
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <!-- เชื่อมโยงไฟล์ jQuery สำหรับการทำงาน AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- เชื่อมโยงไฟล์ CSS -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Posted</h1>

        <!-- ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้วหรือไม่ และแสดงชื่อผู้ใช้ -->
        <?php if (isset($_SESSION['username'])) { ?>
            <h3 align="center">Username: <?= htmlspecialchars($username) ?></h3>
        <?php } ?>

        <!-- ลิงค์ไปยังหน้าเพื่อสร้างโพสต์ใหม่ -->
        <a href="post.php" class="button">Create New Post</a>

        <!-- ลิงค์สำหรับออกจากระบบถ้าผู้ใช้เข้าสู่ระบบ -->
        <?php if (isset($_SESSION['username'])) { ?>
            <a href="logout.php" class="button" id="logout">logout</a>
        <?php } ?>

        <!-- ลิงค์สำหรับเข้าสู่ระบบถ้าผู้ใช้ยังไม่เข้าสู่ระบบ -->
        <?php if (!isset($_SESSION['username'])) { ?>
            <a href="login.php" class="button" id="login">login</a>
        <?php } ?>
        <hr>

        <?php
        // ตรวจสอบว่ามีโพสต์ในฐานข้อมูลหรือไม่
        if ($result->num_rows > 0) {
            // วนลูปผ่านผลลัพธ์โพสต์ทั้งหมด
            while ($row = $result->fetch_assoc()) {
                echo "<div class='post'>";
                echo "<div class='detail'>";
                echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
                echo "<p>" . htmlspecialchars($row["content"]) . "</p>";
                echo "<p><em>Created on: " . htmlspecialchars($row["created_at"]) . "</em></p>";
                echo "<h6>Created By: " . htmlspecialchars($row["username"]) . "</h6>";

                // แสดงปุ่มแก้ไขและลบถ้าผู้ใช้เป็นเจ้าของโพสต์
                if (isset($id) && $id === $row['u_id']) {
        ?>
                    <div class="btn-group">
                        <a href="edit.php?p_id=<?= htmlspecialchars($row["p_id"]) ?>" class="button" id="edit" style="background-color: #cfec17c4; color: black;">Edit Post</a>
                        <a href="crud/delete_post.php?p_id=<?= htmlspecialchars($row["p_id"]) ?>" class="button" id="delete" style="background-color: red; color: black;">Delete Post</a>
                    </div>
                <?php } ?>

        <?php
                echo "</div>";

                echo "<div class='Comments'>";
                echo "<h4>Comments</h4>";
                $post_id = $row["p_id"];
                echo "<div id='comments-$post_id' class='comments'>";

                // สร้างคำสั่ง SQL เพื่อดึงความคิดเห็นสำหรับโพสต์นี้
                $comment_sql = "SELECT * FROM comments 
                                WHERE post_id = $post_id 
                                ORDER BY created_at ASC";

                $comment_result = $conn->query($comment_sql);

                // ตรวจสอบว่ามีความคิดเห็นหรือไม่ และแสดงผลลัพธ์
                if ($comment_result->num_rows > 0) {
                    while ($comment = $comment_result->fetch_assoc()) {
                        echo "<p>" . htmlspecialchars($comment["u_name"]) . ": " . htmlspecialchars($comment["comment"]) . " - <em>" . htmlspecialchars($comment["created_at"]) . "</em></p>";
                    }
                } else {
                    echo "<p>No comments yet.</p>";
                }
                echo "</div>";

                // ฟอร์มสำหรับเพิ่มความคิดเห็น
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
            // แสดงข้อความถ้าไม่มีโพสต์
            echo "No posts found.";
        }

        // ปิดการเชื่อมต่อฐานข้อมูล
        $conn->close();
        ?>
    </div>
</body>

</html>

<script>
    // ฟังก์ชันสำหรับเพิ่มความคิดเห็นด้วย AJAX
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

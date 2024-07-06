<?php
require_once('libs/connect.class.php');
$db = new ConnectDb();
$conn = $db->getConn();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Picture_Album</title>
    <link rel="stylesheet" href="styless.css">
</head>

<body>

    <div class="container">

        <!--  -->
        <div class="row">

        <h3 style="margin-bottom: 0px; align-content: center;">สร้างอัลบั้ม</h3>
        <form action="crud/add_album.php" method="post">
            <label for="name">ชื่ออัลบั้ม:</label>
            <input type="text" id="name" name="name" required>
            <label for="description">รายละเอียด:</label>
            <textarea id="description" name="description"></textarea>
            <button type="submit">เพิ่มอัลบั้ม</button>
        </form>

        <!--  -->
        <h3 style="margin-bottom: 0px; align-content: center;">บันทึกรูปภาพ</h3>
        <form action="crud/add_image.php" method="post">
            <label for="url">URL รูปภาพ:</label>
            <input type="text" id="url" name="url" required>
            <label for="title">ชื่อรูปภาพ:</label>
            <input type="text" id="title" name="title" required>
            <label for="description">คำอธิบาย:</label>
            <textarea id="description" name="description"></textarea>
            <button type="submit">เพิ่มรูปภาพ</button>
        </form>
        </div>
        <br>
        <hr>
        <!--  -->
        <h3 style="margin-bottom: 10px;  margin-left: 32%;">เพิ่มรูปภาพเข้าอัลบั้ม</h3>
        <form id="adToalbum" action="crud/add_image_to_album.php" method="post">
            <label for="album_id">เลือกอัลบั้ม:</label>
            <select id="album_id" name="album_id">
                <!-- ดึงรายการอัลบั้มจากฐานข้อมูล -->
                <?php
                $db = new ConnectDb();
                $conn = $db->getConn();

                $sql_albums = "SELECT id, name FROM albums";
                $result_albums = mysqli_query($conn, $sql_albums);

                if (mysqli_num_rows($result_albums) > 0) {
                    while ($row = mysqli_fetch_assoc($result_albums)) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                } else {
                    echo "<option value=''>No albums found</option>";
                }
                ?>
            </select>

            <label for="image_id">เลือกภาพ:</label>
            <select id="image_id" name="image_id">
                <!-- ดึงรายการรูปภาพจากฐานข้อมูล -->
                <?php
                $sql_images = "SELECT id, title FROM images";
                $result_images = mysqli_query($conn, $sql_images);

                if (mysqli_num_rows($result_images) > 0) {
                    while ($row = mysqli_fetch_assoc($result_images)) {
                        echo "<option value='{$row['id']}'>{$row['title']}</option>";
                    }
                } else {
                    echo "<option value=''>No images found</option>";
                }

                mysqli_close($conn);
                ?>
            </select>

            <button type="submit">เพิ่มภาพลงในอัลบั้ม</button>
        </form>
        <!--  -->

        <!-- แสดงผล -->
        <?php
        $db = new ConnectDb();
        $conn = $db->getConn();

        $sql_albums = "SELECT * FROM albums";
        $result_albums = mysqli_query($conn, $sql_albums);

        if (mysqli_num_rows($result_albums) > 0) {

            while ($album = mysqli_fetch_assoc($result_albums)) {
                echo "<div class='album'>";
                echo "<h2>Album: {$album['name']}</h2>";
                echo "<p>{$album['description']}</p>";

                // ดึงรูปภาพที่อยู่ในอัลบั้มนี้
                $album_id = $album['id'];
                $sql_images = "SELECT images.* FROM images 
                       JOIN album_images ON images.id = album_images.image_id 
                       WHERE album_images.album_id = $album_id";
                $result_images = mysqli_query($conn, $sql_images);

                if (mysqli_num_rows($result_images) > 0) {
                    echo "<div class='image-row'>";
                    $count = 0;
                    while ($image = mysqli_fetch_assoc($result_images)) {
                        if ($count > 0 && $count % 4 == 0) {
                            echo "</div><div class='image-row'>";
                        }
                        echo "<div class='image-item'>";
                        echo "<img src='{$image['url']}' alt='{$image['title']}' />";
                        echo "<p>{$image['title']}</p>";
                        echo "<p>{$image['description']}</p>";
                        echo "</div>";
                        $count++;
                    }
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<p>No images found in this album.</p>";
                }
            }
        } else {
            echo "<p>No albums found.</p>";
        }

        mysqli_close($conn);
        ?>



    </div>
</body>

</html>
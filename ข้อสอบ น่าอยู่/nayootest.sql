-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2024 at 05:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nayootest`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `description`) VALUES
(1, 'งาน', 'เอาไว้เก็บรูปงาน'),
(2, 'A2', 'รูปสัตว์'),
(3, 'C', 'album for car'),
(4, 'หมา', 'ม');

-- --------------------------------------------------------

--
-- Table structure for table `album_images`
--

CREATE TABLE `album_images` (
  `album_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `album_images`
--

INSERT INTO `album_images` (`album_id`, `image_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 8),
(1, 13),
(1, 14),
(2, 4),
(2, 7),
(2, 8),
(2, 9),
(3, 10),
(4, 13);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `u_name` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `u_name`, `comment`, `created_at`) VALUES
(29, 4, 'C', 'Ok A', '2024-07-05 19:15:30'),
(31, 8, 'B', 'That is a very good commitment.', '2024-07-05 19:31:47'),
(32, 8, 'A', 'thank you very much', '2024-07-05 19:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `url` varchar(800) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `url`, `title`, `description`) VALUES
(1, 'https://positioningmag.com/wp-content/uploads/2020/12/Job-Interview-1.jpg', 'อ่านเอกสาร', 'เอกสารงานวิจัย'),
(2, 'https://storage.googleapis.com/techsauce-prod/ugc/uploads/2023/5/1200_800_1683018482_%E0%B8%AB%E0%B8%B2%E0%B8%87%E0%B8%B2%E0%B8%99_01.jpg', 'หางาน', 'กำลังหางาน'),
(3, 'https://shortrecap.co/wp-content/uploads/2020/01/%E0%B8%84%E0%B8%B4%E0%B8%94%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B9%84%E0%B8%A1%E0%B9%88%E0%B8%AD%E0%B8%AD%E0%B8%81_cover.jpg', 'คิดงาน', 'มี Idea'),
(4, 'https://shortrecap.co/wp-content/uploads/2020/01/%E0%B8%84%E0%B8%B4%E0%B8%94%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B9%84%E0%B8%A1%E0%B9%88%E0%B8%AD%E0%B8%AD%E0%B8%81_01.jpg', 'งานที่เรารัก', 'สนุก'),
(7, 'https://static.thairath.co.th/media/dFQROr7oWzulq5Fa5BEgGYgamMYwZIoP8EpCpAeAwDCMr0pvh5eRaQ0flBNV4hIAUy1.jpg', 'ช', 'ช้าง'),
(8, 'https://www.seub.or.th/seubweb/wp-content/uploads/2024/01/33.jpg', 'น', 'ฮูก'),
(9, 'https://f.ptcdn.info/002/048/000/oidav7m4nF0JGvXz44Y-o.jpg', 'แมว', 'แมวตัวเล็กสีส้ม'),
(10, 'https://imageio.forbes.com/specials-images/imageserve/5d35eacaf1176b0008974b54/2020-Chevrolet-Corvette-Stingray/0x0.jpg?format=jpg&crop=4560,2565,x790,y784,safe&width=960', 'Chevrolet ', 'รถสีแดง'),
(11, 'https://spectanews.com/wp-content/uploads/2024/04/Car.jpg', 'Car of the future', 'is it insane!'),
(13, 'https://img.lovepik.com/free-png/20211216/lovepik-puppy-png-image_401706509_wh1200.png', 'หมาน้อย', 'หมาน้อยสีน้ำตาล'),
(14, 'https://mpics.mgronline.com/pics/Images/560000009989801.JPEG', 'ตั้งใจทำงาน', 'ทุ่มเทกับงานมากๆ');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `p_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`p_id`, `u_id`, `title`, `content`, `created_at`) VALUES
(3, 2, 'B first post', 'hi everyone', '2024-07-04 14:01:22'),
(4, 1, 'TestA', 'Just a test, nothing else.', '2024-07-04 15:32:39'),
(5, 3, 'Hi C TEST', 'nice to meet you', '2024-07-04 15:40:24'),
(8, 1, 'I wanna be great programmer', 'I am practicing several languages ​​to become good at it.', '2024-07-05 19:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'A', '$2y$10$zqRJ.EyIcctBiI00hbQit.V9jag17gazvbAXrI0Tsg0SQOc2eUgyK'),
(2, 'B', '$2y$10$35PNLzwJlH0K.JiHh1Ze3.YMJSF3zqAWGPFhd4Iegtm8ZIhNZlAKm'),
(3, 'C', '$2y$10$1ktR0dHzFjs02j.UN9Qc1OBtFBGkfniN0ImMZPurI6vUScVLAv1Ra'),
(4, 'biew', '$2y$10$Jfv8m4w2MfJP6EGGJJY7deCxyyd78Gc9m2KwD3gS4IjK6KPVvITL.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album_images`
--
ALTER TABLE `album_images`
  ADD PRIMARY KEY (`album_id`,`image_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album_images`
--
ALTER TABLE `album_images`
  ADD CONSTRAINT `album_images_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `album_images_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`p_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

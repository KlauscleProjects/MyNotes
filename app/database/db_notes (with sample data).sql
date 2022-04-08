-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2022 at 07:07 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_notes`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notes`
--

CREATE TABLE `tbl_notes` (
  `note_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT 0,
  `note_title` varchar(255) NOT NULL,
  `note_body` text NOT NULL,
  `created_at` datetime NOT NULL,
  `edited_at` datetime DEFAULT NULL,
  `note_archive` int(11) NOT NULL DEFAULT 0 COMMENT 'archive[1], not[0]',
  `note_trash` int(11) NOT NULL DEFAULT 0 COMMENT 'on trash[1], not[0]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notes`
--

INSERT INTO `tbl_notes` (`note_id`, `user_id`, `tag_id`, `note_title`, `note_body`, `created_at`, `edited_at`, `note_archive`, `note_trash`) VALUES
(1, 1, 0, 'Note1', 'this is note 1', '2022-03-30 18:21:21', '2022-04-03 11:32:22', 0, 0),
(2, 1, 0, 'Note2', 'this is note 2', '2022-03-30 18:21:40', '2022-03-31 16:39:18', 0, 0),
(3, 1, 0, 'Note3', 'this is note 3d', '2022-03-30 18:21:50', '2022-03-31 16:46:32', 0, 0),
(5, 1, 0, 'Note 55', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse rhoncus nulla ac massa elementum commodo. Sed et diam luctus, lacinia sapien sit amet, hendrerit lacus. Maecenas eget tristique enim. Donec vel gravida orci. In fermentum blandit dolor fringilla lobortis. Suspendisse convallis rutrum massa. Fusce convallis felis ac ligula scelerisque, ac dignissim diam auctor. Proin lacinia sapien nec faucibus hendrerit. Sed bibendum facilisis erat vel tincidunt. Sed ullamcorper lacus libero, sit amet dignissim lacus euismod sed. Suspendisse ultricies ante eu turpis luctus scelerisque. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nMauris aliquet metus quis risus mollis, et suscipit purus feugiat. Aliquam sed nunc sit amet tortor imperdiet commodo. Aliquam efficitur, tortor id laoreet venenatis, leo lorem tempus dolor, in ullamcorper sem augue vitae tortor. Mauris at eleifend augue, nec ultricies mi. Morbi id libero eu justo sagittis consequat ut id ligula. Cras a quam eget tortor feugiat iaculis ac sodales lectus. Nulla scelerisque arcu nisi, id vestibulum massa pellentesque at. Morbi in eros dictum, maximus libero sed, suscipit ligula.\r\n\r\nDonec nibh metus, placerat id sollicitudin sagittis, congue a orci. Phasellus blandit egestas porta. Fusce condimentum rhoncus leo in blandit. Nullam aliquet venenatis nisi, ac maximus velit laoreet a. Nulla id nibh nec lacus viverra faucibus. Curabitur sed metus fringilla, faucibus nunc eget, placerat ligula. Maecenas a efficitur quam. In non consectetur velit, vel pellentesque massa. Donec vitae vulputate augue. Curabitur rutrum, eros nec gravida tincidunt, enim nunc porta enim, vitae convallis elit augue ut orci. Vestibulum non urna rhoncus, laoreet purus non, condimentum felis. Vivamus aliquam, justo eget imperdiet imperdiet, enim tellus egestas lacus, ac facilisis ipsum purus tristique lacus. Integer vehicula magna non augue lacinia ultricies.\r\n\r\nMaecenas non ultricies massa. Duis accumsan, lacus quis sagittis interdum, erat nisl commodo justo, ut viverra sem magna eget velit. Nulla facilisi. Pellentesque rutrum congue nulla. Proin sit amet faucibus orci. Maecenas aliquet, risus finibus tempus bibendum, odio urna interdum arcu, at ultrices dolor mi vel nunc. Proin ornare ac ipsum et faucibus.\r\n\r\nPellentesque sit amet semper neque. Nullam dictum nisl velit, eu rutrum orci consequat vel. Donec rhoncus elementum eros, id mattis ipsum porta at. Nulla est erat, placerat a nisl ut, feugiat egestas mi. In feugiat luctus leo, dictum efficitur magna semper vitae. Fusce venenatis ut nisl ac ullamcorper. Pellentesque tortor lacus, bibendum non elit a, sagittis viverra orci. Etiam sodales euismod ullamcorper. Etiam ex ligula, porta non vulputate at, posuere ac nisl. Proin nec nulla maximus, pretium justo pharetra, ultrices augue.', '2022-03-31 15:49:50', '2022-03-31 15:50:32', 0, 0),
(6, 2, 0, 'Violet1', 'Violet1 note', '2022-03-31 21:42:26', NULL, 0, 0),
(7, 2, 2, 'Violet2', 'Violet1 note', '2022-03-31 21:42:36', '2022-04-03 12:30:52', 0, 0),
(8, 1, 8, 'sample title with tag', 'fsfsdfdsfds', '2022-04-02 12:23:16', '2022-04-03 11:28:27', 0, 1),
(9, 1, 8, 'noteXgf', 'hgdhgdfh', '2022-04-02 12:23:43', '2022-04-06 21:25:18', 1, 0),
(10, 1, 5, 'NoteY', 'hahaha', '2022-04-02 12:23:59', '2022-04-03 11:45:59', 0, 0),
(11, 1, 14, 'Motiv1', 'don&#39;t forget to appreciate small things', '2022-04-03 11:35:44', NULL, 0, 0),
(12, 2, 2, 'VioletNote1', 'lorem ipsum', '2022-04-03 12:31:30', NULL, 0, 0),
(13, 2, 4, 'VioletNote2', 'lorem ipsum dolor', '2022-04-03 12:31:47', NULL, 1, 0),
(14, 1, 14, 'Motiv2', 'Kill them with success', '2022-04-03 13:43:54', '2022-04-06 21:23:54', 0, 0),
(23, 4, 21, 'jfghjgfh', 'jhgfjhgfj', '2022-04-03 15:11:35', '2022-04-03 15:14:44', 0, 0),
(24, 1, 14, 'Motiv3', 'A professional once became a beginner.', '2022-04-03 18:43:31', '2022-04-03 18:43:38', 0, 0),
(25, 1, 13, 'gfg', 'gdfgdfgdf', '2022-04-06 21:17:23', NULL, 0, 1),
(26, 1, 14, 'Motiv4', 'L.E.P. (Law of attraction, Efforts, and Prayers)', '2022-04-06 21:21:16', '2022-04-06 21:32:39', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pswrdreset`
--

CREATE TABLE `tbl_pswrdreset` (
  `reset_id` int(11) NOT NULL,
  `reset_email` text NOT NULL,
  `reset_selector` text NOT NULL,
  `reset_token` text NOT NULL,
  `reset_expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pswrdreset`
--

INSERT INTO `tbl_pswrdreset` (`reset_id`, `reset_email`, `reset_selector`, `reset_token`, `reset_expires`) VALUES
(6, 'klausgrey21@gmail.com', '6eb8dd7c0f85f8c8', '$2y$10$a9zaZhoiIHsWdDTglqtOl.uNZZMBU.WQm2NkPGi6kgdQvsgIWCZaG', 1649389957);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tags`
--

CREATE TABLE `tbl_tags` (
  `tag_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'user_id from tbl_users',
  `tag_title` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `edited_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tags`
--

INSERT INTO `tbl_tags` (`tag_id`, `user_id`, `tag_title`, `created_at`, `edited_at`) VALUES
(1, 1, 'hello1f', '2022-03-31 21:37:18', '2022-04-06 21:32:07'),
(2, 2, 'heyviolet1', '2022-03-31 21:37:59', '2022-04-02 11:40:06'),
(3, 1, 'hello2', '2022-03-31 21:38:27', NULL),
(4, 2, 'heyviolet2', '2022-03-31 21:44:07', NULL),
(5, 1, 'hello3', '2022-03-31 21:53:58', NULL),
(6, 1, 'hello5', '2022-04-02 09:11:13', '2022-04-02 11:17:32'),
(7, 1, 'hello4', '2022-04-02 11:12:18', NULL),
(8, 1, 'hello10', '2022-04-02 11:12:40', '2022-04-02 11:14:10'),
(12, 2, 'heyviolet3', '2022-04-02 11:40:28', NULL),
(13, 1, 'klaus13', '2022-04-02 12:13:24', NULL),
(14, 1, 'Motivations', '2022-04-03 11:35:32', '2022-04-03 12:27:30'),
(21, 4, 'h,kghj', '2022-04-03 15:14:37', NULL),
(22, 1, 'gdsgfds', '2022-04-06 21:26:32', NULL),
(23, 1, 'fdsfs', '2022-04-06 21:31:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(255) NOT NULL,
  `user_lname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `edited_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_password`, `created_at`, `edited_at`) VALUES
(1, 'Klaus', 'Grey', 'klausgrey21@gmail.com', '$2y$10$y/en15zCHxQRWsw94vrn2e6py/JNerTVj2BdIRTdRLVMt9S91o1lu', '2022-03-28 18:39:06', '2022-04-06 17:59:37'),
(2, 'Violet', 'Baudelaire', 'violet21@gmail.com', '$2y$10$g.2JIUoeKZw8cbnUmR9Um.hYiNQOI/eVMPppwNMbXw2eOnZuldPv6', '2022-03-29 21:33:36', NULL),
(3, 'fsf', 'fsdfds', 'qwe@xyz.com', '$2y$10$NWqVcD6qsj.EL/6twuwYquPxLW71.EsSxVMg/17NlFuThouI45.oG', '2022-03-29 23:05:43', NULL),
(4, 'Sunny', 'Baudelaire', 'sunny21@gmail.com', '$2y$10$3kUFlkXCV0DW58.n9wCU4ufLBwlPieFCNfXSl6ZYDSFqmt5M5D4xK', '2022-04-03 14:10:50', NULL),
(5, 'fdsg', 'gdfg', 'fdsfs@rwwsgf', '$2y$10$7THuXPETkPEIN0X.leJOs.FoDgvt.7oWIb8MEqvVOUY6.cdU3cbqO', '2022-04-06 14:35:02', NULL),
(6, 'fsfs', 'fdsfds', 'fsgfsg@fsgs', '$2y$10$k.A1gA9RgMDn4A./IYOCb.mwkR.I.tUkyskTTUJwr.Ldc9r2laMB6', '2022-04-06 14:36:52', NULL),
(7, 'Klausdfdsf', 'gsgdsfg', 'haha@gmail.com', '$2y$10$igu5rDvBgtdElmLGyq.FUuqqONGGtOmHGZwoi0Xo0BMOPYCiALSNS', '2022-04-06 21:36:47', NULL),
(8, 'fdsg', 'jgfjhghf', 'wrw@gmail.com', '$2y$10$xLwbsauPjVjM4nDoXJOW1.kqG1Cty4gTryO4ScrJ024rnQzL/BEvO', '2022-04-06 21:38:33', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `tbl_pswrdreset`
--
ALTER TABLE `tbl_pswrdreset`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `tbl_tags`
--
ALTER TABLE `tbl_tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_pswrdreset`
--
ALTER TABLE `tbl_pswrdreset`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_tags`
--
ALTER TABLE `tbl_tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

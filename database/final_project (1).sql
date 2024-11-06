-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 09:58 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `S/N` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `total_sales` int(11) DEFAULT 0,
  `total_downloads` int(11) DEFAULT 0,
  `total_books` int(11) DEFAULT 0,
  `total_subscriptions` int(11) DEFAULT 0,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`S/N`, `fullname`, `email`, `password`, `category_id`, `total_sales`, `total_downloads`, `total_books`, `total_subscriptions`, `facebook_link`, `twitter_link`, `linkedin_link`, `youtube_link`, `about`, `title`, `site`) VALUES
(1, 'Jenny Mer', 'jmer@gmail.com', 'jmer', 'Business', 0, 0, 0, 0, 'www.facebook.com', 'www.twitter.com', 'www.linkedin.com', 'www.youtube.com', 'i Love writing books that give people the chills and creeps, don\'t you like me?', 'Horror Story Writer', 'chrome.web.app'),
(3, 'Xaki Jonathan', 'xakijoo23@gmail.com', 'xaki', 'Other', 0, 0, 0, 0, 'www.facebook.com', 'www.twitter.com', 'www.linkedin.com', 'www.youtube.com', 'I\'ve always enjoyed writing. The joy it brings and the love i get when i create a master piece. My latest inspirations have been so heavenly i\'m beginning to think that i\'m a genius.', 'Fantasy Novel Writer', 'chrome.web.app'),
(4, 'dumebiosinachiesau', 'dumdumoesau@gmail.com', 'peterpan', 'Romance', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', ''),
(5, 'zaki jonathan', 'zakijonathan3@gmail.com', '123456', 'Business', 0, 0, 0, 0, 'www.facebook.com', 'www.twitter.com', 'www.linkedin.com', 'www.youtube.com', 'I\'m an educated and talented young man that has a passion for Business and learning new things. I enjoy teaching people about financial literacy and stirring up the desire of people to learn more.', 'Business Book Writer and Motivational Speaker', 'chrome.web.app'),
(6, 'Aguh Victor', 'victoraguh@gmail.com', 'victor', 'IT & Software', 0, 0, 0, 0, 'facebook.com', 'victoraguh01', 'www.linkedin.com', 'www.Jumia.com', 'a very brilliant IT personal from LINCOLN', 'IT book Writer', 'youtube.com');

-- --------------------------------------------------------

--
-- Table structure for table `auth_downloads`
--

CREATE TABLE `auth_downloads` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `download_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `writing_level` varchar(255) NOT NULL,
  `audio_language` varchar(255) NOT NULL,
  `book_language` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `book_file` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `regular_price` decimal(10,2) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `book_format` enum('mp3','pdf','word') DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `writing_level`, `audio_language`, `book_language`, `category`, `created_at`, `book_file`, `thumbnail`, `regular_price`, `discount_price`, `book_format`, `author_id`, `author_name`, `updated_at`) VALUES
(12, 'The dark room', 'A thriller about a young man who gets lost in a strange room full of dead bodies. Will he uncover the mystery or end up as one of the bodies?', '1', 'N/A', 'English', 'Horror', '2024-07-29 09:49:24', 'uploads/books/Firefall.pdf', 'uploads/thumbnails/book hide and seek.jpg', '5000.00', '2500.00', 'pdf', 5, '', NULL),
(13, 'Lunar Bonds', 'A werewolf troop invade a small village and a lot of interesting stuff begin to happen.', '1', 'N/A', 'English', 'Fantasy', '2024-07-29 09:57:26', 'uploads/books/Lproject format.pdf', 'uploads/thumbnails/book dragon girl.jpg', '0.00', '0.00', 'pdf', 5, '', NULL),
(15, 'Rich Dad Poor Dad', 'learn about financial literacy', '1', 'N/A', 'English', 'Finance', '2024-07-29 10:53:41', 'uploads/books/Rich Dad Poor Dad.pdf', 'uploads/thumbnails/book educational.jpg', '1600.00', '700.00', 'pdf', 5, '', '2024-07-29 10:53:41'),
(16, 'Guide to Software Engineering', 'a short guide to becoming a software engineer', '1', 'N/A', 'English', 'Web Design', '2024-07-29 12:01:49', 'uploads/books/Lproject format.pdf', 'uploads/thumbnails/book educational.jpg', '5000.00', '1100.00', 'pdf', 6, '', '2024-07-29 12:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `reader_id` int(11) NOT NULL,
  `download_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `readers`
--

CREATE TABLE `readers` (
  `S/N` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `purchased_books` int(11) DEFAULT 0,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `headline` varchar(60) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `website` varchar(64) DEFAULT NULL,
  `facebook_link` varchar(64) DEFAULT NULL,
  `twitter_link` varchar(64) DEFAULT NULL,
  `linkedin_link` varchar(64) DEFAULT NULL,
  `youtube_link` varchar(64) DEFAULT NULL,
  `total_subsciptions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `readers`
--

INSERT INTO `readers` (`S/N`, `fullname`, `email`, `password`, `purchased_books`, `first_name`, `last_name`, `headline`, `description`, `website`, `facebook_link`, `twitter_link`, `linkedin_link`, `youtube_link`, `total_subsciptions`) VALUES
(1, 'Daniel Andrew', 'realdanny@gmail.com', 'danny', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 'Tobi Jamiu', 'Jamzy43@gmail.com', 'tobi', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 'Michael peters', 'mikeyp@gmail.com', '12345', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(4, 'David Onyemenam', 'davidonyemenam21@gmail.com', '12345', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`S/N`);

--
-- Indexes for table `auth_downloads`
--
ALTER TABLE `auth_downloads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `reader_id` (`reader_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `readers`
--
ALTER TABLE `readers`
  ADD PRIMARY KEY (`S/N`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `S/N` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `auth_downloads`
--
ALTER TABLE `auth_downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `readers`
--
ALTER TABLE `readers`
  MODIFY `S/N` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_downloads`
--
ALTER TABLE `auth_downloads`
  ADD CONSTRAINT `auth_downloads_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`S/N`),
  ADD CONSTRAINT `auth_downloads_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `downloads_ibfk_2` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`S/N`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`S/N`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

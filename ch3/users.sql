-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2014 at 12:01 AM
-- Server version: 5.5.24
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ch3`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Johnasdf', 'johndoe', 'johndoe@test.com', '123456', 'Johnasdf', '2013-06-07 08:13:28', '2014-01-07 17:47:09'),
(3, 'amy', 'amy.deg', 'amy@outlook.com', '78546546', 'amy', '2013-06-19 19:10:12', '2013-06-19 19:10:12'),
(4, 'test2', 'test1234', 'test@test.com', '123456', 'test', '2014-01-07 17:05:19', '2014-01-07 17:05:19'),
(5, 'test', 'test1234', 'test2@test.com', '123456', 'test5', '2014-01-07 17:06:05', '2014-01-07 17:06:05'),
(6, 'marketing', 'test1234', 'test@test.com', '123456', 'dangar', '2014-01-07 17:12:47', '2014-01-07 17:38:44'),
(8, 'marketing', '123456789', 'admin!tasdf@test.com', '919099039992', 'Hardik Dangar', '2014-01-07 18:13:28', '2014-01-07 18:13:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

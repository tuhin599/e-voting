-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2017 at 07:44 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evoting_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `national_id` int(11) NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `election_ref` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gain_votes` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `created_at`, `updated_at`, `first_name`, `last_name`, `national_id`, `gender`, `date_of_birth`, `region`, `mark`, `election_ref`, `gain_votes`) VALUES
(4, '2017-01-25 13:39:31', '2017-01-27 03:22:46', 'Tuhin', 'Hossain', 121121, 'male', '2015-12-01', 'Chittagong', '4/1485373171.jpg', '2', 1),
(5, '2017-01-25 17:41:24', '2017-01-27 12:41:55', 'Md', 'Arif', 1211255, 'male', '2016-12-25', 'Mymensingh', '5/1485387684.png', '5', 1),
(6, '2017-01-26 13:35:54', '2017-01-27 03:22:46', 'Arif', 'Islam', 2323, 'male', '2017-01-27', 'Chittagong', '6/1485459354.jpg', '2', 0),
(7, '2017-01-27 11:26:19', '2017-01-27 12:21:08', 'Md', 'Munna', 3434, 'male', '2017-01-02', 'Mymensingh', '7/1485537979.jpg', '5', 2);

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `election_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `winner` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `created_at`, `updated_at`, `election_name`, `region`, `status`, `winner`) VALUES
(2, '2017-01-25 15:36:59', '2017-01-25 16:46:02', 'a new election', 'Chittagong', 2, '4'),
(5, '2017-01-27 11:29:56', '2017-01-27 12:41:55', 'Second Election', 'Mymensingh', 2, '7');

-- --------------------------------------------------------

--
-- Table structure for table `email_confirms`
--

CREATE TABLE `email_confirms` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_confirms`
--

INSERT INTO `email_confirms` (`id`, `created_at`, `updated_at`, `user_id`, `token`) VALUES
(1, '2016-12-10 13:39:21', '2016-12-10 13:39:21', '1', '1481398761mnziKN1U8GPoGLrEIbh0rZPJM'),
(2, '2016-12-10 15:14:04', '2016-12-10 15:14:04', '2', '1481404444WtUk4YRdTvIxOuGZfFRqBR9Tc'),
(3, '2017-01-24 00:13:17', '2017-01-24 00:13:17', '3', '1485238397B6vu7tdMC1xWfKI98bxsgCWzA'),
(5, '2017-01-25 12:15:39', '2017-01-25 12:15:39', '5', '1485368139v28Z9CA9wSw9qhiR1jIctwBqr'),
(6, '2017-01-27 11:27:34', '2017-01-27 11:27:34', '6', '1485538054pt9JWN25FZgd8TpmAHEyEZTTT');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_11_24_150148_create_candidates_table', 1),
('2016_11_26_195131_create_voters_table', 1),
('2016_12_04_152436_create_email_confirms_table', 1),
('2016_12_07_135145_create_voter_requests_table', 1),
('2016_12_10_224214_create_vote_counters_table', 2),
('2017_01_25_154232_create_region_lists_table', 3),
('2017_01_25_205354_create_elections_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `region_lists`
--

CREATE TABLE `region_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `region_lists`
--

INSERT INTO `region_lists` (`id`, `created_at`, `updated_at`, `region`) VALUES
(1, '2017-01-25 10:56:44', '2017-01-25 10:56:44', 'Dhaka'),
(2, '2017-01-25 11:05:15', '2017-01-25 11:05:15', 'Rajshahi'),
(3, '2017-01-25 11:05:27', '2017-01-25 11:05:27', 'Rangpur'),
(4, '2017-01-25 11:06:08', '2017-01-25 11:06:08', 'Chittagong'),
(5, '2017-01-25 11:06:27', '2017-01-25 11:06:27', 'Mymensingh'),
(6, '2017-01-25 11:06:59', '2017-01-25 11:06:59', 'Sylhet'),
(7, '2017-01-25 11:07:25', '2017-01-25 11:07:25', 'Khulna'),
(8, '2017-01-25 17:40:06', '2017-01-25 17:40:06', 'Bogra');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `national_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `profile_pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `national_id`, `date_of_birth`, `user_type`, `active`, `profile_pic`, `gender`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tuhin Hossain', 'tuhin@gmail.com', '$2y$10$eNoU4E89NRose89uQcxZU.wpJvBJNzmyEhAwbTMJRrNT9TaYtIrbS', '54554', '1996-06-07', 'admin', 1, 'users/1485440496.png', 'male', 'Dhaka', 'cao4WFn9sEf5el8HBOqtltfqepWsbjGczJJ7leya4nR6k6rT7kes2iClrsjm', '2016-12-10 13:39:21', '2017-01-26 08:30:13'),
(2, 'Ariful Islam', 'arif@gmail.com', '$2y$10$8XN787oepyAjUYgL52cUh.nPYnMFEIf9ArfYEt9kCnWgEZvRw0IRy', '1212', '1996-12-11', 'voter', 1, 'users/1481405907.jpg', 'male', 'Rangpur', 'MTwlftbxcJnqqZ9zCeaP26d242alO4ZPY6C1BZGYzSo41A2UAtkqj8DU5A3s', '2016-12-10 15:14:04', '2017-01-24 00:10:52'),
(5, 'Shuvo', 'shuvo@gmail.com', '$2y$10$lMje6FkbtXblt6rCEREUvOmLrieMWR4W9x0IbpEE0SDm2IQ1deqQy', '123', '2015-03-03', 'voter', 1, 'image/default.png', 'male', 'Chittagong', 'MZQDVxled9FFUNsZcQr1wU3M7TBfDEM0EagMFaqgj3N3v3YEsoFkgqj9Wy8a', '2017-01-25 12:15:39', '2017-01-27 11:26:44'),
(6, 'sdf', 's@g.com', '$2y$10$EFZb2qi5/LyT43RY.wvZNu65imqlZCkBTLTtCVJd4AAR1dcwwFuGO', '3434', '2017-01-27', 'voter', 1, 'image/default.png', 'male', 'Mymensingh', 'KbBrdm7mjORLbcGWhMjk5yJgsooLU8E48Y4zP8YVBQCJ5GNl1pnwOfdN8tlx', '2017-01-27 11:27:34', '2017-01-27 12:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `national_id` int(11) NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pic_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `created_at`, `updated_at`, `user_id`, `name`, `national_id`, `gender`, `date_of_birth`, `address`, `pic_location`) VALUES
(4, '2017-01-24 00:05:47', '2017-01-24 00:05:47', '2', 'Ariful Islam', 1212, 'male', '1996-12-11', 'Rangpur', 'users/1481405907.jpg'),
(5, '2017-01-25 13:38:08', '2017-01-25 13:38:08', '5', 'Shuvo', 123, 'male', '2015-03-03', 'Chittagong', 'image/default.png'),
(6, '2017-01-27 11:29:04', '2017-01-27 11:29:04', '6', 'sdf', 3434, 'male', '2017-01-27', 'Mymensingh', 'image/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `voter_requests`
--

CREATE TABLE `voter_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `voter_requests`
--

INSERT INTO `voter_requests` (`id`, `created_at`, `updated_at`, `user_id`, `status`) VALUES
(6, '2017-01-25 12:36:06', '2017-01-25 13:38:08', '5', 1),
(7, '2017-01-27 11:28:41', '2017-01-27 11:29:05', '6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vote_counters`
--

CREATE TABLE `vote_counters` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `candidate_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `election_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vote_counters`
--

INSERT INTO `vote_counters` (`id`, `created_at`, `updated_at`, `candidate_id`, `user_id`, `election_id`) VALUES
(2, '2017-01-25 13:59:17', '2017-01-25 13:59:17', '4', '5', '2'),
(4, '2017-01-27 11:03:39', '2017-01-27 11:03:39', '6', '5', '2'),
(9, '2017-01-27 11:54:31', '2017-01-27 11:54:31', '7', '6', '5'),
(10, '2017-01-27 11:54:31', '2017-01-27 11:54:31', '7', '6', '5'),
(11, '2017-01-27 11:54:31', '2017-01-27 11:54:31', '5', '6', '5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidates_national_id_index` (`national_id`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_confirms`
--
ALTER TABLE `email_confirms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `region_lists`
--
ALTER TABLE `region_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_national_id_unique` (`national_id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voters_national_id_index` (`national_id`);

--
-- Indexes for table `voter_requests`
--
ALTER TABLE `voter_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote_counters`
--
ALTER TABLE `vote_counters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `email_confirms`
--
ALTER TABLE `email_confirms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `region_lists`
--
ALTER TABLE `region_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `voter_requests`
--
ALTER TABLE `voter_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `vote_counters`
--
ALTER TABLE `vote_counters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

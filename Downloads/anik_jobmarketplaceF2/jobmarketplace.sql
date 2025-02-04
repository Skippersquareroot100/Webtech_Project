-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 04, 2025 at 04:21 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobmarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `anik_applicants`
--

CREATE TABLE `anik_applicants` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anik_applications`
--

CREATE TABLE `anik_applications` (
  `id` int NOT NULL,
  `job_id` int NOT NULL,
  `applicant_id` int NOT NULL,
  `applied_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anik_applications`
--

INSERT INTO `anik_applications` (`id`, `job_id`, `applicant_id`, `applied_at`) VALUES
(1, 1, 3, '2025-01-05 10:17:16'),
(2, 1, 9, '2025-01-06 05:11:12'),
(3, 2, 3, '2025-01-06 06:42:12'),
(4, 6, 3, '2025-01-06 06:42:16'),
(5, 5, 12, '2025-01-22 07:51:11'),
(6, 10, 3, '2025-01-22 14:12:18'),
(7, 1, 13, '2025-01-23 08:05:01'),
(8, 2, 13, '2025-01-23 08:05:03'),
(9, 5, 13, '2025-01-23 08:05:04'),
(10, 6, 13, '2025-01-23 08:05:04'),
(11, 7, 13, '2025-01-23 08:05:05'),
(12, 8, 13, '2025-01-23 08:05:06'),
(13, 10, 13, '2025-01-23 08:05:07'),
(14, 1, 14, '2025-01-29 05:03:15');

-- --------------------------------------------------------

--
-- Table structure for table `anik_jobs`
--

CREATE TABLE `anik_jobs` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `employee_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anik_jobs`
--

INSERT INTO `anik_jobs` (`id`, `title`, `description`, `employee_id`, `created_at`, `location`, `status`) VALUES
(1, 'Superviser', 'aaaaaaaa...aa..a.a..a.a.a.', 5, '2025-01-05 10:16:52', '', 'approved'),
(2, 'helping man', 'jojoijoijojkoijo', 5, '2025-01-05 14:55:01', '', 'approved'),
(5, 'cleaner', 'holhojjoljkjbj', 5, '2025-01-05 15:34:43', 'Khulna', 'approved'),
(6, 'teacher', 'aajhkhjkla', 5, '2025-01-05 16:23:21', 'Dhaka', 'approved'),
(7, 'HR', 'ohasdlhb,d,asm', 5, '2025-01-19 15:28:56', 'Mymensingh', 'approved'),
(8, 'CEO', 'ksdjhadsc,cdsjiofad', 5, '2025-01-19 15:43:44', 'Dhaka', 'approved'),
(10, 'Faculty', 'vdfuvbkglsn;m', 5, '2025-01-22 14:10:39', 'Sylhet', 'approved'),
(11, 'Sir', 'bla bla bla bla', 5, '2025-01-23 08:06:20', 'Rangpur', 'approved'),
(12, 'Mobile operator', 'jscdkjdcsdkjns\nsdnlksdf\n]sdlnsv', 5, '2025-01-29 05:04:42', 'Mymensingh', 'approved'),
(13, 'ffjbhdiudaejk', 'vsdfpojfwdlsjwmbvlmler', 5, '2025-02-03 06:54:02', 'Khulna', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `anik_posts`
--

CREATE TABLE `anik_posts` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `posted_by` int NOT NULL,
  `status` enum('active','banned') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anik_resumes`
--

CREATE TABLE `anik_resumes` (
  `id` int NOT NULL,
  `user_id` int DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `objective` text,
  `education` text,
  `work_experience` text,
  `skills` text,
  `certifications` text,
  `languages` text,
  `projects` text,
  `references` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anik_resumes`
--

INSERT INTO `anik_resumes` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `profile_picture`, `objective`, `education`, `work_experience`, `skills`, `certifications`, `languages`, `projects`, `references`, `created_at`, `updated_at`) VALUES
(1, 3, 'aaa', 'aa@gamil.com', '1212321', '1232132', '470051842_8926461377431586_6302607261897444135_n-2.jpg', 'dewap[s', 'ca;oc', 'cas;l', 'afc;ld', 'acdsv;', 'af;lv', 'dfcs', 'asvdm;', '2025-01-05 17:26:56', '2025-01-05 17:26:56'),
(2, 3, 'aaaaa', 'aaa@f.com', '123454', 'hkkjhnm', '470051842_8926461377431586_6302607261897444135_n-2.jpg', 'lknlkjnk', 'jlkmbvgh', 'jknm,./,m', 'mn,n,m;/', 'kljn,k,nl', 'kjbnk,n,', 'lkklmlm', 'ljlmlmlm', '2025-01-05 17:27:47', '2025-01-05 17:27:47'),
(3, 3, 'aaaaa', 'aaa@f.com', '123454', 'hkkjhnm', '470051842_8926461377431586_6302607261897444135_n-2.jpg', 'lknlkjnk', 'jlkmbvgh', 'jknm,./,m', 'mn,n,m;/', 'kljn,k,nl', 'kjbnk,n,', 'lkklmlm', 'ljlmlmlm', '2025-01-05 17:31:39', '2025-01-05 17:31:39'),
(4, 3, 'aaa', 'aa@gamil.com', '1212321', '1232132', '470051842_8926461377431586_6302607261897444135_n-2.jpg', 'dewap[s', 'ca;oc', 'cas;l', 'afc;ld', 'acdsv;', 'af;lv', 'dfcs', 'asvdm;', '2025-01-05 17:39:32', '2025-01-05 17:39:32'),
(5, 3, 'jlk', 'jbj@gmail.com', '123456', 'ghjknlz', '470051842_8926461377431586_6302607261897444135_n-2.jpg', 'zxak', 'jio', 'xpos', 'sxk;xas', 'asxopksxa', 'xaskp;xsa', 'axspokaoxs', 'axs;sa;,', '2025-01-05 17:40:02', '2025-01-05 17:40:02'),
(6, 3, 'jlk', 'jbj@gmail.com', '123456', 'ghjknlz', '470051842_8926461377431586_6302607261897444135_n-2.jpg', 'zxak', 'jio', 'xpos', 'sxk;xas', 'asxopksxa', 'xaskp;xsa', 'axspokaoxs', 'axs;sa;,', '2025-01-05 17:41:20', '2025-01-05 17:41:20'),
(7, 3, 'hiilk', 'dd@mai.lk', '1234567', 'lkhjvbn', '470051842_8926461377431586_6302607261897444135_n-2.jpg', '', '', '', '', '', '', '', '', '2025-01-05 19:04:52', '2025-01-05 19:04:52'),
(8, 3, 'hiilk', 'dd@mai.lk', '1234567', 'lkhjvbn', '470051842_8926461377431586_6302607261897444135_n-2.jpg', '', '', '', '', '', '', '', '', '2025-01-05 19:04:54', '2025-01-05 19:04:54'),
(9, 3, 'hiilk', 'dd@mai.lk', '1234567', 'lkhjvbn', '470051842_8926461377431586_6302607261897444135_n-2.jpg', '', '', '', '', '', '', '', '', '2025-01-05 19:05:09', '2025-01-05 19:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `anik_saved_jobs`
--

CREATE TABLE `anik_saved_jobs` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `saved_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anik_saved_jobs`
--

INSERT INTO `anik_saved_jobs` (`id`, `user_id`, `post_id`, `saved_at`) VALUES
(10, 9, 5, '2025-01-06 05:11:15'),
(15, 3, 5, '2025-01-21 14:24:50'),
(16, 12, 5, '2025-01-22 07:51:21'),
(17, 3, 10, '2025-01-22 14:12:09'),
(18, 13, 10, '2025-01-23 08:05:14'),
(19, 13, 1, '2025-01-23 08:05:15'),
(20, 13, 2, '2025-01-23 08:05:16'),
(21, 13, 5, '2025-01-23 08:05:16'),
(22, 13, 6, '2025-01-23 08:05:17'),
(23, 13, 7, '2025-01-23 08:05:18'),
(24, 13, 8, '2025-01-23 08:05:19'),
(25, 14, 11, '2025-01-29 05:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `anik_skill_tests`
--

CREATE TABLE `anik_skill_tests` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `sector` varchar(100) DEFAULT NULL,
  `test_result` varchar(100) DEFAULT NULL,
  `test_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anik_users`
--

CREATE TABLE `anik_users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','moderator','employee','applicant') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `banned` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anik_users`
--

INSERT INTO `anik_users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `banned`) VALUES
(3, 'a', 'a@gmail.com', '$2y$10$sLtZVxYDWEI8X4zCfU4ENu7IxUpew2B3XJ43HlVQJG9rvQP8BD3JS', 'applicant', '2025-01-05 09:59:28', 0),
(4, 'a', 'aaa@gmail.com', '$2y$10$a4RdlKyVgXqjHyMopWQFXe4GyTsT1oRU/pc1lnVBXJCj73RKPT/oK', 'applicant', '2025-01-05 10:01:45', 0),
(5, 'k', 'k@gmail.com', '$2y$10$cM.r.PmjtoBJHu1E4f4ZnOdqmUMinR1UCN0RM7S5XNfCAKuqotB66', 'employee', '2025-01-05 10:16:29', 0),
(7, 'anik', 'man@gmail.com', '123', 'moderator', '2025-01-05 15:56:36', 0),
(8, 'robi', 'hasanmaruf0055@gmail.com', '$2y$10$BrAnkJPotuYUvoeZypxEMOZDhWILPb933ERvjkO7B6oby67DLvHKG', 'applicant', '2025-01-06 03:10:15', 0),
(9, 'samia', 'samia123@gmail.com', '$2y$10$sYLyDrYKY26NwlNu3qtN0.NSoubfO0TtGBeBXLHB.bNCBwh2kf3xC', 'applicant', '2025-01-06 05:09:43', 0),
(10, 'Maaanik', 'mannnik@gamil.com', '$2y$10$2CjA7ejQk.aTi/4scr..YOPeA4E//kQtKUXA.K175URu7CxNQF3J.', 'applicant', '2025-01-19 14:19:31', 0),
(11, 'proper', 'proper23@gmail.com', '$2y$10$Z43F3SeGGwxGsmyPF43JhuxIQhp2NQlQGReld5yoSVGWemgeUAHj6', 'employee', '2025-01-19 15:08:48', 0),
(12, 'samia12', 'samia12@gamil.com', '$2y$10$zfHX7.xhjTCEBsoiT3EUx.mfZbigwdBXM6/Xg2XcdzjnNBRSstjYG', 'applicant', '2025-01-22 07:49:53', 0),
(13, 'Redoy', 'redoy@gamil.com', '$2y$10$QFDKdBpXBJ1.tVrB8Eu0G.CB1N8dJdcgfErvwLz7Y2/91s6OtdHo.', 'applicant', '2025-01-23 08:01:32', 0),
(14, 'Jeff', 'dandexuwu123@gmail.com', '$2y$10$Ffvuy6QPBg16BSgyjUliguKqMXyxLMKy.n0voRqFUXa.NP8h4FxDa', 'applicant', '2025-01-29 05:02:58', 0),
(19, 'jaaa', 'dandexugggwu123@gmail.com', '$2y$10$rwMU/8V6noX3ITciEOnyR.RfB7/CDhdBmwfAwjOaERlku.xghiZL6', 'applicant', '2025-01-29 05:20:31', 0),
(20, 'Wrongman', 'qqqtsai8432@gmail.com', '$2y$10$UDi4vHGwxSeo3jg3.BtvKe7KMreRDIoJLUOF4OIxjwqEpasl7.2ba', 'applicant', '2025-01-29 05:47:37', 0),
(21, 'huzur', 'tsaiii8432@gmail.com', '$2y$10$qUMDZFiSzGu0P5G8iYH9DeNqRyc8VDQCyQW.Vr8fsO8X4G1KRddL6', 'applicant', '2025-01-29 05:53:55', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anik_applicants`
--
ALTER TABLE `anik_applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `anik_applications`
--
ALTER TABLE `anik_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `anik_jobs`
--
ALTER TABLE `anik_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `anik_posts`
--
ALTER TABLE `anik_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posted_by` (`posted_by`);

--
-- Indexes for table `anik_resumes`
--
ALTER TABLE `anik_resumes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `anik_saved_jobs`
--
ALTER TABLE `anik_saved_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `anik_skill_tests`
--
ALTER TABLE `anik_skill_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `anik_users`
--
ALTER TABLE `anik_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anik_applicants`
--
ALTER TABLE `anik_applicants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anik_applications`
--
ALTER TABLE `anik_applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `anik_jobs`
--
ALTER TABLE `anik_jobs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `anik_posts`
--
ALTER TABLE `anik_posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anik_resumes`
--
ALTER TABLE `anik_resumes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `anik_saved_jobs`
--
ALTER TABLE `anik_saved_jobs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `anik_skill_tests`
--
ALTER TABLE `anik_skill_tests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anik_users`
--
ALTER TABLE `anik_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anik_applicants`
--
ALTER TABLE `anik_applicants`
  ADD CONSTRAINT `anik_applicants_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `anik_users` (`id`);

--
-- Constraints for table `anik_applications`
--
ALTER TABLE `anik_applications`
  ADD CONSTRAINT `anik_applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `anik_jobs` (`id`),
  ADD CONSTRAINT `anik_applications_ibfk_2` FOREIGN KEY (`applicant_id`) REFERENCES `anik_users` (`id`);

--
-- Constraints for table `anik_jobs`
--
ALTER TABLE `anik_jobs`
  ADD CONSTRAINT `anik_jobs_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `anik_users` (`id`);

--
-- Constraints for table `anik_posts`
--
ALTER TABLE `anik_posts`
  ADD CONSTRAINT `anik_posts_ibfk_1` FOREIGN KEY (`posted_by`) REFERENCES `anik_users` (`id`);

--
-- Constraints for table `anik_resumes`
--
ALTER TABLE `anik_resumes`
  ADD CONSTRAINT `anik_resumes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `anik_users` (`id`);

--
-- Constraints for table `anik_saved_jobs`
--
ALTER TABLE `anik_saved_jobs`
  ADD CONSTRAINT `anik_saved_jobs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `anik_users` (`id`),
  ADD CONSTRAINT `anik_saved_jobs_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `anik_jobs` (`id`);

--
-- Constraints for table `anik_skill_tests`
--
ALTER TABLE `anik_skill_tests`
  ADD CONSTRAINT `anik_skill_tests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `anik_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

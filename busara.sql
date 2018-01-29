-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 29, 2018 at 11:09 AM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `busara`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE `apply` (
  `id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `job_ID` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `CV` varchar(255) NOT NULL,
  `applyDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apply`
--

INSERT INTO `apply` (`id`, `employer_id`, `job_ID`, `fname`, `lname`, `email`, `CV`, `applyDate`, `status`) VALUES
(6, 3, 22, 'demo', 'user', 'demo.user@testing.com', 'Demo User - Cartoon Artist - (181062).pdf', '2017-09-01 04:08:12', 'Processing'),
(7, 1, 21, 'maurice', 'wagura', 'wagura465@gmail.com', 'Maurice Wagura - Clinical Nurse  - (263494).pdf', '2018-01-29 08:32:25', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `joinDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `email`, `password`, `company`, `logo`, `joinDate`, `status`) VALUES
(1, 'careers@infotex.co.ke', 'e10adc3949ba59abbe56e057f20f883e', 'infotex ICT Solutions INC.', 'infotex.jpg', '2017-08-29 04:06:00', 'active'),
(3, 'careers@tiesto.music', 'e10adc3949ba59abbe56e057f20f883e', 'tiesto music', 'tiesto_music.jpg', '2017-08-29 04:08:13', 'active'),
(4, 'admin@busara.com', '25d55ad283aa400af464c76d713c07ad', 'mhub', '197177-mhub.jpg', '2018-01-29 08:02:52', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `tittle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `overview` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qualification` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `responsibilities` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `requirements` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `wType` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deadline` date NOT NULL,
  `employer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `tittle`, `overview`, `qualification`, `responsibilities`, `requirements`, `category`, `wType`, `location`, `postDate`, `deadline`, `employer_id`) VALUES
(16, 'web designer / developer', 'in marketing communications, we dream it and create it. all of the company’s promotional and communication needs are completed in-house by these “creatives” in an advertising agency-based set-up. this includes everything from advertising, promotions and print production to media relations, exhibition coordination and website maintenance. everyone from artists, writers, designers, media buyers, event coordinators, video producers/editors and public relations specialists work together to bring campaigns and product-centric promotions to life.', '&lt;ul&gt;&lt;li&gt;✔ demonstrated strong and effective verbal, written, and interpersonal communication skills&lt;/li&gt;&lt;li&gt;✔ must be team-oriented, possess a positive attitude and work well with others&lt;/li&gt;&lt;li&gt;✔ ability to prioritize and multi-task in a flexible, fast paced and challenging environment&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ provide technical health advice to head of country programmes and field advisors at all key stages of the project management cycle including needs assessment.&lt;/li&gt;&lt;li&gt;✔ technical strategy and design, implementation as well as sector specific monitoring and evaluation.&lt;/li&gt;&lt;li&gt;✔ this includes travel to field programmes as well as review of proposals, key reports and surveys prior to external submission.&lt;/li&gt;&lt;li&gt;✔ stay abreast of current best practice. research and stay informed on academic and technical health and nutrition issues, techniques, and guidelines to inform and improve programming.&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.&lt;/li&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.\r\nstrongly prefer candidates with high school diploma&lt;/li&gt;&lt;li&gt;✔ must be able to perform physical activities that require considerable use of your arms and legs and moving your whole body, such as climbing, lifting, balancing, walking, stooping, and handling of materials.&lt;/li&gt;&lt;/ul&gt;', 'IT', 'Full-Time', 'Mombasa', '2017-09-01 03:35:13', '2017-11-24', 3),
(17, 'business administrator', 'in marketing communications, we dream it and create it. all of the company’s promotional and communication needs are completed in-house by these “creatives” in an advertising agency-based set-up. this includes everything from advertising, promotions and print production to media relations, exhibition coordination and website maintenance. everyone from artists, writers, designers, media buyers, event coordinators, video producers/editors and public relations specialists work together to bring campaigns and product-centric promotions to life.', '&lt;ul&gt;&lt;li&gt;✔ demonstrated strong and effective verbal, written, and interpersonal communication skills&lt;/li&gt;&lt;li&gt;✔ must be team-oriented, possess a positive attitude and work well with others&lt;/li&gt;&lt;li&gt;✔ ability to prioritize and multi-task in a flexible, fast paced and challenging environment&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ provide technical health advice to head of country programmes and field advisors at all key stages of the project management cycle including needs assessment.&lt;/li&gt;&lt;li&gt;✔ technical strategy and design, implementation as well as sector specific monitoring and evaluation.&lt;/li&gt;&lt;li&gt;✔ this includes travel to field programmes as well as review of proposals, key reports and surveys prior to external submission.&lt;/li&gt;&lt;li&gt;✔ stay abreast of current best practice. research and stay informed on academic and technical health and nutrition issues, techniques, and guidelines to inform and improve programming.&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.&lt;/li&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.\r\nstrongly prefer candidates with high school diploma&lt;/li&gt;&lt;li&gt;✔ must be able to perform physical activities that require considerable use of your arms and legs and moving your whole body, such as climbing, lifting, balancing, walking, stooping, and handling of materials.&lt;/li&gt;&lt;/ul&gt;', 'Finance', 'Contract', 'Bungoma', '2017-09-01 03:35:13', '2017-11-24', 3),
(18, 'music producer', 'in marketing communications, we dream it and create it. all of the company’s promotional and communication needs are completed in-house by these “creatives” in an advertising agency-based set-up. this includes everything from advertising, promotions and print production to media relations, exhibition coordination and website maintenance. everyone from artists, writers, designers, media buyers, event coordinators, video producers/editors and public relations specialists work together to bring campaigns and product-centric promotions to life.', '&lt;ul&gt;&lt;li&gt;✔ demonstrated strong and effective verbal, written, and interpersonal communication skills&lt;/li&gt;&lt;li&gt;✔ must be team-oriented, possess a positive attitude and work well with others&lt;/li&gt;&lt;li&gt;✔ ability to prioritize and multi-task in a flexible, fast paced and challenging environment&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ provide technical health advice to head of country programmes and field advisors at all key stages of the project management cycle including needs assessment.&lt;/li&gt;&lt;li&gt;✔ technical strategy and design, implementation as well as sector specific monitoring and evaluation.&lt;/li&gt;&lt;li&gt;✔ this includes travel to field programmes as well as review of proposals, key reports and surveys prior to external submission.&lt;/li&gt;&lt;li&gt;✔ stay abreast of current best practice. research and stay informed on academic and technical health and nutrition issues, techniques, and guidelines to inform and improve programming.&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.&lt;/li&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.\r\nstrongly prefer candidates with high school diploma&lt;/li&gt;&lt;li&gt;✔ must be able to perform physical activities that require considerable use of your arms and legs and moving your whole body, such as climbing, lifting, balancing, walking, stooping, and handling of materials.&lt;/li&gt;&lt;/ul&gt;', 'Entertainment', 'Freelance', 'Nairobi', '2017-09-01 03:35:13', '2018-02-28', 3),
(19, 'product marketer ', 'in marketing communications, we dream it and create it. all of the company’s promotional and communication needs are completed in-house by these “creatives” in an advertising agency-based set-up. this includes everything from advertising, promotions and print production to media relations, exhibition coordination and website maintenance. everyone from artists, writers, designers, media buyers, event coordinators, video producers/editors and public relations specialists work together to bring campaigns and product-centric promotions to life.', '&lt;ul&gt;&lt;li&gt;✔ demonstrated strong and effective verbal, written, and interpersonal communication skills&lt;/li&gt;&lt;li&gt;✔ must be team-oriented, possess a positive attitude and work well with others&lt;/li&gt;&lt;li&gt;✔ ability to prioritize and multi-task in a flexible, fast paced and challenging environment&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ provide technical health advice to head of country programmes and field advisors at all key stages of the project management cycle including needs assessment.&lt;/li&gt;&lt;li&gt;✔ technical strategy and design, implementation as well as sector specific monitoring and evaluation.&lt;/li&gt;&lt;li&gt;✔ this includes travel to field programmes as well as review of proposals, key reports and surveys prior to external submission.&lt;/li&gt;&lt;li&gt;✔ stay abreast of current best practice. research and stay informed on academic and technical health and nutrition issues, techniques, and guidelines to inform and improve programming.&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.&lt;/li&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.\r\nstrongly prefer candidates with high school diploma&lt;/li&gt;&lt;li&gt;✔ must be able to perform physical activities that require considerable use of your arms and legs and moving your whole body, such as climbing, lifting, balancing, walking, stooping, and handling of materials.&lt;/li&gt;&lt;/ul&gt;', 'Sales', 'Internship', 'Nakuru', '2017-09-01 03:35:13', '2018-02-28', 1),
(20, 'club promoter ', 'in marketing communications, we dream it and create it. all of the company’s promotional and communication needs are completed in-house by these “creatives” in an advertising agency-based set-up. this includes everything from advertising, promotions and print production to media relations, exhibition coordination and website maintenance. everyone from artists, writers, designers, media buyers, event coordinators, video producers/editors and public relations specialists work together to bring campaigns and product-centric promotions to life.', '&lt;ul&gt;&lt;li&gt;✔ demonstrated strong and effective verbal, written, and interpersonal communication skills&lt;/li&gt;&lt;li&gt;✔ must be team-oriented, possess a positive attitude and work well with others&lt;/li&gt;&lt;li&gt;✔ ability to prioritize and multi-task in a flexible, fast paced and challenging environment&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ provide technical health advice to head of country programmes and field advisors at all key stages of the project management cycle including needs assessment.&lt;/li&gt;&lt;li&gt;✔ technical strategy and design, implementation as well as sector specific monitoring and evaluation.&lt;/li&gt;&lt;li&gt;✔ this includes travel to field programmes as well as review of proposals, key reports and surveys prior to external submission.&lt;/li&gt;&lt;li&gt;✔ stay abreast of current best practice. research and stay informed on academic and technical health and nutrition issues, techniques, and guidelines to inform and improve programming.&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.&lt;/li&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.\r\nstrongly prefer candidates with high school diploma&lt;/li&gt;&lt;li&gt;✔ must be able to perform physical activities that require considerable use of your arms and legs and moving your whole body, such as climbing, lifting, balancing, walking, stooping, and handling of materials.&lt;/li&gt;&lt;/ul&gt;', 'Entertainment', 'Contract', 'Kisumu', '2017-09-01 03:35:13', '2018-02-28', 1),
(21, 'clinical nurse ', 'in marketing communications, we dream it and create it. all of the company’s promotional and communication needs are completed in-house by these “creatives” in an advertising agency-based set-up. this includes everything from advertising, promotions and print production to media relations, exhibition coordination and website maintenance. everyone from artists, writers, designers, media buyers, event coordinators, video producers/editors and public relations specialists work together to bring campaigns and product-centric promotions to life.', '&lt;ul&gt;&lt;li&gt;✔ demonstrated strong and effective verbal, written, and interpersonal communication skills&lt;/li&gt;&lt;li&gt;✔ must be team-oriented, possess a positive attitude and work well with others&lt;/li&gt;&lt;li&gt;✔ ability to prioritize and multi-task in a flexible, fast paced and challenging environment&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ provide technical health advice to head of country programmes and field advisors at all key stages of the project management cycle including needs assessment.&lt;/li&gt;&lt;li&gt;✔ technical strategy and design, implementation as well as sector specific monitoring and evaluation.&lt;/li&gt;&lt;li&gt;✔ this includes travel to field programmes as well as review of proposals, key reports and surveys prior to external submission.&lt;/li&gt;&lt;li&gt;✔ stay abreast of current best practice. research and stay informed on academic and technical health and nutrition issues, techniques, and guidelines to inform and improve programming.&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.&lt;/li&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.\r\nstrongly prefer candidates with high school diploma&lt;/li&gt;&lt;li&gt;✔ must be able to perform physical activities that require considerable use of your arms and legs and moving your whole body, such as climbing, lifting, balancing, walking, stooping, and handling of materials.&lt;/li&gt;&lt;/ul&gt;', 'Healthcare', 'Voluntary', 'Lamu', '2017-09-01 03:35:13', '2018-02-28', 1),
(22, 'cartoon artist', 'in marketing communications, we dream it and create it. all of the company’s promotional and communication needs are completed in-house by these “creatives” in an advertising agency-based set-up. this includes everything from advertising, promotions and print production to media relations, exhibition coordination and website maintenance. everyone from artists, writers, designers, media buyers, event coordinators, video producers/editors and public relations specialists work together to bring campaigns and product-centric promotions to life.', '&lt;ul&gt;&lt;li&gt;✔ demonstrated strong and effective verbal, written, and interpersonal communication skills&lt;/li&gt;&lt;li&gt;✔ must be team-oriented, possess a positive attitude and work well with others&lt;/li&gt;&lt;li&gt;✔ ability to prioritize and multi-task in a flexible, fast paced and challenging environment&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ provide technical health advice to head of country programmes and field advisors at all key stages of the project management cycle including needs assessment.&lt;/li&gt;&lt;li&gt;✔ technical strategy and design, implementation as well as sector specific monitoring and evaluation.&lt;/li&gt;&lt;li&gt;✔ this includes travel to field programmes as well as review of proposals, key reports and surveys prior to external submission.&lt;/li&gt;&lt;li&gt;✔ stay abreast of current best practice. research and stay informed on academic and technical health and nutrition issues, techniques, and guidelines to inform and improve programming.&lt;/li&gt;&lt;/ul&gt;', '&lt;ul&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.&lt;/li&gt;&lt;li&gt;✔ must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.\r\nstrongly prefer candidates with high school diploma&lt;/li&gt;&lt;li&gt;✔ must be able to perform physical activities that require considerable use of your arms and legs and moving your whole body, such as climbing, lifting, balancing, walking, stooping, and handling of materials.&lt;/li&gt;&lt;/ul&gt;', 'Design', 'Contract', 'Kiambu', '2017-09-01 03:35:13', '2018-02-28', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

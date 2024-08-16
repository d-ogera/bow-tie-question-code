-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 11:34 PM
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
-- Database: `bows`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `action_id` int(11) NOT NULL,
  `action_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`action_id`, `action_text`) VALUES
(11, 'Correct Action 1:'),
(12, 'Correct Action 2:'),
(13, 'Incorrect Action 1:'),
(14, 'Incorrect Action 2:'),
(15, 'Incorrect Action 3:'),
(16, 'Correct Action 1:b'),
(17, 'Correct Action 2:b'),
(18, 'Incorrect Action 1:b'),
(19, 'Incorrect Action 2:b'),
(20, 'Incorrect Action 3:b');

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE `conditions` (
  `condition_id` int(11) NOT NULL,
  `condition_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`condition_id`, `condition_text`) VALUES
(9, 'correct condition'),
(10, 'Incorrect Condition 1:'),
(11, 'Incorrect Condition 2:'),
(12, 'Incorrect Condition 3:'),
(13, 'correct condition b'),
(14, 'Incorrect Condition 1:b'),
(15, 'Incorrect Condition 2:b'),
(16, 'Incorrect Condition 3:b');

-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE `parameters` (
  `parameter_id` int(11) NOT NULL,
  `parameter_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parameters`
--

INSERT INTO `parameters` (`parameter_id`, `parameter_text`) VALUES
(11, 'Correct Parameter 1:'),
(12, 'Correct Parameter 2:'),
(13, 'Incorrect Parameter 1:'),
(14, 'Incorrect Parameter 2:'),
(15, 'Incorrect Parameter 3:'),
(16, 'Correct Parameter 1:b'),
(17, 'Correct Parameter 2:b'),
(18, 'Incorrect Parameter 1:b'),
(19, 'Incorrect Parameter 2:b'),
(20, 'Incorrect Parameter 3:b');

-- --------------------------------------------------------

--
-- Table structure for table `question_actions`
--

CREATE TABLE `question_actions` (
  `qa_id` int(11) NOT NULL,
  `qa_question` int(11) DEFAULT NULL,
  `qa_action` int(11) DEFAULT NULL,
  `qa_is_correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_actions`
--

INSERT INTO `question_actions` (`qa_id`, `qa_question`, `qa_action`, `qa_is_correct`) VALUES
(11, 3, 11, 1),
(12, 3, 12, 1),
(13, 3, 13, 0),
(14, 3, 14, 0),
(15, 3, 15, 0),
(16, 4, 16, 1),
(17, 4, 17, 1),
(18, 4, 18, 0),
(19, 4, 19, 0),
(20, 4, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_conditions`
--

CREATE TABLE `question_conditions` (
  `qc_id` int(11) NOT NULL,
  `qc_question` int(11) DEFAULT NULL,
  `qc_condition` int(11) DEFAULT NULL,
  `qc_is_correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_conditions`
--

INSERT INTO `question_conditions` (`qc_id`, `qc_question`, `qc_condition`, `qc_is_correct`) VALUES
(9, 3, 9, 1),
(10, 3, 10, 0),
(11, 3, 11, 0),
(12, 3, 12, 0),
(13, 4, 13, 1),
(14, 4, 14, 0),
(15, 4, 15, 0),
(16, 4, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_parameters`
--

CREATE TABLE `question_parameters` (
  `qp_id` int(11) NOT NULL,
  `qp_question` int(11) DEFAULT NULL,
  `qp_parameter` int(11) DEFAULT NULL,
  `qp_is_correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_parameters`
--

INSERT INTO `question_parameters` (`qp_id`, `qp_question`, `qp_parameter`, `qp_is_correct`) VALUES
(11, 3, 11, 1),
(12, 3, 12, 1),
(13, 3, 13, 0),
(14, 3, 14, 0),
(15, 3, 15, 0),
(16, 4, 16, 1),
(17, 4, 17, 1),
(18, 4, 18, 0),
(19, 4, 19, 0),
(20, 4, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quizes`
--

CREATE TABLE `quizes` (
  `question_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `question_author` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizes`
--

INSERT INTO `quizes` (`question_id`, `question_text`, `question_author`) VALUES
(3, 'test quiz 1', 1),
(4, 'question 2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_scores`
--

CREATE TABLE `user_scores` (
  `score_id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `condition_correct` tinyint(1) DEFAULT NULL,
  `action1_correct` tinyint(1) DEFAULT NULL,
  `action2_correct` tinyint(1) DEFAULT NULL,
  `parameter1_correct` tinyint(1) DEFAULT NULL,
  `parameter2_correct` tinyint(1) DEFAULT NULL,
  `total_score` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_scores`
--

INSERT INTO `user_scores` (`score_id`, `u_id`, `quiz_id`, `condition_correct`, `action1_correct`, `action2_correct`, `parameter1_correct`, `parameter2_correct`, `total_score`, `created_at`) VALUES
(1, 1, 4, 1, 1, 1, 1, 1, 5, '2024-08-16 21:16:10'),
(2, 1, 4, 0, 1, 0, 1, 0, 2, '2024-08-16 21:19:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`condition_id`);

--
-- Indexes for table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`parameter_id`);

--
-- Indexes for table `question_actions`
--
ALTER TABLE `question_actions`
  ADD PRIMARY KEY (`qa_id`),
  ADD KEY `question_id` (`qa_question`),
  ADD KEY `action_id` (`qa_action`);

--
-- Indexes for table `question_conditions`
--
ALTER TABLE `question_conditions`
  ADD PRIMARY KEY (`qc_id`),
  ADD KEY `question_id` (`qc_question`),
  ADD KEY `condition_id` (`qc_condition`);

--
-- Indexes for table `question_parameters`
--
ALTER TABLE `question_parameters`
  ADD PRIMARY KEY (`qp_id`),
  ADD KEY `question_id` (`qp_question`),
  ADD KEY `parameter_id` (`qp_parameter`);

--
-- Indexes for table `quizes`
--
ALTER TABLE `quizes`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `user_scores`
--
ALTER TABLE `user_scores`
  ADD PRIMARY KEY (`score_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `conditions`
--
ALTER TABLE `conditions`
  MODIFY `condition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `parameter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `question_actions`
--
ALTER TABLE `question_actions`
  MODIFY `qa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `question_conditions`
--
ALTER TABLE `question_conditions`
  MODIFY `qc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `question_parameters`
--
ALTER TABLE `question_parameters`
  MODIFY `qp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `quizes`
--
ALTER TABLE `quizes`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_scores`
--
ALTER TABLE `user_scores`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question_actions`
--
ALTER TABLE `question_actions`
  ADD CONSTRAINT `question_actions_ibfk_1` FOREIGN KEY (`qa_question`) REFERENCES `quizes` (`question_id`),
  ADD CONSTRAINT `question_actions_ibfk_2` FOREIGN KEY (`qa_action`) REFERENCES `actions` (`action_id`);

--
-- Constraints for table `question_conditions`
--
ALTER TABLE `question_conditions`
  ADD CONSTRAINT `question_conditions_ibfk_1` FOREIGN KEY (`qc_question`) REFERENCES `quizes` (`question_id`),
  ADD CONSTRAINT `question_conditions_ibfk_2` FOREIGN KEY (`qc_condition`) REFERENCES `conditions` (`condition_id`);

--
-- Constraints for table `question_parameters`
--
ALTER TABLE `question_parameters`
  ADD CONSTRAINT `question_parameters_ibfk_1` FOREIGN KEY (`qp_question`) REFERENCES `quizes` (`question_id`),
  ADD CONSTRAINT `question_parameters_ibfk_2` FOREIGN KEY (`qp_parameter`) REFERENCES `parameters` (`parameter_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

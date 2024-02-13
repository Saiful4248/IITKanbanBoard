-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2023 at 06:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iitkanbanboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate_users`
--

CREATE TABLE `candidate_users` (
  `User_Email` varchar(50) NOT NULL,
  `User_Name` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Status` varchar(10) NOT NULL DEFAULT 'Inactive',
  `Verification_Code` varchar(10) NOT NULL,
  `Create_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Id` int(11) NOT NULL,
  `Task_Id` int(11) NOT NULL,
  `Parent_Id` int(11) NOT NULL,
  `sender` int(50) NOT NULL,
  `comment` int(11) NOT NULL,
  `Comment_Time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `File_Id` int(11) NOT NULL,
  `Task_Id` int(11) NOT NULL,
  `File_Name` int(11) NOT NULL,
  `File_Size` int(11) NOT NULL,
  `File_Type` varchar(100) NOT NULL,
  `File_Path` int(11) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `Project_Id` int(11) NOT NULL,
  `Project_Name` varchar(50) NOT NULL,
  `Project_Description` longtext NOT NULL,
  `Supervisor_Id` int(11) NOT NULL,
  `Accept_Status` varchar(10) NOT NULL,
  `Creator_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`Project_Id`, `Project_Name`, `Project_Description`, `Supervisor_Id`, `Accept_Status`, `Creator_Id`) VALUES
(28, 'Testing Project', 'Group Project For SPl', 14, 'YES', 13);

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `Project_Id` int(11) NOT NULL,
  `Member_Id` int(11) NOT NULL,
  `Join_Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_members`
--

INSERT INTO `project_members` (`Project_Id`, `Member_Id`, `Join_Status`) VALUES
(28, 13, 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `Task_Id` int(11) NOT NULL,
  `Project_Id` int(11) NOT NULL,
  `Task_Name` varchar(50) NOT NULL,
  `Task_Description` longtext NOT NULL,
  `Assign_Member` int(11) NOT NULL,
  `Creation_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Due_Date` datetime NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'TO DO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_Id` int(11) NOT NULL,
  `User_Email` varchar(50) NOT NULL,
  `User_Name` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_Id`, `User_Email`, `User_Name`, `Password`) VALUES
(13, 'jannatietu.nstu@gmail.com', 'Jannatun Nur Etu', '$2y$10$xX9N882S/lUvVDbS/dZpsObJpDZZXxxuL.8GH/XgvIMFAt/YpxhXe'),
(14, 'raju.iit3@gmail.com', 'Md. Raju Mia', '$2y$10$tTzWt6jnilXnGN2XxWMbV.ADcRv4adCpEuDaE8TjMJnpTxkUMnqYa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate_users`
--
ALTER TABLE `candidate_users`
  ADD UNIQUE KEY `User_Email` (`User_Email`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Task_Id` (`Task_Id`),
  ADD KEY `commenter` (`sender`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`File_Id`),
  ADD KEY `Task_Id` (`Task_Id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`Project_Id`),
  ADD KEY `Supervisor_Id` (`Supervisor_Id`),
  ADD KEY `Creator_Id` (`Creator_Id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD KEY `Member_Id` (`Member_Id`),
  ADD KEY `Project_Id` (`Project_Id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`Task_Id`),
  ADD KEY `Project_Id` (`Project_Id`),
  ADD KEY `Assign_Member` (`Assign_Member`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`),
  ADD UNIQUE KEY `User_Email` (`User_Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `File_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `Project_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `Task_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`Task_Id`) REFERENCES `tasks` (`Task_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `users` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`Task_Id`) REFERENCES `tasks` (`Task_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`Supervisor_Id`) REFERENCES `users` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`Creator_Id`) REFERENCES `users` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_members`
--
ALTER TABLE `project_members`
  ADD CONSTRAINT `project_members_ibfk_1` FOREIGN KEY (`Member_Id`) REFERENCES `users` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_members_ibfk_2` FOREIGN KEY (`Project_Id`) REFERENCES `projects` (`Project_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`Project_Id`) REFERENCES `projects` (`Project_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`Assign_Member`) REFERENCES `users` (`User_Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

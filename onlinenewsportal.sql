-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2022 at 07:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinenewsportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentnews`
--

CREATE TABLE `commentnews` (
  `commentid` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `newsid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commentnews`
--

INSERT INTO `commentnews` (`commentid`, `message`, `date`, `newsid`, `userid`, `username`) VALUES
(12, 'helloo', '2022-09-10 20:12:54', 15, 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `access` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `access`) VALUES
(1, 'admin', 'admin', 'Admin'),
(2, 'rafsan', 'rafsan', 'Viewer'),
(3, 'rbr', 'rbr123', 'Viewer'),
(5, 'rafsan', 'rafsan', 'Viewer');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `shortdescription` varchar(255) DEFAULT NULL,
  `mainimage` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `subimage` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `newstype` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `shortdescription`, `mainimage`, `description`, `subimage`, `date`, `newstype`) VALUES
(11, 'Consent Form', 'Consent Form Details', 'consent form.png', ' A consent form is a signed document that outlines the informed consent of an individual for a medical study, clinical trial, or activity. Whether you’re looking for a way to gather model releases, activity waivers, parental consent, or medical consent forms, you can start by selecting one of our 400+ Consent Form Templates. Once you’ve chosen a consent form and customized its terms and conditions, all that’s left to do is embed the form on your website, send the link via email, or let participants fill out the form in person on your tablet or computer — you’ll then be able to securely collect consent forms online! You can even link your custom form to one of our Consent Agreement PDF Templates , to automatically turn form submissions into professional PDF documents.     ', '', '2022-09-03 21:30:18', 'Education'),
(13, 'Australia\'s Cameron Green plays a shot during the first one-day international (ODI) cricket match', 'Emerging star Cameron Green held his nerve with a career best 89 not out in Australia\'s thrilling two-wicket victory over New Zealand in the first one-day international on Tuesday in Cairns.  ', '000-32hr6e7.jpeg', 'Emerging star Cameron Green held his nerve with a career best 89 not out in Australia\'s thrilling two-wicket victory over New Zealand in the first one-day international on Tuesday in Cairns.  \r\n\r\nAfter Glenn Maxwell starred with four wickets and a spectacular catch to restrict New Zealand to a modest 232-9, Australia slumped to 44-5 against inspired new ball bowling from quicks Trent Boult and Matt Henry under lights. \r\n\r\nA composed Green and Alex Carey (85) turned the match on its head with a brilliant 158-run partnership to overwhelm an increasingly ragged New Zealand attack. \r\n\r\nBut Carey\'s dismissal in the 40th over triggered a late twist as Australia crashed to 207-8 and still needing 26 runs, a target made more difficult with Green in discomfort with cramps. \r\n\r\nGreen, however, would not be denied as Australia sealed victory in an anti-climax through a wide delivery from quick Lockie Ferguson to start the 46th over. ', '', '2022-09-07 13:09:25', 'Sports'),
(15, 'Go beyond trade and invest in Bangladesh for bigger gains, PM Hasina urges Indian businesses', 'In the last decade, several infrastructure projects have been initiated in Bangladesh which will contribute substantially to GDP growth, the premier says', 'untitled-1-53.jpeg', 'Prime Minister Sheikh Hasina on Wednesday said Bangladesh-India cooperation should go beyond trade to derive larger gains.\r\n\r\n“It should include investment, finance, services, technology transfer, and be placed within the context of regional cooperation,” she said.\r\n\r\nThe prime minister was addressing a business event, jointly organized by the Federation of Bangladesh Chambers of Commerce and Industry (FBCCI) and the Confederation of Indian Industry (CII) at the ITC Maurya hotel here in New Delhi.\r\n\r\nPM Hasina urged Indian investors to consider possible investments in infrastructure projects, manufacturing, energy and transport sectors in Bangladesh.\r\n\r\n“Indian investors and business houses can set up industries in Bangladesh through Buy-Back arrangements by reducing time, cost and resources,” she said.\r\n\r\nIn the fiscal year of 2021-22, the total amount of FDI inflow to Bangladesh was $1370.357 million while the proportion from India was only $15.751 million attributing only 1.15%, she noted.\r\n\r\n“So definitely, there is a real need for more collaboration between our two countries by way of involving business communities and trade bodies to find avenues towards deriving two-way trade and investment benefits,” the PM said.   ', '', '2022-09-07 13:14:33', 'Political');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentnews`
--
ALTER TABLE `commentnews`
  ADD PRIMARY KEY (`commentid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commentnews`
--
ALTER TABLE `commentnews`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

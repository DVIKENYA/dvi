-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2015 at 08:40 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dvidb`
--

-- --------------------------------------------------------

--
-- Structure for view `m_wastage`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `m_wastage` AS select `v`.`BCG` AS `BCG`,`v`.`DPT1` AS `DPT1`,`v`.`DPT2` AS `DPT2`,`v`.`Measles` AS `Measles`,`v`.`OPV` AS `OPV`,`v`.`OPV1` AS `OPV1`,`v`.`OPV2` AS `OPV2`,`v`.`OPV3` AS `OPV3`,`v`.`PCV1` AS `PCV1`,`v`.`PCV2` AS `PCV2`,`v`.`PCV3` AS `PCV3`,`v`.`ROTA` AS `ROTA`,`v`.`ROTA2` AS `ROTA2`,`s`.`population` AS `TotalPopulation`,`s`.`population_one` AS `PopulationOne`,`s`.`population_women` AS `PopulationWomen` from (`total_doses_adm` `v` join `m_county` `s`) where (`s`.`id` = 12);

--
-- VIEW  `m_wastage`
-- Data: None
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2015 at 04:32 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eunice`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllVaccines`()
BEGIN
SELECT Vaccine_name,ID FROM m_vaccines;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetVaccinesLedger`(IN `$selected_vaccine` VARCHAR(255))
BEGIN
SELECT mv.Vaccine_name, ms.transaction_date, ms.quantity_in,ms.quantity_out, ms.batch_number,ms.expiry_date,mvvm.name 
FROM m_stock_movement ms 
INNER JOIN m_stock_balance sb ON sb.batch_number=ms.batch_number 
LEFT JOIN m_vvm_status mvvm ON mvvm.id=ms.VVM_status 
LEFT JOIN m_vaccines mv ON mv.ID=ms.vaccine_id 
WHERE ms.vaccine_id= $selected_vaccine
ORDER BY ms.batch_number,ms.transaction_type;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_order_values`(
IN $selected_vaccine VARCHAR(255)
)
begin
SELECT sum(msb.`stock_balance`) AS stock_balance,
	   min(msb.`expiry_date`) as first_expiry_date, mv.Doses_required, mv.Wastage_factor 
       FROM `m_stock_balance` msb
       LEFT JOIN m_vaccines mv ON mv.ID= msb.`vaccine_id`
       WHERE msb.vaccine_id=$selected_vaccine;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setphysicalcount`(
IN p_vaccine_id  INT(11) ,
IN p_batch_number VARCHAR(20) ,
IN p_date_of_count DATE,
IN p_available_quantity INT,
IN p_physical_count INT,
IN p_discrepancy INT
)
BEGIN
 SET p_discrepancy = p_available_quantity - p_physical_count;
	INSERT INTO m_physical_count(vaccine_id,batch_number, date_of_count,available_quantity,physical_count,discrepancy)
               VALUES(p_vaccine_id,p_batch_number,p_date_of_count,p_available_quantity,p_physical_count,p_discrepancy);
               END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('480224c29c96a97fb63df7623965e98cddb22742', '::1', 1438976110, 0x6964656e746974797c733a31383a2261646d696e406476696b656e79612e636f6d223b757365726e616d657c733a31333a2261646d696e6973747261746f72223b656d61696c7c733a31383a2261646d696e406476696b656e79612e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343338393335313430223b),
('7f37f2d41ba71daa91f00086067239a660ec286a', '::1', 1439289850, '');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'national', 'National level users'),
(4, 'regional', 'Regional level users'),
(5, 'county', 'County level users'),
(6, 'subcounty', 'Sub-county level users'),
(7, 'executive', 'Executive managers'),
(8, 'partners', 'Partner managers');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `m_county`
--

CREATE TABLE IF NOT EXISTS `m_county` (
`id` int(14) NOT NULL,
  `county_name` varchar(255) NOT NULL,
  `region_id` varchar(255) NOT NULL,
  `county_headquarter` varchar(255) NOT NULL,
  `DHIS_ID` varchar(255) NOT NULL,
  `county_logistician` text NOT NULL,
  `county_logistician_phone` int(10) NOT NULL,
  `county_logistician_email` varchar(255) NOT NULL,
  `county_nurse` text NOT NULL,
  `county_nurse_phone` int(10) NOT NULL,
  `county_nurse_email` varchar(255) NOT NULL,
  `medical_technician` text NOT NULL,
  `medical_technician_phone` int(10) NOT NULL,
  `medical_technician_email` varchar(255) NOT NULL,
  `county_medicalofficer` text NOT NULL,
  `county_medicalofficer_phone` int(10) NOT NULL,
  `county_medicalofficer_email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_county`
--

INSERT INTO `m_county` (`id`, `county_name`, `region_id`, `county_headquarter`, `DHIS_ID`, `county_logistician`, `county_logistician_phone`, `county_logistician_email`, `county_nurse`, `county_nurse_phone`, `county_nurse_email`, `medical_technician`, `medical_technician_phone`, `medical_technician_email`, `county_medicalofficer`, `county_medicalofficer_phone`, `county_medicalofficer_email`) VALUES
(1, 'Nairobi', 'Nairobi', 'Nairobi', '', '', 0, '', '', 0, '', '', 0, '', '', 0, ''),
(2, 'Mombasa', 'Coast', 'Mombasa', '', '', 0, '', '', 0, '', '', 0, '', '', 0, ''),
(3, 'Kisumu', 'Nyanza', 'Kisumu', '', '', 0, '', '', 0, '', '', 0, '', '', 0, ''),
(4, 'Uasin Gishu', 'Rift Valley', 'Eldoret', '', '', 0, '', '', 0, '', '', 0, '', '', 0, ''),
(5, 'Nakuru', 'Rift Valley', 'Nakuru', '', '', 0, '', '', 0, '', '', 0, '', '', 0, ''),
(6, 'Kirinyaga', 'Central', 'Kerugoya', '', '', 0, '', '', 0, '', '', 0, '', '', 0, ''),
(7, 'Machakos', 'Seirin', 'Macha', 'A3444', 'Halima', 755887745, 'f@y.com', 'Joyce', 722557412, 'g@y.com', 'Sam Maundu', 712469877, 'r@w.com', 'George Kariuki', 723847512, 'gg@e.com');

-- --------------------------------------------------------

--
-- Table structure for table `m_depot`
--

CREATE TABLE IF NOT EXISTS `m_depot` (
`id` int(14) NOT NULL,
  `depot_name` varchar(255) NOT NULL,
  `depot_level` varchar(32) NOT NULL,
  `region_id` varchar(255) NOT NULL,
  `county_id` varchar(255) NOT NULL,
  `subcounty_id` varchar(255) NOT NULL,
  `elec_status` varchar(4) NOT NULL,
  `officer_incharge` varchar(48) NOT NULL,
  `email` text NOT NULL,
  `phone` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_depot`
--

INSERT INTO `m_depot` (`id`, `depot_name`, `depot_level`, `region_id`, `county_id`, `subcounty_id`, `elec_status`, `officer_incharge`, `email`, `phone`) VALUES
(2, 'Nairobi', 'Regional', '1', '1', '1', 'Yes', 'James Chege', 'j.chege@dvikenya.com', 2147483647),
(4, 'Kisumu', 'National', '4', '1', '1', 'Yes', 'Simeon Matutu', 's.matutu@dvikenya.com', 2147473647),
(5, 'Kisumu', 'National', '6', '1', '1', 'Yes', 'Jimnah Njoroge', 'j.njoroge@dvikenya.com', 2147473647);

-- --------------------------------------------------------

--
-- Table structure for table `m_facility`
--

CREATE TABLE IF NOT EXISTS `m_facility` (
`id` int(11) NOT NULL,
  `facility_name` text NOT NULL,
  `type` varchar(32) NOT NULL,
  `owner` varchar(32) NOT NULL,
  `dhis_id` int(11) NOT NULL,
  `mfl_code` int(11) NOT NULL,
  `officer_incharge` varchar(48) NOT NULL,
  `email` text NOT NULL,
  `phone` int(11) NOT NULL,
  `region_id` int(32) NOT NULL,
  `county_id` int(32) NOT NULL,
  `subcounty_id` int(32) NOT NULL,
  `constituency` varchar(32) NOT NULL,
  `ward` varchar(32) NOT NULL,
  `nearest_town` varchar(32) NOT NULL,
  `nearest_town_distance` int(11) NOT NULL,
  `nearest_depot_distance` int(11) NOT NULL,
  `wcba_pop` int(11) NOT NULL,
  `pop` int(11) NOT NULL,
  `pop_under_one` int(11) NOT NULL,
  `fridge` varchar(32) NOT NULL,
  `cold_box` int(11) DEFAULT NULL,
  `vaccine_carrier` int(11) DEFAULT NULL,
  `status` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_facility`
--

INSERT INTO `m_facility` (`id`, `facility_name`, `type`, `owner`, `dhis_id`, `mfl_code`, `officer_incharge`, `email`, `phone`, `region_id`, `county_id`, `subcounty_id`, `constituency`, `ward`, `nearest_town`, `nearest_town_distance`, `nearest_depot_distance`, `wcba_pop`, `pop`, `pop_under_one`, `fridge`, `cold_box`, `vaccine_carrier`, `status`) VALUES
(18, 'Example', '0', 'Private', 0, 0, '', '', 0, 1, 2, 1, 'eg', 'eg', '', 0, 0, 0, 0, 0, 'Yes', NULL, NULL, 'Operational'),
(19, 'Test', '0', 'Private', 0, 0, '', '', 0, 1, 1, 1, 'Test', 'Test', '', 0, 0, 0, 0, 0, 'Yes', NULL, NULL, 'Operational'),
(20, 'ttt', '0', 'Private', 0, 0, '', '', 0, 1, 1, 1, 'kaskfc', 'kdjfj', '', 0, 0, 0, 0, 0, 'Yes', 0, 0, 'Operational');

-- --------------------------------------------------------

--
-- Table structure for table `m_fridges`
--

CREATE TABLE IF NOT EXISTS `m_fridges` (
`id` int(11) NOT NULL,
  `Model` varchar(10) NOT NULL,
  `Manufacturer` varchar(10) NOT NULL,
  `Technology Type` varchar(10) NOT NULL,
  `Vaccine storage volume (L)` varchar(10) NOT NULL,
  `Holdover period (hrs)` varchar(10) NOT NULL,
  `Freezer capacity` varchar(10) NOT NULL,
  `Purchase price/ unit (USD)` varchar(10) NOT NULL,
  `Freight charges - to port (USD)` varchar(10) NOT NULL,
  `Local levies and in-country transport (USD)` varchar(10) NOT NULL,
  `Installation charges (USD)` varchar(10) NOT NULL,
  `Training costs (USD)` varchar(10) NOT NULL,
  `Total installed cost/ Capex (USD)` varchar(10) NOT NULL,
  `Annual energy costs (USD)` varchar(10) NOT NULL,
  `Annual maintenance costs (USD)` varchar(10) NOT NULL,
  `Total operational cost (USD)` varchar(10) NOT NULL,
  `TCO (USD)` varchar(10) NOT NULL,
  `TCO/ Ltr (USD)` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_fridges`
--

INSERT INTO `m_fridges` (`id`, `Model`, `Manufacturer`, `Technology Type`, `Vaccine storage volume (L)`, `Holdover period (hrs)`, `Freezer capacity`, `Purchase price/ unit (USD)`, `Freight charges - to port (USD)`, `Local levies and in-country transport (USD)`, `Installation charges (USD)`, `Training costs (USD)`, `Total installed cost/ Capex (USD)`, `Annual energy costs (USD)`, `Annual maintenance costs (USD)`, `Total operational cost (USD)`, `TCO (USD)`, `TCO/ Ltr (USD)`) VALUES
(2, 'HBC 70', 'Haier ', 'ILR', '45', '27.30', 'No', '$488.00', '$86.30', '$86.15', '$219.00', '$113.00', '$992.45', '$36.50', '$81.25', '$1,004.43', '$1,996.88', '$44.38'),
(3, 'HBC 200', 'Haier ', 'ILR', '90', '31.38', 'No', '$648.00', '$86.30', '$110.15', '$219.00', '$113.00', '$1,176.45', '$60.99', '$81.65', '$1,216.71', '$2,393.16', '$26.59'),
(4, 'HBD 286', 'Haier ', 'ILR', '258', '4.15', 'Yes', '$498.00', '$86.30', '$87.65', '$219.00', '$113.00', '$1,003.95', '$57.34', '$80.34', '$1,174.40', '$2,178.35', '$8.44'),
(5, 'HBC-340', 'Haier ', 'ILR ', '211', '45.63', 'No ', '$1,250.00', '$86.30', '$200.45', '$219.00', '$113.00', '$1,868.75', '$32.39', '$89.55', '$1,040.20', '$2,908.95', '$13.79'),
(6, 'MK 304', 'Vestfrost ', 'ILR', '105', '26.10', 'No', '$855.06', '$49.00', '$135.61', '$219.00', '$113.00', '$1,371.66', '$77.56', '$82.17', '$1,362.55', '$2,734.21', '$26.04'),
(7, 'ZLF 150 AC', 'Zero ', 'ILR', '128', '128.20', 'No', '$2,884.00', '$272.27', '$473.44', '$219.00', '$113.00', '$3,961.71', '$30.87', '$114.80', '$1,242.62', '$5,204.33', '$40.66'),
(8, 'MK074', 'Vestfrost ', 'ILR', '16', '52.90', 'Yes', '$778.65', '$27.00', '$120.85', '$219.00', '$113.00', '$1,258.50', '$48.36', '$80.90', '$1,102.61', '$2,361.11', '$147.57'),
(9, 'MK204', 'Vestfrost ', 'ILR', '75', '20.10', 'No', '$730.34', '$35.00', '$114.80', '$219.00', '$113.00', '$1,212.14', '$54.45', '$81.27', '$1,157.65', '$2,369.79', '$31.60'),
(10, 'MK 404', 'Vestfrost ', 'ILR', '135', '23.23', 'No', '$973.03', '$59.00', '$154.81', '$219.00', '$113.00', '$1,518.84', '$96.88', '$82.17', '$1,527.31', '$3,046.14', '$22.56'),
(11, 'BLF 100 AC', 'Surechill', 'ILR', '99', '249.90', 'No', '$2,655.00', '$186.92', '$426.29', '$219.00', '$113.00', '$3,600.21', '$120.15', '$115.80', '$2,012.67', '$5,612.88', '$56.70'),
(12, 'TCW 2000 A', 'Dometic ', 'ILR', '60', '39.40', 'Yes', '$2,394.38', '$58.41', '$367.92', '$219.00', '$113.00', '$3,152.71', '$66.00', '$98.37', '$1,402.17', '$4,554.88', '$75.91'),
(13, 'TCW 3000 A', 'Dometic ', 'ILR', '150', '53.17', 'Yes', '$2,495.51', '$58.41', '$383.09', '$219.00', '$113.00', '$3,269.00', '$20.08', '$104.61', '$1,063.62', '$4,332.62', '$28.88'),
(14, 'VLS400', 'Vestfrost ', 'ILR', '145', '30.00', 'No', '$855.06', '$59.00', '$137.11', '$219.00', '$113.00', '$1,383.16', '$12.93', '$82.61', '$814.94', '$2,198.11', '$15.16'),
(15, 'MK 144', 'Vestfrost ', 'ILR', '48', '43.13', 'No', '$620.22', '$27.00', '$97.08', '$219.00', '$113.00', '$1,076.31', '$34.52', '$81.09', '$986.22', '$2,062.53', '$42.97'),
(16, 'VLS200', 'Vestfrost ', 'ILR', '60', '24.40', 'Yes', '$611.24', '$27.00', '$95.74', '$219.00', '$113.00', '$1,065.97', '$12.17', '$81.09', '$795.52', '$1,861.49', '$31.02'),
(17, 'VLS300', 'Vestfrost ', 'ILR', '98', '23.50', 'No', '$723.60', '$35.00', '$113.79', '$219.00', '$113.00', '$1,204.38', '$10.49', '$81.09', '$781.25', '$1,985.63', '$20.26'),
(18, 'VLS350', 'Vestfrost ', 'ILR', '127', '31.50', 'No', '$807.87', '$42.00', '$127.48', '$219.00', '$113.00', '$1,309.34', '$9.73', '$82.61', '$787.70', '$2,097.04', '$16.51'),
(19, 'HBC-110', 'Haier ', 'ILR', '52.5', '36.28', 'No', '$570.00', '$86.30', '$98.45', '$219.00', '$113.00', '$1,086.75', '$19.47', '$88.58', '$921.69', '$2,008.44', '$38.26'),
(20, 'ZLF 100 AC', 'Zero ', 'ILR', '93', '113.70', 'No', '$2,392.00', '$272.27', '$399.64', '$219.00', '$113.00', '$3,395.91', '$62.20', '$114.80', '$1,509.86', '$4,905.77', '$52.75'),
(21, 'GVR 50 AC', 'Godrej', 'ILR', '46.5', '182.00', 'No', '$1,425.00', '$90.00', '$227.25', '$291.00', '$113.00', '$2,146.25', '$9.73', '$87.65', '$830.70', '$2,976.95', '$64.02'),
(22, 'GVR 100 AC', 'Godrej', 'ILR', '99', '300.30', 'No', '$2,150.00', '$90.00', '$336.00', '$291.00', '$113.00', '$2,980.00', '$28.90', '$87.76', '$995.10', '$3,975.10', '$40.15'),
(23, 'MKS 044', 'Vestfrost ', 'SDD', '19.5', '147.00', 'No', '$2,767.42', '$21.00', '$418.26', '$291.00', '$113.00', '$3,610.68', '$0.00', '$91.04', '$776.56', '$4,387.23', '$224.99'),
(24, 'BLF 100 DC', 'Surechill', 'SDD', '93', '170.10', 'No', '$5,155.00', '$243.00', '$809.70', '$291.00', '$113.00', '$6,611.70', '$0.00', '$123.65', '$1,054.76', '$7,666.46', '$82.44'),
(25, 'BFRV55', 'SunDanzer ', 'SDD', '54.5', '83.48', 'No', '$3,725.00', '$300.00', '$603.75', '$291.00', '$113.00', '$5,032.75', '$0.00', '$95.00', '$810.37', '$5,843.12', '$107.21'),
(26, 'HTC60', 'Haier ', 'SDD', '21', '135.50', 'No', '$3,260.00', '$86.30', '$501.95', '$291.00', '$113.00', '$4,252.25', '$0.00', '$100.40', '$856.43', '$5,108.68', '$243.27'),
(27, 'TCW 3000 S', 'Dometic ', 'SDD', '156', '86.93', 'No', '$5,402.25', '$98.31', '$825.08', '$291.00', '$113.00', '$6,729.65', '$0.00', '$121.48', '$1,036.22', '$7,765.86', '$49.78'),
(28, 'TCW 2000 S', 'Dometic ', 'SDD', '99', '85.40', 'Yes', '$8,062.92', '$131.09', '$1,229.10', '$291.00', '$113.00', '$9,827.11', '$0.00', '$122.43', '$1,044.32', '$10,871.43', '$109.81'),
(29, 'BFRV15 SDD', 'SunDanzer ', 'SDD', '15', '101.32', 'No ', '$2,450.00', '$300.00', '$412.50', '$291.00', '$113.00', '$3,566.50', '$0.00', '$88.20', '$752.36', '$4,318.86', '$287.92'),
(30, 'VC200SDD', 'Dulas Sola', 'SDD', '132', '79.48', 'No ', '$4,269.66', '$300.00', '$685.45', '$291.00', '$113.00', '$5,659.11', '$0.00', '$119.11', '$1,016.05', '$6,675.16', '$50.57'),
(31, 'TCW 40 SDD', 'Dometic ', 'SDD', '36', '81.90', 'Yes ', '$4,962.92', '$98.31', '$759.19', '$291.00', '$113.00', '$6,224.42', '$0.00', '$113.72', '$970.09', '$7,194.51', '$199.85'),
(32, 'TCW2043SDD', 'Dometic', 'SDD', '70', '73.90', 'Yes', '$8,313.48', '$98.31', '$1,261.77', '$291.00', '$113.00', '$10,077.57', '$0.00', '$105.48', '$899.74', '$10,977.31', '$156.82'),
(33, 'TCW 3043 S', 'Dometic', 'SDD', '89', '116.68', 'No', '$5,741.57', '$98.31', '$875.98', '$291.00', '$113.00', '$7,119.87', '$0.00', '$120.18', '$1,025.18', '$8,145.05', '$91.52'),
(34, 'VLS 054 ', 'Vestfrost', 'SDD', '55.5', '72.40', 'No', '$3,142.70', '$21.00', '$474.55', '$291.00', '$113.00', '$4,042.25', '$0.00', '$101.16', '$862.89', '$4,905.14', '$88.38'),
(35, 'ZLF 100 DC', 'Zero ', 'SDD', '93', '170.10', 'No', '$4,959.00', '$300.00', '$788.85', '$291.00', '$113.00', '$6,451.85', '$0.00', '$129.50', '$1,104.66', '$7,556.51', '$81.25'),
(36, 'VC 150 SDD', 'Dulas Sola', 'SDD', '102', '77.99', 'Yes', '$7,640.45', '$300.00', '$1,191.07', '$291.00', '$113.00', '$9,535.52', '$0.00', '$142.44', '$1,215.07', '$10,750.58', '$105.40'),
(37, 'TCW 2000 D', 'Dometic ', 'SB', '76', '13.58', 'Yes', '$5,459.55', '$73.74', '$829.99', '$291.00', '$113.00', '$6,767.28', '$0.00', '$186.39', '$1,589.94', '$8,357.22', '$109.96'),
(38, 'TCW 3000 D', 'Dometic ', 'SB', '109.5', '23.40', 'Yes', '$6,921.35', '$73.74', '$1,049.26', '$291.00', '$113.00', '$8,448.35', '$0.00', '$205.61', '$1,753.92', '$10,202.27', '$93.17'),
(39, 'VC 65-2', 'Dulas ', 'SB', '37.5', '3.13', 'Yes', '$3,679.78', '$116.03', '$569.37', '$291.00', '$113.00', '$4,769.18', '$0.00', '$168.34', '$1,435.95', '$6,205.13', '$165.47'),
(40, 'VC 150-2', 'Dulas ', 'SB', '86', '3.37', 'Yes', '$4,803.37', '$120.33', '$738.55', '$291.00', '$113.00', '$6,066.25', '$0.00', '$168.34', '$1,435.95', '$7,502.20', '$87.23'),
(41, 'VC 200-1', 'Dulas ', 'SB', '126.5', '3.05', 'No', '$3,426.97', '$120.33', '$532.09', '$291.00', '$113.00', '$4,483.39', '$0.00', '$168.34', '$1,435.95', '$5,919.34', '$46.79'),
(42, 'HBD 116', 'Haier', 'Freezer', '97', '2.48', 'Yes', '$398.00', '$86.30', '$72.65', '$291.00', '$113.00', '$960.95', '$0.00', '$147.60', '$1,259.06', '$2,220.01', '$22.89'),
(43, 'TFW 800', 'Dometic', 'Freezer', '187', 'N/A', 'Yes', '$2,462.92', '$58.41', '$378.20', '$291.00', '$113.00', '$3,303.53', '$60.53', '$181.31', '$2,062.95', '$5,366.47', '$28.70'),
(44, 'MF 314', 'Vestfrost', 'Freezer', '271', '4.00', 'Yes', '$619.10', '$59.39', '$101.77', '$291.00', '$113.00', '$1,184.26', '$65.24', '$151.57', '$1,849.47', '$3,033.73', '$11.19'),
(45, 'MF 114', 'Vestfrost', 'Freezer', '95', '2.80', 'Yes', '$453.93', '$59.39', '$77.00', '$291.00', '$113.00', '$994.32', '$36.65', '$151.17', '$1,602.16', '$2,596.48', '$27.33'),
(46, 'MF 214', 'Vestfrost', 'Freezer', '138', '2.90', 'Yes', '$529.21', '$59.39', '$88.29', '$291.00', '$113.00', '$1,080.89', '$45.02', '$151.17', '$1,673.51', '$2,754.40', '$19.96'),
(47, 'RCW 42 EG', 'Dometic', '', '10.5', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(48, 'RCW 50 EG', 'Dometic', '', '24', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(49, 'TCW 1152', 'Dometic', '', '169', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(50, 'V170 GE', 'Sibir', '', '55', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(51, 'V110 GE', 'Sibir', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(52, 'GR265', 'Zero ', '', '57', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(53, 'Other/Non-', 'Other/Non-', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(54, 'NONE', 'NONE', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(55, 'Walk-in Co', 'WICR', '', '40000', '', '', '$30,000.00', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_group`
--

CREATE TABLE IF NOT EXISTS `m_group` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_group`
--

INSERT INTO `m_group` (`id`, `name`, `role`) VALUES
(1, 'admin', 'administrator'),
(2, 'member', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `m_inventory`
--

CREATE TABLE IF NOT EXISTS `m_inventory` (
`id` int(11) NOT NULL,
  `Vaccine_name` varchar(30) NOT NULL,
  `max_stock` int(11) NOT NULL,
  `min_stock` int(11) NOT NULL,
  `period_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_physical_count`
--

CREATE TABLE IF NOT EXISTS `m_physical_count` (
`id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `batch_number` varchar(20) NOT NULL,
  `date_of_count` date NOT NULL,
  `available_quantity` int(11) NOT NULL,
  `physical_count` int(11) NOT NULL,
  `discrepancy` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_physical_count`
--

INSERT INTO `m_physical_count` (`id`, `vaccine_id`, `batch_number`, `date_of_count`, `available_quantity`, `physical_count`, `discrepancy`) VALUES
(9, 11, 'TEST2', '2015-10-05', 500, 100, 400),
(10, 11, 'TEST2', '2015-10-19', 500, 1000, -500),
(11, 11, 'TEST2', '2015-10-01', 500, 400, 100),
(12, 11, 'TEST2', '2015-10-19', 500, 453, 47),
(14, 11, 'TEST2', '2015-10-21', 500, 10, 490),
(17, 11, 'TEST2', '2015-10-21', 10, 500, -490);

--
-- Triggers `m_physical_count`
--
DELIMITER //
CREATE TRIGGER `new_physical_count` AFTER INSERT ON `m_physical_count`
 FOR EACH ROW begin
UPDATE m_stock_movement
SET physical_count= new.physical_count
WHERE vaccine_id = new.vaccine_id AND batch_number=new.batch_number;

UPDATE m_stock_balance
SET stock_balance = new.physical_count 
WHERE vaccine_id = new.vaccine_id AND batch_number=new.batch_number;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `m_refrigerator`
--

CREATE TABLE IF NOT EXISTS `m_refrigerator` (
`id` int(11) NOT NULL,
  `make_model` varchar(32) NOT NULL,
  `temp_monitor_no` int(11) NOT NULL,
  `main_power_source` varchar(32) NOT NULL,
  `backup_power_source` varchar(32) NOT NULL,
  `refrigerator_age` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_refrigerator`
--

INSERT INTO `m_refrigerator` (`id`, `make_model`, `temp_monitor_no`, `main_power_source`, `backup_power_source`, `refrigerator_age`) VALUES
(1, 'Phillips Mega C245', 10, 'Solar', 'Kerosene', 0),
(2, 'Grandins 5NM', 85, 'Electricity', 'Electricity', 10);

-- --------------------------------------------------------

--
-- Table structure for table `m_region`
--

CREATE TABLE IF NOT EXISTS `m_region` (
`id` int(11) NOT NULL,
  `region_name` varchar(255) NOT NULL,
  `region_headquater` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_stock_balance`
--

CREATE TABLE IF NOT EXISTS `m_stock_balance` (
`id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `batch_number` varchar(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `stock_balance` int(11) NOT NULL,
  `vvm_status` varchar(10) NOT NULL,
  `last_update` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_stock_balance`
--

INSERT INTO `m_stock_balance` (`id`, `vaccine_id`, `batch_number`, `expiry_date`, `stock_balance`, `vvm_status`, `last_update`) VALUES
(1, 11, 'TEST2', '2017-02-01', 500, '2', '0000-00-00'),
(2, 11, 'TEST1', '2016-06-30', 2000, '1', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `m_stock_movement`
--

CREATE TABLE IF NOT EXISTS `m_stock_movement` (
`stock_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `batch_number` varchar(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `quantity_in` int(11) NOT NULL,
  `quantity_out` int(11) NOT NULL,
  `physical_count` int(11) NOT NULL,
  `VVM_status` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `operator` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_stock_movement`
--

INSERT INTO `m_stock_movement` (`stock_id`, `vaccine_id`, `batch_number`, `expiry_date`, `transaction_date`, `transaction_type`, `source`, `destination`, `quantity_in`, `quantity_out`, `physical_count`, `VVM_status`, `order_number`, `operator`) VALUES
(1, 11, 'TEST2', '2017-02-01', '0000-00-00', 1, 0, 0, 500, 0, 500, 2, 0, ''),
(2, 11, 'TEST1', '2016-06-30', '0000-00-00', 1, 0, 0, 2000, 0, 2500, 1, 0, '');

--
-- Triggers `m_stock_movement`
--
DELIMITER //
CREATE TRIGGER `new_stock_balance` AFTER INSERT ON `m_stock_movement`
 FOR EACH ROW begin
 IF (new.transaction_type = 1) THEN 
INSERT INTO m_stock_balance (vaccine_id, batch_number, expiry_date, stock_balance,last_update,vvm_status)
Values (new.vaccine_id,new.batch_number,new.expiry_date,new.quantity_in,new.transaction_date,new.vvm_status);


ELSE if(new.transaction_type =2 )THEN
UPDATE m_stock_balance
SET stock_balance= (stock_balance - new.quantity_out)
WHERE batch_number= new.batch_number AND expiry_date=new.expiry_date;

END IF;
END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `m_subcounty`
--

CREATE TABLE IF NOT EXISTS `m_subcounty` (
`id` int(11) NOT NULL,
  `subcounty_name` varchar(255) NOT NULL,
  `county_id` int(14) NOT NULL,
  `population` int(48) NOT NULL,
  `population_one` int(48) NOT NULL,
  `population_women` int(48) NOT NULL,
  `no_facilities` int(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_transaction_type`
--

CREATE TABLE IF NOT EXISTS `m_transaction_type` (
`id` int(11) NOT NULL,
  `transaction_type` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_transaction_type`
--

INSERT INTO `m_transaction_type` (`id`, `transaction_type`) VALUES
(1, 'receive'),
(2, 'Issue'),
(3, 'transfer');

-- --------------------------------------------------------

--
-- Table structure for table `m_users`
--

CREATE TABLE IF NOT EXISTS `m_users` (
`id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `user_group` int(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_users`
--

INSERT INTO `m_users` (`id`, `f_name`, `l_name`, `username`, `phone`, `email`, `password`, `title`, `user_group`) VALUES
(1, 'Admin', 'Dvikenya', 'advikenya', '0703568592', 'admin@dvikenya.com', '0a692f089b30b507bc881486d21a15f4ce7534ba02cf4d9bcc0062375fdcde1a364a9370593c274e0f0632fc7ae7448bdee5d267b64685f07bd7192128f6ff38', 'administrator', 1),
(2, 'julie', 'test', 'jtest', '0707123456', 'jtest@admin.com', '0a692f089b30b507bc881486d21a15f4ce7534ba02cf4d9bcc0062375fdcde1a364a9370593c274e0f0632fc7ae7448bdee5d267b64685f07bd7192128f6ff38', 'test', 2);

-- --------------------------------------------------------

--
-- Table structure for table `m_vaccines`
--

CREATE TABLE IF NOT EXISTS `m_vaccines` (
`ID` int(11) NOT NULL,
  `Vaccine_name` varchar(45) DEFAULT NULL,
  `Doses_required` int(15) NOT NULL,
  `Wastage_factor` decimal(14,2) NOT NULL,
  `Tray_color` varchar(30) NOT NULL,
  `Vaccine_designation` varchar(30) NOT NULL,
  `Vaccine_formulation` varchar(30) NOT NULL,
  `Mode_administration` varchar(30) NOT NULL,
  `Vaccine_presentation` varchar(30) NOT NULL,
  `Fridge_compart` varchar(30) NOT NULL,
  `Vaccine_pck_vol` decimal(14,1) NOT NULL,
  `Diluents_pck_vol` decimal(14,1) NOT NULL,
  `Vaccine_price_vial` decimal(14,2) NOT NULL,
  `Vaccine_price_dose` decimal(14,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_vaccines`
--

INSERT INTO `m_vaccines` (`ID`, `Vaccine_name`, `Doses_required`, `Wastage_factor`, `Tray_color`, `Vaccine_designation`, `Vaccine_formulation`, `Mode_administration`, `Vaccine_presentation`, `Fridge_compart`, `Vaccine_pck_vol`, `Diluents_pck_vol`, `Vaccine_price_vial`, `Vaccine_price_dose`) VALUES
(11, 'ROTA', 28, '3.20', 'white', 'County', 'Liquid', 'Injection', '2.7', 'Fridge(4 deg)', '56.2', '23.8', '28763.00', '30050.00'),
(12, 'BCG', 45, '1.70', 'grey', 'Sub-county', 'Tablet', 'Oral', '9.8', 'Fridge(4 deg)', '56.2', '23.4', '2000.45', '30050.00'),
(13, 'TT', 21, '3.40', 'green', 'CVS', 'Semi-liquid', 'Oral/Injection', '9.8', '', '56.2', '23.4', '2000.45', '30050.00');

-- --------------------------------------------------------

--
-- Table structure for table `m_vvm_status`
--

CREATE TABLE IF NOT EXISTS `m_vvm_status` (
`id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_vvm_status`
--

INSERT INTO `m_vvm_status` (`id`, `name`) VALUES
(1, 'Stage 1'),
(2, 'Stage 2'),
(3, 'Stage 3'),
(4, 'Stage 4');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`order_id` int(11) NOT NULL,
  `order_by` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `order_by`, `date_created`, `status`) VALUES
(1, '', '2015-10-23', 0),
(2, '', '2015-10-23', 0),
(3, '', '2015-10-23', 0),
(4, '', '2015-10-23', 0),
(5, '', '2015-10-23', 0),
(6, '', '2015-10-23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `vaccine_id` int(14) NOT NULL,
  `stock_on_hand` int(14) NOT NULL,
  `min_stock` int(14) NOT NULL,
  `max_stock` int(11) NOT NULL,
  `period_stock` int(14) NOT NULL,
  `first_expiry` date NOT NULL,
  `qty_order_doses` int(14) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`vaccine_id`, `stock_on_hand`, `min_stock`, `max_stock`, `period_stock`, `first_expiry`, `qty_order_doses`, `order_id`) VALUES
(0, 2500, 2, 9, 0, '2016-06-30', -2491, 1),
(0, 0, 0, 0, 0, '0000-00-00', 300, 2),
(0, 2500, 2, 9, 0, '2016-06-30', -2491, 4),
(0, 0, 0, 0, 0, '0000-00-00', 300, 3),
(0, 0, 0, 0, 0, '0000-00-00', 300, 6),
(0, 2500, 2, 9, 0, '2016-06-30', -2491, 5);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
`id` int(11) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `raw_name` varchar(200) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `full_path` varchar(1000) NOT NULL,
  `upload_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `file_name`, `raw_name`, `file_type`, `full_path`, `upload_date`) VALUES
(1, 'Sample PDF', 'sample.pdf', 'application/pdf', '/home/arcturus/public_html/dvi_kenya/docs/sample.pdf', '2015-07-20'),
(2, 'ggfhdg', 'LPO_1_598_IMMANUEL_TOURS_EVENT_PLANNERS.pdf', 'application/pdf', '/home/arcturus/public_html/dvi_kenya/docs/LPO_1_598_IMMANUEL_TOURS_EVENT_PLANNERS.pdf', '2015-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@dvikenya.com', '', NULL, NULL, 'yIrcnf6trgE83qEcKcF0Pe', 1268889823, 1439394189, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', 'julie', '$2y$08$oVjDaJYEgBHOaavsKjEkG.I84X1w2LrelcyQz4V5asld21PCJ5Trq', NULL, 'julie@dvikenya.com', NULL, NULL, NULL, NULL, 1436919100, 1437294534, 1, 'julie', 'tester', 'tester', '282838'),
(3, '::1', 'Emanager', '$2y$08$kaOVIpMPtkvlUqPLfFBBBeT.7j0T8dALLW7SIxaaCbfl48TgrWvYu', NULL, 'exec@dvikenya.com', NULL, NULL, NULL, 'tVb1/cLyQA6rmNUfnX3sRu', 1437311567, 1437379154, 1, 'Exec', 'Manager', 'CITR', '0705605464');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 2, 4),
(5, 3, 7);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vacc_stock`
--
CREATE TABLE IF NOT EXISTS `vacc_stock` (
`stock_id` int(11)
,`vaccine_id` int(11)
);
-- --------------------------------------------------------

--
-- Structure for view `vacc_stock`
--
DROP TABLE IF EXISTS `vacc_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vacc_stock` AS select `m_stock_movement`.`stock_id` AS `stock_id`,`m_stock_movement`.`vaccine_id` AS `vaccine_id` from `m_stock_movement`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`id`), ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_county`
--
ALTER TABLE `m_county`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_depot`
--
ALTER TABLE `m_depot`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_facility`
--
ALTER TABLE `m_facility`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_fridges`
--
ALTER TABLE `m_fridges`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_group`
--
ALTER TABLE `m_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_inventory`
--
ALTER TABLE `m_inventory`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_physical_count`
--
ALTER TABLE `m_physical_count`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_refrigerator`
--
ALTER TABLE `m_refrigerator`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_region`
--
ALTER TABLE `m_region`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_stock_balance`
--
ALTER TABLE `m_stock_balance`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_stock_movement`
--
ALTER TABLE `m_stock_movement`
 ADD PRIMARY KEY (`stock_id`), ADD KEY `trans_fk` (`transaction_type`), ADD KEY `vaccine_fk` (`vaccine_id`), ADD KEY `vvm_fk` (`VVM_status`);

--
-- Indexes for table `m_subcounty`
--
ALTER TABLE `m_subcounty`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_transaction_type`
--
ALTER TABLE `m_transaction_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_users`
--
ALTER TABLE `m_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_vaccines`
--
ALTER TABLE `m_vaccines`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `ID_UNIQUE` (`ID`);

--
-- Indexes for table `m_vvm_status`
--
ALTER TABLE `m_vvm_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_county`
--
ALTER TABLE `m_county`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `m_depot`
--
ALTER TABLE `m_depot`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `m_facility`
--
ALTER TABLE `m_facility`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `m_fridges`
--
ALTER TABLE `m_fridges`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `m_group`
--
ALTER TABLE `m_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_inventory`
--
ALTER TABLE `m_inventory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_physical_count`
--
ALTER TABLE `m_physical_count`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `m_refrigerator`
--
ALTER TABLE `m_refrigerator`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_region`
--
ALTER TABLE `m_region`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_stock_balance`
--
ALTER TABLE `m_stock_balance`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_stock_movement`
--
ALTER TABLE `m_stock_movement`
MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_subcounty`
--
ALTER TABLE `m_subcounty`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_transaction_type`
--
ALTER TABLE `m_transaction_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `m_users`
--
ALTER TABLE `m_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_vaccines`
--
ALTER TABLE `m_vaccines`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `m_vvm_status`
--
ALTER TABLE `m_vvm_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

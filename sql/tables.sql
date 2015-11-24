-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2015 at 02:03 AM
-- Server version: 5.6.25
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dvd`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `calc_orders`(
IN $station_id VARCHAR(255),
IN $station_level VARCHAR(255)
)
begin
if($station_level=3)THEN
SELECT ID, Vaccine_name,first_expiry_date,Doses_required,Wastage_factor,
stock_on_hand,county_name,population_one,
period_stock,calc_max_stock(period_stock)as maxstock,
calc_min_stock(period_stock)as minstock
 FROM calc_county_orders
 WHERE county_name=$station_id
 ;
 
else if($station_level=4)THEN
SELECT ID, Vaccine_name,first_expiry_date,Doses_required,Wastage_factor,
stock_on_hand,subcounty_name,population_one,
period_stock,calc_max_stock(period_stock)as maxstock,
calc_min_stock(period_stock)as minstock
 FROM calc_subcounty_orders
 WHERE subcounty_name=$station_id
 ;
else if($station_level=5)THEN
SELECT ID, Vaccine_name,first_expiry_date,Doses_required,Wastage_factor,
stock_on_hand,facility_name,population_one,
period_stock,calc_max_stock(period_stock)as maxstock,
calc_min_stock(period_stock)as minstock
 FROM calc_facility_order
 WHERE facility_name=$station_id
 ;
 
END IF;
END IF;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllVaccines`()
BEGIN
SELECT Vaccine_name,ID FROM m_vaccines;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetStoreBalance`(IN `$selected_vaccine` VARCHAR(255), IN `$user_id` VARCHAR(10))
BEGIN
SELECT mv.Vaccine_name,SUM(sb.stock_balance) AS balance
FROM m_stock_movement ms 
INNER JOIN m_stock_balance sb ON sb.batch_number=ms.batch_number 

LEFT JOIN m_vvm_status mvvm ON mvvm.id=ms.VVM_status 
LEFT JOIN m_vaccines mv ON mv.ID=ms.vaccine_id 
WHERE ms.vaccine_id= $selected_vaccine AND ms.user_id= $user_id
ORDER BY ms.batch_number,ms.transaction_type;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetVaccinesLedger`(IN `$selected_vaccine` VARCHAR(255))
BEGIN
SELECT mv.Vaccine_name, ms.transaction_date, ms.quantity_in,ms.quantity_out,sb.stock_balance, ms.batch_number,ms.expiry_date,mvvm.name 
FROM m_stock_movement ms 
INNER JOIN m_stock_balance sb ON sb.batch_number=ms.batch_number 

LEFT JOIN m_vvm_status mvvm ON mvvm.id=ms.VVM_status 
LEFT JOIN m_vaccines mv ON mv.ID=ms.vaccine_id 
WHERE ms.vaccine_id= $selected_vaccine
ORDER BY ms.batch_number,ms.transaction_type;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_orders`(
IN $station VARCHAR(255)
)
begin
if ($station= '1') then
SELECT l.date_created  FROM m_order l;

ELSE if($station= '2' )THEN
SELECT l.date_created,mr.region_name as station_name FROM m_order l
LEFT JOIN m_region mr on mr.id=l.station_id;

ELSE if($station= '3' )THEN
SELECT l.date_created,mc.county_name as station_name FROM m_order l
LEFT JOIN m_county mc on mc.id=l.station_id;

ELSE if($station= '4' )THEN
SELECT l.date_created, ms.subcounty_name as station_name FROM m_order l
LEFT JOIN  m_subcounty ms ON ms.id = l.station_id;

ELSE if($station= '5' )THEN
SELECT l.date_created, mf.facility_name as station_name FROM m_order l
LEFT JOIN facility_userbase_view mf ON mf.facility = l.station_id;

END IF;
END IF;
END IF;
END IF;
END IF;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_placed_orders`(
IN $station VARCHAR(255),
IN $station_id VARCHAR(255)
)
begin
if ($station= '1') then
SELECT DISTINCT(date_created),station_id,order_by FROM m_order m ;

ELSE if($station= '2' )THEN
SELECT DISTINCT(date_created),station_id,order_by FROM view_county_orders fv WHERE fv.region= $station_id ;

ELSE if($station= '3' )THEN
SELECT DISTINCT(date_created),station_id,order_by FROM view_subcounty_orders fv WHERE fv.county_name= $station_id ;

ELSE if($station= '4' )THEN
SELECT DISTINCT(date_created),station_id,order_by FROM view_facility_orders fv WHERE fv.subcounty_name= $station_id ;

ELSE if($station= '5' )THEN
SELECT DISTINCT(date_created),station_id,order_by FROM view_facility_orders fv WHERE fv.facility_name= $station_id ;

END IF;
END IF;
END IF;
END IF;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_prepare_order_values`(
IN $station VARCHAR(255),
IN $selected_vaccine VARCHAR(255),
IN $station_id VARCHAR(255)
)
begin
 if($station= '3' )THEN
SELECT sum(msb.`stock_balance`) AS stock_balance,
       min(msb.`expiry_date`) as first_expiry_date, mv.Doses_required, mv.Wastage_factor,mc.county_name, mc.id,mc.population_one
       FROM `m_stock_balance` msb
       LEFT JOIN m_vaccines mv ON mv.ID= msb.`vaccine_id`
       LEFT JOIN m_county mc ON mc.county_name=msb.station_id
       WHERE msb.vaccine_id=$selected_vaccine AND msb.station_level=$station AND msb.station_id= $station_id;

ELSE if($station= '4' )THEN
SELECT sum(msb.`stock_balance`) AS stock_balance,
       min(msb.`expiry_date`) as first_expiry_date, mv.Doses_required, mv.Wastage_factor,mc.subcounty_name, mc.id,mc.population_one
       FROM `m_stock_balance` msb
       LEFT JOIN m_vaccines mv ON mv.ID= msb.`vaccine_id`
       LEFT JOIN m_subcounty mc ON mc.subcounty_name=msb.station_id
       WHERE msb.vaccine_id=$selected_vaccine AND msb.station_level=$station AND msb.station_id= $station_id;
      

ELSE if($station= '5' )THEN
SELECT sum(msb.`stock_balance`) AS stock_balance,
       min(msb.`expiry_date`) as first_expiry_date, mv.Doses_required, mv.Wastage_factor,mc.facility_name, mc.id 
       FROM `m_stock_balance` msb
       LEFT JOIN m_vaccines mv ON mv.ID= msb.`vaccine_id`
       LEFT JOIN m_facility mc ON mc.facility_name=msb.station_id
       WHERE msb.vaccine_id=$selected_vaccine AND msb.station_level=$station AND msb.station_id= $station_id;


END IF;
END IF;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_submitted_orders`(
IN $station VARCHAR(255),
IN $station_id VARCHAR(255)
)
begin
if ($station= '1') then
SELECT DISTINCT(date_created),station_id,order_by FROM m_order m ;

ELSE if($station= '2' )THEN
SELECT DISTINCT(date_created),station_id,order_by FROM view_region_orders fv WHERE fv.region_name= $station_id ;

ELSE if($station= '3' )THEN
SELECT DISTINCT(date_created),station_id,order_by FROM view_county_orders fv WHERE fv.county_name= $station_id ;

ELSE if($station= '4' )THEN
SELECT DISTINCT(date_created),station_id,order_by FROM view_subcounty_orders fv WHERE fv.subcounty_name= $station_id ;

ELSE if($station= '5' )THEN
SELECT DISTINCT(date_created),station_id,order_by FROM view_facility_orders fv WHERE fv.facility_name= $station_id ;

END IF;
END IF;
END IF;
END IF;
END IF;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `test_orders`(
IN $station_id VARCHAR(255),
IN $station_level VARCHAR(255)
)
begin
if($station_level=3)THEN
SELECT ID, Vaccine_name,first_expiry_date,Doses_required,Wastage_factor,
stock_on_hand,county_name,population_one,
period_stock,calc_max_stock(period_stock)as maxstock,
calc_min_stock(period_stock)as minstock
 FROM calc_county_orders
 WHERE county_name=$station_id
 ;
 
else if($station_level=4)THEN
SELECT ID, Vaccine_name,first_expiry_date,Doses_required,Wastage_factor,
stock_on_hand,county_name,population_one,
period_stock,calc_max_stock(period_stock)as maxstock,
calc_min_stock(period_stock)as minstock
 FROM calc_subcounty_orders
 WHERE subcounty_name=$station_id
 ;
else if($station_level=5)THEN
SELECT ID, Vaccine_name,first_expiry_date,Doses_required,Wastage_factor,
stock_on_hand,county_name,population_one,
period_stock,calc_max_stock(period_stock)as maxstock,
calc_min_stock(period_stock)as minstock
 FROM calc_facility_order
 WHERE facility_name=$station_id
 ;
 
END IF;
END IF;
END IF;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `calc_max_stock`(period_stock FLOAT) RETURNS decimal(9,2)
BEGIN
  DECLARE max_stock DECIMAL(9,2);
  SET max_stock= 1.25 * period_stock;
  RETURN max_stock;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `calc_min_stock`(period_stock FLOAT) RETURNS decimal(9,2)
BEGIN
  DECLARE min_stock DECIMAL(9,2);
  SET min_stock= 0.25 * period_stock;
  RETURN min_stock;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `m_depot`
--

CREATE TABLE IF NOT EXISTS `m_depot` (
  `id` int(14) NOT NULL,
  `depot_location` varchar(255) NOT NULL,
  `region_id` varchar(255) NOT NULL,
  `county_id` varchar(255) NOT NULL,
  `subcounty_id` varchar(255) NOT NULL,
  `depot_level` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_depot`
--

INSERT INTO `m_depot` (`id`, `depot_location`, `region_id`, `county_id`, `subcounty_id`, `depot_level`) VALUES
(1, '1', '', '', '', 1),
(2, '6', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_depot_fridges`
--

CREATE TABLE IF NOT EXISTS `m_depot_fridges` (
  `id` int(10) NOT NULL,
  `fridge_id` varchar(100) NOT NULL,
  `temperature_monitor_no` int(11) NOT NULL,
  `main_power_source` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date_added` date NOT NULL,
  `station_level` int(10) NOT NULL,
  `station_id` varchar(100) NOT NULL,
  `depot_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_depot_fridges`
--

INSERT INTO `m_depot_fridges` (`id`, `fridge_id`, `temperature_monitor_no`, `main_power_source`, `age`, `user_id`, `date_added`, `station_level`, `station_id`, `depot_id`) VALUES
(2, '2', 10, 0, 0, 14, '2015-11-15', 3, 'Baringo County', 0),
(3, '2', 0, 0, 0, 14, '2015-11-15', 3, 'Baringo County', 0),
(4, '2', 0, 0, 0, 14, '2015-11-15', 3, 'Baringo County', 0),
(5, '2', 0, 0, 0, 14, '2015-11-15', 3, 'Baringo County', 0),
(6, '2', 0, 0, 0, 14, '2015-11-15', 3, 'Baringo County', 0),
(41, '0', 0, 0, 0, 14, '2015-11-16', 3, 'Baringo County', 0),
(42, '11', 0, 0, 0, 14, '2015-11-16', 3, 'Baringo County', 0),
(43, '11', 0, 0, 0, 14, '2015-11-16', 3, 'Baringo County', 0),
(44, '2', 0, 0, 0, 14, '2015-11-16', 3, 'Baringo County', 0),
(45, '2', 0, 0, 0, 14, '2015-11-16', 3, 'Baringo County', 0),
(46, '14', 0, 0, 0, 14, '2015-11-20', 3, 'Baringo County', 0),
(47, '14', 0, 0, 0, 14, '2015-11-20', 3, 'Baringo County', 0),
(48, '3', 1, 0, 1, 0, '0000-00-00', 0, '0', 0),
(49, '2', 1, 0, 12, 0, '0000-00-00', 0, '0', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_depot`
--
ALTER TABLE `m_depot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_depot_fridges`
--
ALTER TABLE `m_depot_fridges`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_depot`
--
ALTER TABLE `m_depot`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_depot_fridges`
--
ALTER TABLE `m_depot_fridges`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

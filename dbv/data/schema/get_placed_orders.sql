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
END
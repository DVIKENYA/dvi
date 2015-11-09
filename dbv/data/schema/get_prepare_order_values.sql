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
END
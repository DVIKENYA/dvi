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
END
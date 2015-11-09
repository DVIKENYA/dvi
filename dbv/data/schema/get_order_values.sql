CREATE DEFINER=`root`@`localhost` PROCEDURE `get_order_values`(
IN $selected_vaccine VARCHAR(255)
)
begin
SELECT sum(msb.`stock_balance`) AS stock_balance,
	   min(msb.`expiry_date`) as first_expiry_date, mv.Doses_required, mv.Wastage_factor 
       FROM `m_stock_balance` msb
       LEFT JOIN m_vaccines mv ON mv.ID= msb.`vaccine_id`
       WHERE msb.vaccine_id=$selected_vaccine;
END
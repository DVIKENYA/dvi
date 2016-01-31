CREATE DEFINER=`root`@`localhost` PROCEDURE `GetVaccinesLedger`(IN `$selected_vaccine` VARCHAR(255))
BEGIN
SELECT mv.Vaccine_name, ms.transaction_date, ms.quantity_in,ms.quantity_out,sb.stock_balance, ms.batch_number,ms.expiry_date,mvvm.name 
FROM m_stock_movement ms 
INNER JOIN m_stock_balance sb ON sb.batch_number=ms.batch_number 

LEFT JOIN m_vvm_status mvvm ON mvvm.id=ms.VVM_status 
LEFT JOIN m_vaccines mv ON mv.ID=ms.vaccine_id 
WHERE ms.vaccine_id= $selected_vaccine
ORDER BY ms.batch_number,ms.transaction_type;

END
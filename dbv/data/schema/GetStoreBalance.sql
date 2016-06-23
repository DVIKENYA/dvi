CREATE DEFINER=`root`@`localhost` PROCEDURE `GetStoreBalance`(IN `$selected_vaccine` VARCHAR(255), IN `$user_id` VARCHAR(10))
BEGIN
SELECT mv.Vaccine_name,SUM(sb.stock_balance) AS balance
FROM m_stock_movement ms 
INNER JOIN m_stock_balance sb ON sb.batch_number=ms.batch_number 

LEFT JOIN m_vvm_status mvvm ON mvvm.id=ms.VVM_status 
LEFT JOIN m_vaccines mv ON mv.ID=ms.vaccine_id 
WHERE ms.vaccine_id= $selected_vaccine AND ms.user_id= $user_id
ORDER BY ms.batch_number,ms.transaction_type;

END
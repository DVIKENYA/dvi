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
               END
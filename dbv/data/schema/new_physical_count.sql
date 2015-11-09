CREATE DEFINER=`root`@`localhost` TRIGGER `new_physical_count` AFTER INSERT ON `m_physical_count`
 FOR EACH ROW begin
UPDATE m_stock_movement
SET physical_count= new.physical_count
WHERE vaccine_id = new.vaccine_id AND batch_number=new.batch_number;

UPDATE m_stock_balance
SET stock_balance = new.physical_count 
WHERE vaccine_id = new.vaccine_id AND batch_number=new.batch_number;
end
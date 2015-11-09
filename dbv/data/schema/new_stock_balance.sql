CREATE DEFINER=`root`@`localhost` TRIGGER new_stock_balance 
AFTER INSERT ON `m_stock_movement` for each row
 begin
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
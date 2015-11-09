
-------------------------------------------------------------------------------------------------------------
GET ALL VACCINES
-----------------------------------------------------------------------------------------------------------

DROP PROCEDURE IF EXISTS `GetAllVaccines`;

DELIMITER $$
CREATE PROCEDURE GetAllVaccines() 
BEGIN
SELECT Vaccine_name,ID FROM m_vaccines;
END;
-------------------------------------------------------------------------------------------------------------------------------------------------------------------


-------------------------------------------------------------------------------------------------------------
TRIGGER TO INSERT STOCK AND CALCULATE BALANCE
--------------------------------------------------------------------------------------------------------------
DROP TRIGGER new_stock_balance; 
DELIMITER $$
CREATE TRIGGER new_stock_balance 
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
END;

-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-------------------------------------------------------------------------------------------------------------------
PROCEDURE TO GET VACCINES LEDGER
-------------------------------------------------------------------------------------------------------------------

DROP PROCEDURE IF EXISTS `GetVaccinesLedger`;

DELIMITER $$
CREATE PROCEDURE GetVaccinesLedger(IN $selected_vaccine VARCHAR(255)) 
BEGIN
SELECT mv.Vaccine_name, ms.physical_count,ms.quantity_in,ms.quantity_out,msb.stock_balance, ms.batch_number,ms.expiry_date,mvvm.name FROM m_stock_movement ms
LEFT JOIN m_vaccines mv ON mv.ID=ms.vaccine_id
LEFT JOIN m_stock_balance msb ON msb.vaccine_id=ms.vaccine_id
LEFT JOIN m_vvm_status mvvm ON mvvm.id=ms.VVM_status
WHERE ms.vaccine_id= $selected_vaccine;
END;

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

---------------------------------------------------------------------------------------------------------------------------
PROCEDURE TO GET BATCH DETAILS OF THE SELECTED BATCH
---------------------------------------------------------------------------------------------------------------------------

DROP PROCEDURE IF EXISTS `GetBatchDetails`;

DELIMITER $$
CREATE PROCEDURE GetBatchDetails(IN $selected_batch VARCHAR(255)) 
BEGIN
SELECT ms.batch_number ,ms.expiry_date,mv.name FROM m_stock_balance ms 
LEFT JOIN m_vvm_status mv ON mv.id= ms.vvm_status
WHERE ms.vaccine_id=$selected_batch
AND ms.stock_balance !=0;

END;
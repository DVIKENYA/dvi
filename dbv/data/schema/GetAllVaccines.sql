CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllVaccines`()
BEGIN
SELECT Vaccine_name,ID FROM m_vaccines;
END
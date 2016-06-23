CREATE TABLE `m_vaccines` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vaccine_name` varchar(45) DEFAULT NULL,
  `Doses_required` int(15) NOT NULL,
  `Wastage_factor` decimal(14,2) NOT NULL,
  `Tray_color` varchar(30) NOT NULL,
  `Vaccine_designation` varchar(30) NOT NULL,
  `Vaccine_formulation` varchar(30) NOT NULL,
  `Mode_administration` varchar(30) NOT NULL,
  `Vaccine_presentation` varchar(30) NOT NULL,
  `Fridge_compart` varchar(30) NOT NULL,
  `Vaccine_pck_vol` decimal(14,1) NOT NULL,
  `Diluents_pck_vol` decimal(14,1) NOT NULL,
  `Vaccine_price_vial` decimal(14,2) NOT NULL,
  `Vaccine_price_dose` decimal(14,2) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
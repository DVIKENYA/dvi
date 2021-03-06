CREATE TABLE `dhis_usage` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `periodid` int(6) DEFAULT NULL,
  `periodname` varchar(14) DEFAULT NULL,
  `periodcode` int(6) DEFAULT NULL,
  `perioddescription` varchar(10) DEFAULT NULL,
  `organisationunitid` varchar(11) DEFAULT NULL,
  `organisationunitname` varchar(41) DEFAULT NULL,
  `organisationunitcode` varchar(6) DEFAULT NULL,
  `organisationunitdescription` text,
  `adv events foll imm(aefi)` varchar(2) DEFAULT NULL,
  `bcgdoseadm` varchar(4) DEFAULT NULL,
  `dpt1dosesadm` varchar(4) DEFAULT NULL,
  `dpt2dosesadministered` varchar(4) DEFAULT NULL,
  `dpt3dosesadm` varchar(4) DEFAULT NULL,
  `fullyimmunizedchildficabove2years` varchar(3) DEFAULT NULL,
  `fullyimmunizedchildrenficunder1ye` varchar(4) DEFAULT NULL,
  `measles 2 above 2 years` varchar(3) DEFAULT NULL,
  `measles 2(at 1 12 - 2 years)` varchar(4) DEFAULT NULL,
  `measlesdosesadm` varchar(4) DEFAULT NULL,
  `opvbirthdosesadm` varchar(4) DEFAULT NULL,
  `opv1dosesadm` varchar(4) DEFAULT NULL,
  `opv2dosesadm` varchar(4) DEFAULT NULL,
  `opv3dosesadm` varchar(4) DEFAULT NULL,
  `pneumococal1adm` varchar(4) DEFAULT NULL,
  `pneumococal2adm` varchar(4) DEFAULT NULL,
  `pneumococal3administered` varchar(4) DEFAULT NULL,
  `rotavirus1dosesadministered` varchar(4) DEFAULT NULL,
  `rotavirus2dosesadministered` varchar(4) DEFAULT NULL,
  `ser` varchar(3) DEFAULT NULL,
  `tt for pregn women` varchar(4) DEFAULT NULL,
  `vitamin a 2 years to 5 years(200,000 iu)` varchar(4) DEFAULT NULL,
  `vitamin a  _gt1 yr supplem` varchar(3) DEFAULT NULL,
  `vitamin a lactating  supp` varchar(4) DEFAULT NULL,
  `vitamin a 6-11mth supplet` varchar(4) DEFAULT NULL,
  `vitamin a at 1 12 years(200,000 iu)` varchar(4) DEFAULT NULL,
  `vitamin a at 1years (200,000iu)` varchar(4) DEFAULT NULL,
  `vitamin a at 6 months(100,000 iu)` varchar(4) DEFAULT NULL,
  `yellowfeveradm` varchar(3) DEFAULT NULL,
  `bcg doses in stock` varchar(5) DEFAULT NULL,
  `bcg doses received` varchar(5) DEFAULT NULL,
  `bcg doses remaining` varchar(5) DEFAULT NULL,
  `dpt+hib+hep b in stock` varchar(5) DEFAULT NULL,
  `dpt+hib+hep b received` varchar(4) DEFAULT NULL,
  `dpt+hib+hep b remaining` varchar(5) DEFAULT NULL,
  `measles in stock` varchar(5) DEFAULT NULL,
  `measles received` varchar(4) DEFAULT NULL,
  `measles remaining` varchar(5) DEFAULT NULL,
  `opv doses in stock` varchar(5) DEFAULT NULL,
  `opv doses remaining` varchar(4) DEFAULT NULL,
  `pneumococal in stock` varchar(4) DEFAULT NULL,
  `pneumococal received` varchar(4) DEFAULT NULL,
  `pneumococal remainin` varchar(4) DEFAULT NULL,
  `tt dose in stock` varchar(5) DEFAULT NULL,
  `tt dose remaining` varchar(5) DEFAULT NULL,
  `vitamin a 100 stock` varchar(5) DEFAULT NULL,
  `vitamin a 100 remain` varchar(5) DEFAULT NULL,
  `vitamin a 200 stock` varchar(5) DEFAULT NULL,
  `vitamin a 200 remain` varchar(5) DEFAULT NULL,
  `vitamin a 50 stock` varchar(5) DEFAULT NULL,
  `vitamin a 50 remaini` varchar(5) DEFAULT NULL,
  `yellow fever in stoc` varchar(3) DEFAULT NULL,
  `yellow fever receive` varchar(10) DEFAULT NULL,
  `yellow fever remaini` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
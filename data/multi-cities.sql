-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.30-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table twincities.cities
DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `Area` float DEFAULT NULL,
  `CoaURL` text,
  `Coordinates` varchar(30) DEFAULT NULL,
  `CountryID` int(11) NOT NULL DEFAULT '-1',
  `Decimal_coords` varchar(25) DEFAULT NULL,
  `Elevation` int(11) DEFAULT NULL,
  `Name` varchar(20) DEFAULT NULL,
  `Population` int(11) DEFAULT NULL,
  `woeid` int(11) DEFAULT NULL,
  `Website` text,
  `flickr_id` varchar(50) DEFAULT NULL,
  `Pair` int(1) NOT NULL DEFAULT '0',
  `WeatherURL` text NOT NULL,
  PRIMARY KEY (`UID`),
  KEY `CountryID` (`CountryID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table twincities.cities: ~8 rows (approximately)
DELETE FROM `cities`;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` (`UID`, `Area`, `CoaURL`, `Coordinates`, `CountryID`, `Decimal_coords`, `Elevation`, `Name`, `Population`, `woeid`, `Website`, `flickr_id`, `Pair`, `WeatherURL`) VALUES
	(1, 7.37, 'Pembroke-UK.jpg', '51deg40\'34"N, 4deg54\'57"W', 1, '51.676111, -4.915833', 77, 'Pembroke', 7552, 31602, 'http://www.pembroketown.org.uk/', 'ZIa1xkZQULySiSPLdA', 0, 'https://forecast7.com/en/51d67n4d91/pembroke/'),
	(2, 163.77, 'Bergen.png', '52deg48\'37"N, 9deg57\'40"E', 2, '52.810278, 9.961111', 68, 'Bergen', 13027, 12833291, 'http://www.bergen-online.de/', 'qyw9WdNXUb1WY6c', 1, 'https://forecast7.com/en/52d819d96/bergen/'),
	(3, 2.3, 'Pembroke-MT.jpg', '35deg55\'35"N, 14deg28\'51"E', 3, '35.926389, 14.480833', 51, 'Pembroke', 3645, 10645040, 'http://www.pembroke.gov.mt/', 'Xb438KZQUrxS60kmdA', 1, 'https://forecast7.com/en/35d9314d48/pembroke/'),
	(4, 0, 'oujda-coa.png', '34.6815864,-1.9097781', 4, '34.6815864,-1.9097781', 470, 'Oujda', 494252, 1538412, 'http://www.oriental.ma/', NULL, 1, 'https://forecast7.com/en/34d68n1d90/oujda/'),
	(5, 41.67, 'trowbridge-coa.jpg', '51.3191329,-2.2409817', 1, '51.3191329,-2.2409817', 42, 'Trowbridge', 33108, 38271, 'https://www.trowbridge.gov.uk/', NULL, 0, 'https://forecast7.com/en/51d32n2d21/trowbridge/'),
	(6, 70.3, 'leer-coa.png', '53.2428733,7.4515023', 2, '53.2428733,7.4515023', 3, 'Leer', 34042, 12596996, 'https://www.leer.de/', NULL, 1, 'https://forecast7.com/en/53d247d47/leer/'),
	(7, 1.85, 'charenton-le-pont-coa.png', '48.8227154,2.4030234', 5, '48.8227154,2.4030234', 35, 'Charenton-le-Pont', 28679, 55863443, 'http://www.charenton.fr/', NULL, 1, 'https://forecast7.com/en/48d822d42/charenton-le-pont/'),
	(8, 79.82, 'elblag-coa.png', '54.1798838,19.4162031', 6, '54.1798838,19.4162031', 21, 'Elblag', 124257, 492781, 'http://www.elblag.eu/', NULL, 1, 'https://forecast7.com/en/54d1619d40/elblag/');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;

-- Dumping structure for table twincities.countries
DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(15) NOT NULL DEFAULT '',
  `Name_Short` varchar(3) NOT NULL DEFAULT '',
  `Population` int(11) NOT NULL DEFAULT '0',
  `Language` varchar(15) NOT NULL DEFAULT '',
  `Currency` varchar(15) NOT NULL DEFAULT '',
  `Geo_Location` varchar(25) NOT NULL DEFAULT '',
  `FlagURL` text NOT NULL,
  `CoaURL` text NOT NULL,
  `WOE_ID` int(11) DEFAULT NULL,
  `Total_Area` int(11) NOT NULL DEFAULT '0',
  `Time_Zone` varchar(15) NOT NULL DEFAULT '',
  `Photo_url` text NOT NULL,
  `Wiki_url` text NOT NULL,
  PRIMARY KEY (`UID`),
  UNIQUE KEY `WOE_ID` (`WOE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table twincities.countries: ~6 rows (approximately)
DELETE FROM `countries`;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`UID`, `Name`, `Name_Short`, `Population`, `Language`, `Currency`, `Geo_Location`, `FlagURL`, `CoaURL`, `WOE_ID`, `Total_Area`, `Time_Zone`, `Photo_url`, `Wiki_url`) VALUES
	(1, 'United Kingdom', 'UK', 65640000, 'English', 'GBP', '46.3543038,-5.3732799', 'uk-flag.png', 'uk-coa.png', 23424975, 242495, 'UTC', '', 'https://en.wikipedia.org/wiki/United_Kingdom'),
	(2, 'Germany', 'DE', 82670000, 'German', 'EUR', '51.0968057,5.9675996', 'germany-flag.png', 'germany-coa.png', 23424829, 357168, 'UTC+1', '', 'https://en.wikipedia.org/wiki/Germany'),
	(3, 'Malta', 'MT', 436947, 'Maltese', 'EUR', '35.9421244,14.098163', 'malta-flag.png', 'malta-coa.png', 23424897, 316, 'UTC+1', '', 'https://en.wikipedia.org/wiki/Malta'),
	(4, 'Morocco', 'MA', 33848242, 'Moroccan Arabic', 'MAD', '30.5126737,-25.2569004', 'morocco-flag.png', 'morocco-coa.png', 23424893, 710850, 'UTC', '', 'https://en.wikipedia.org/wiki/Morocco'),
	(5, 'France', 'FR', 67201000, 'French', 'EUR', '44.8386812,-15.8264018', 'france-flag.png', 'france-coa.png', 23424819, 640679, 'UTC+1', '', 'https://en.wikipedia.org/wiki/France'),
	(6, 'Poland', 'PL', 38422346, 'Polish', 'PLN', '51.6266388,10.1888941', 'poland-flag.png', 'poland-coa.png', 23424923, 312679, 'UTC+1', '', 'https://en.wikipedia.org/wiki/Poland');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Dumping structure for table twincities.places
DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `CityID` int(11) NOT NULL DEFAULT '-1',
  `description` varchar(150) DEFAULT NULL,
  `geolocation` varchar(25) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `originated` varchar(5) DEFAULT NULL,
  `ImageURL` text NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `website` text,
  PRIMARY KEY (`UID`),
  KEY `CityID` (`CityID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table twincities.places: ~21 rows (approximately)
DELETE FROM `places`;
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
INSERT INTO `places` (`UID`, `CityID`, `description`, `geolocation`, `name`, `originated`, `ImageURL`, `type`, `website`) VALUES
	(1, 1, 'A medieval castle. Birthplace of Henry VII', '51.6769031,-4.9227225', 'Pembroke Castle', '1093', '1.jpg', 'Landmark', 'http://pembroke-castle.co.uk/'),
	(2, 1, 'Main train station', '51.7284586,-5.0074532', 'Pembroke Railway Station', '1863', '2.jpg', 'Public Transport', 'http://www.nationalrail.co.uk/stations_destinations/PMB.aspx'),
	(3, 1, 'Welsh rugby union team', '51.7285002,-5.0074532', 'Pembroke Rugby Football Club', '1896', '3.jpg', 'Sports Club', 'http://pembroke.rfc.wales/'),
	(4, 1, 'Highly rated pub', '51.6775255,-4.9201554', 'Watermans Arms', '-', '4.jpg', 'Public House', 'http://www.watermansarmspembroke.co.uk/'),
	(5, 1, 'Grade I listed building', '51.6753018,-4.9243469', 'Monkton Old Hall', '~1350', '5.jpg', 'Landmark', 'https://en.wikipedia.org/wiki/Monkton_Old_Hall'),
	(6, 1, 'Relaxed hotel offering classic rooms, a cosy bar and a restaurant with wood-beamed ceilings.', '51.6760237,-4.9200796', 'Old Kings Arms Hotel', '1522', '6.jpg', 'Accomodation', 'http://www.oldkingsarmshotel.co.uk'),
	(7, 1, 'Local school', '51.6845965,-4.9284571', 'Pembroke School', '1972', '7.jpg', 'Education', 'https://hwbpluse.wales.gov.uk/en/6684038/Pages/home.aspx'),
	(8, 2, 'A farmhouse museum dedicated to local and regional history', '52.8096001,9.9592813', 'Museum R?mstedthaus', '~1650', '8.jpg', 'Museum', 'http://www.bergen-online.de/77-0-Museum-Roemstedthaus.hrml'),
	(9, 2, 'Tourist information', '52.80995,9.9605614', 'Tourism Bergen', '-', '9.jpg', 'Organisation', 'http://www.tourismus-bergen.de/'),
	(10, 2, 'Local church', '52.8089819,9.9602081', 'St. Lambert\'s Church, Bergen', '1826', '10.jpg', 'POI', 'http://www.lamberti-bergen.de/Lambertikirche'),
	(11, 2, 'Local window maker', '52.8099461,9.9452406', 'Zink GmbH', '', '0.png', 'Window company', 'http://www.zink-fenster.de/'),
	(12, 2, 'Ice cream parlour', '52.807424,9.9636833', 'Eiscafe Miriam', '', '12.jpg', 'Restaurant', ''),
	(13, 2, 'Indoor heated pool', '52.809202,9.9472403', 'Stadtverwaltung Bergen', '', '13.jpg', 'Swimming Pool', ''),
	(14, 2, 'Used for various events including music concerts', '52.80823,9.9572913', 'Stadthaus', '', '14.jpg', 'Venue', 'https://www.bergen-online.de/68-0-Stadthaus.html'),
	(15, 3, 'A polygonal fort built by the British to defend part of the Victoria Lines\r\n', '35.9268796,14.478803', 'Fort Pembroke', '', '15.jpg', 'Fortress', ''),
	(16, 3, 'Monument to wounded ANZAC troops nursed in Malta\r\n', '35.9256399,14.4733885', 'Australia Hall', '', '22.jpg', 'Landmark', ''),
	(17, 3, 'Local football club\r\n', '35.9308411,14.4720813', 'Melita Football Club', '', '17.jpg', 'Football Club', ''),
	(18, 3, 'Soon to become a museum\r\n', '35.927303,14.4817936', 'Pembroke Battery', '', '18.jpg', 'Historical Place', ''),
	(19, 3, 'Tower overlooking Bahar ic-Caghaq\r\n', '35.9365984,14.4709146', 'Madliena Tower', '', '19.jpg', 'Tower', ''),
	(20, 3, 'Abandoned holiday complex', '35.9317494,14.4720553', 'White Rocks', '', '20.jpg', 'Ghost Town', ''),
	(21, 3, 'Open urban space to built to improve area', '35.9289509,14.4887602', 'Pembroke Gardens', '', '23.jpg', 'Garden', '');
/*!40000 ALTER TABLE `places` ENABLE KEYS */;

-- Dumping structure for table twincities.twins
DROP TABLE IF EXISTS `twins`;
CREATE TABLE IF NOT EXISTS `twins` (
  `City1_ID` int(11) NOT NULL DEFAULT '-1',
  `City2_ID` int(11) NOT NULL DEFAULT '-1',
  KEY `City1_ID_City2_ID` (`City1_ID`,`City2_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table twincities.twins: ~6 rows (approximately)
DELETE FROM `twins`;
/*!40000 ALTER TABLE `twins` DISABLE KEYS */;
INSERT INTO `twins` (`City1_ID`, `City2_ID`) VALUES
	(1, 2),
	(1, 3),
	(5, 4),
	(5, 6),
	(5, 7),
	(5, 8);
/*!40000 ALTER TABLE `twins` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

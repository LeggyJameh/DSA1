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
CREATE TABLE IF NOT EXISTS `cities` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `Area` float DEFAULT NULL,
  `CoaID` int(11) DEFAULT NULL,
  `Coordinates` varchar(30) DEFAULT NULL,
  `CountryID` int(11) NOT NULL DEFAULT '-1',
  `Decimal_coords` varchar(25) DEFAULT NULL,
  `Elevation` int(11) DEFAULT NULL,
  `Name` varchar(15) DEFAULT NULL,
  `Population` int(11) DEFAULT NULL,
  `woeid` int(11) DEFAULT NULL,
  `Website` varchar(50) DEFAULT NULL,
  `Pair` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UID`),
  KEY `CountryID` (`CountryID`),
  KEY `CoaID` (`CoaID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table twincities.cities: ~3 rows (approximately)
DELETE FROM `cities`;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` (`UID`, `Area`, `CoaID`, `Coordinates`, `CountryID`, `Decimal_coords`, `Elevation`, `Name`, `Population`, `woeid`, `Website`, `Pair`) VALUES
	(1, 7.37, 1, '51deg40\'34"N, 4deg54\'57"W', 1, '51.676111, -4.915833', 77, 'Pembroke', 7552, 31602, 'http://www.pembroketown.org.uk/', 0),
	(2, 163.77, 2, '52deg48\'37"N, 9deg57\'40"E', 2, '52.810278, 9.961111', 68, 'Bergen', 13027, 12833291, 'http://www.bergen-online.de/', 1),
	(3, 2.3, 3, '35deg55\'35"N, 14deg28\'51"E', 3, '35.926389, 14.480833', 51, 'Pembroke', 3645, 10645040, 'http://www.pembroke.gov.mt/', 1);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;

-- Dumping structure for table twincities.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(15) NOT NULL DEFAULT '',
  `Name_Short` varchar(3) NOT NULL DEFAULT '',
  `Population` int(11) NOT NULL DEFAULT '0',
  `Language` varchar(15) NOT NULL DEFAULT '',
  `Currency` varchar(15) NOT NULL DEFAULT '',
  `Geo_Location` varchar(25) NOT NULL DEFAULT '',
  `FlagID` int(11) NOT NULL DEFAULT '-1',
  `CoaID` int(11) NOT NULL DEFAULT '-1',
  `WOE_ID` int(11) NOT NULL DEFAULT '-1',
  `Total_Area` int(11) NOT NULL DEFAULT '0',
  `Time_Zone` varchar(15) NOT NULL DEFAULT '',
  `Photo_url` varchar(50) NOT NULL DEFAULT '',
  `Wiki_url` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`UID`),
  UNIQUE KEY `WOE_ID` (`WOE_ID`),
  KEY `FlagID_CoaID` (`FlagID`,`CoaID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table twincities.countries: ~3 rows (approximately)
DELETE FROM `countries`;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`UID`, `Name`, `Name_Short`, `Population`, `Language`, `Currency`, `Geo_Location`, `FlagID`, `CoaID`, `WOE_ID`, `Total_Area`, `Time_Zone`, `Photo_url`, `Wiki_url`) VALUES
	(1, 'United Kingdom', 'UK', 65640000, 'English', 'GBP', '46.3543038,-5.3732799', 4, 7, 23424975, 242495, 'UTC', '', 'https://en.wikipedia.org/wiki/United_Kingdom'),
	(2, 'Germany', 'DE', 82670000, 'German', 'EUR', '51.0968057,5.9675996', 5, 8, 23424829, 357168, 'UTC+1', '', 'https://en.wikipedia.org/wiki/Germany'),
	(3, 'Malta', 'MT', 436947, 'Maltese', 'EUR', '35.9421244,14.098163', 6, 9, 23424897, 316, 'UTC+1', '', 'https://en.wikipedia.org/wiki/Malta');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Dumping structure for table twincities.images
CREATE TABLE IF NOT EXISTS `images` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(50) NOT NULL DEFAULT '',
  `desc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumping data for table twincities.images: ~30 rows (approximately)
DELETE FROM `images`;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`UID`, `url`, `desc`) VALUES
	(1, 'Pembroke-UK.jpg', 'pembroke uk coat of arms'),
	(2, 'Bergen.png', 'bergen coat of arms'),
	(3, 'Pembroke-MT.jpg', 'pembroke malta coat of ar'),
	(4, 'https://upload.wikimedia.org/wikipedia/en/thumb/a/', 'uk flag'),
	(5, 'https://upload.wikimedia.org/wikipedia/en/thumb/b/', 'german flag'),
	(6, 'https://upload.wikimedia.org/wikipedia/commons/thu', 'pembroke malta flag'),
	(7, 'https://upload.wikimedia.org/wikipedia/commons/thu', 'uk coat of arms'),
	(8, 'https://upload.wikimedia.org/wikipedia/commons/thu', 'german coat of arms'),
	(9, 'https://upload.wikimedia.org/wikipedia/commons/thu', 'maltese coat of arms'),
	(10, '1.jpg', 'Pembroke Castle'),
	(11, '2.jpg', 'Pembroke Railway Station'),
	(12, '3.jpg', 'Pembroke Rugby Football Club'),
	(13, '4.jpg', 'Watermans Arms'),
	(14, '5.jpg', 'Monkton Old Hall'),
	(15, '6.jpg', 'Old Kings Arms Hotel'),
	(16, '7.jpg', 'Pembroke School'),
	(17, '8.jpg', 'Museum R?mstedthaus'),
	(18, '9.jpg', 'Tourism Bergen'),
	(19, '10.jpg', 'St. Lambert\'s Church, Bergen'),
	(20, '0.png', 'Zink GmbH'),
	(21, '12.jpg', 'Eiscafe Miriam'),
	(22, '13.jpg', 'Stadtverwaltung Bergen'),
	(23, '14.jpg', 'Stadthaus'),
	(24, '15.jpg', 'Fort Pembroke'),
	(25, '22.jpg', 'Australia Hall'),
	(26, '17.jpg', 'Melita Football Club'),
	(27, '18.jpg', 'Pembroke Battery'),
	(28, '19.jpg', 'Madliena Tower'),
	(29, '20.jpg', 'White Rocks'),
	(30, '23.jpg', 'Pembroke Gardens');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Dumping structure for table twincities.places
CREATE TABLE IF NOT EXISTS `places` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `CityID` int(11) NOT NULL DEFAULT '-1',
  `description` varchar(150) DEFAULT NULL,
  `geolocation` varchar(25) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `originated` varchar(5) DEFAULT NULL,
  `ImageID` int(11) NOT NULL DEFAULT '-1',
  `type` varchar(20) DEFAULT NULL,
  `website` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`UID`),
  KEY `CityID` (`CityID`),
  KEY `ImageID` (`ImageID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table twincities.places: ~21 rows (approximately)
DELETE FROM `places`;
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
INSERT INTO `places` (`UID`, `CityID`, `description`, `geolocation`, `name`, `originated`, `ImageID`, `type`, `website`) VALUES
	(1, 1, 'A medieval castle. Birthplace of Henry VII', '51.6769031,-4.9227225', 'Pembroke Castle', '1093', 10, 'Landmark', 'http://pembroke-castle.co.uk/'),
	(2, 1, 'Main train station', '51.7284586,-5.0074532', 'Pembroke Railway Station', '1863', 11, 'Public Transport', 'http://www.nationalrail.co.uk/stations_destinations/PMB.aspx'),
	(3, 1, 'Welsh rugby union team', '51.7285002,-5.0074532', 'Pembroke Rugby Football Club', '1896', 12, 'Sports Club', 'http://pembroke.rfc.wales/'),
	(4, 1, 'Highly rated pub', '51.6775255,-4.9201554', 'Watermans Arms', '-', 13, 'Public House', 'http://www.watermansarmspembroke.co.uk/'),
	(5, 1, 'Grade I listed building', '51.6753018,-4.9243469', 'Monkton Old Hall', '~1350', 14, 'Landmark', 'https://en.wikipedia.org/wiki/Monkton_Old_Hall'),
	(6, 1, 'Relaxed hotel offering classic rooms, a cosy bar and a restaurant with wood-beamed ceilings.', '51.6760237,-4.9200796', 'Old Kings Arms Hotel', '1522', 15, 'Accomodation', 'http://www.oldkingsarmshotel.co.uk'),
	(7, 1, 'Local school', '51.6845965,-4.9284571', 'Pembroke School', '1972', 16, 'Education', 'https://hwbpluse.wales.gov.uk/en/6684038/Pages/home.aspx'),
	(8, 2, 'A farmhouse museum dedicated to local and regional history', '52.8096001,9.9592813', 'Museum R?mstedthaus', '~1650', 17, 'Museum', 'http://www.bergen-online.de/77-0-Museum-Roemstedthaus.hrml'),
	(9, 2, 'Tourist information', '52.80995,9.9605614', 'Tourism Bergen', '-', 18, 'Organisation', 'http://www.tourismus-bergen.de/'),
	(10, 2, 'Local church', '52.8089819,9.9602081', 'St. Lambert\'s Church, Bergen', '1826', 19, 'POI', 'http://www.lamberti-bergen.de/Lambertikirche'),
	(11, 2, 'Local window maker', '52.8099461,9.9452406', 'Zink GmbH', '', 20, 'Window company', 'http://www.zink-fenster.de/'),
	(12, 2, 'Ice cream parlour', '52.807424,9.9636833', 'Eiscafe Miriam', '', 21, 'Restaurant', ''),
	(13, 2, 'Indoor heated pool', '52.809202,9.9472403', 'Stadtverwaltung Bergen', '', 22, 'Swimming Pool', ''),
	(14, 2, 'Used for various events including music concerts', '52.80823,9.9572913', 'Stadthaus', '', 23, 'Venue', 'https://www.bergen-online.de/68-0-Stadthaus.html'),
	(15, 3, 'A polygonal fort built by the British to defend part of the Victoria Lines\r\n', '35.9268796,14.478803', 'Fort Pembroke', '', 24, 'Fortress', ''),
	(16, 3, 'Monument to wounded ANZAC troops nursed in Malta\r\n', '35.9256399,14.4733885', 'Australia Hall', '', 25, 'Landmark', ''),
	(17, 3, 'Local football club\r\n', '35.9308411,14.4720813', 'Melita Football Club', '', 26, 'Football Club', ''),
	(18, 3, 'Soon to become a museum\r\n', '35.927303,14.4817936', 'Pembroke Battery', '', 27, 'Historical Place', ''),
	(19, 3, 'Tower overlooking Bahar ic-Caghaq\r\n', '35.9365984,14.4709146', 'Madliena Tower', '', 28, 'Tower', ''),
	(20, 3, 'Abandoned holiday complex', '35.9317494,14.4720553', 'White Rocks', '', 29, 'Ghost Town', ''),
	(21, 3, 'Open urban space to built to improve area', '35.9289509,14.4887602', 'Pembroke Gardens', '', 30, 'Garden', '');
/*!40000 ALTER TABLE `places` ENABLE KEYS */;

-- Dumping structure for table twincities.twins
CREATE TABLE IF NOT EXISTS `twins` (
  `City1_ID` int(11) NOT NULL DEFAULT '-1',
  `City2_ID` int(11) NOT NULL DEFAULT '-1',
  KEY `City1_ID_City2_ID` (`City1_ID`,`City2_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table twincities.twins: ~2 rows (approximately)
DELETE FROM `twins`;
/*!40000 ALTER TABLE `twins` DISABLE KEYS */;
INSERT INTO `twins` (`City1_ID`, `City2_ID`) VALUES
	(1, 2),
	(1, 3);
/*!40000 ALTER TABLE `twins` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Server: 127.0.0.1
-- Generated: 06-03-2018 19:37:30
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twincities`
--

-- --------------------------------------------------------

--
-- Table structure for `cities` table
--

CREATE TABLE `cities` (
  `area` float DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `coat_of_arms` varchar(25) DEFAULT NULL,
  `coordinates` varchar(30) DEFAULT NULL,
  `country` varchar(15) DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `decimal_coords` varchar(25) DEFAULT NULL,
  `elevation` int(11) DEFAULT NULL,
  `name` varchar(15) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `woeid` int(11) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data for `cities` table
--

INSERT INTO `cities` (`area`, `city`, `coat_of_arms`, `coordinates`, `country`, `currency`, `decimal_coords`, `elevation`, `name`, `population`, `woeid`, `website`) VALUES
(7.37, 'Pembroke/UK', 'Pembroke-UK.jpg', '51deg40\'34\"N, 4deg54\'57\"W', 'United Kindom', 'GBP', '51.676111, -4.915833', 77, 'Pembroke', 7552, 31602, 'http://www.pembroketown.org.uk/'),
(163.77, 'Bergen/DE', 'Bergen.png', '52deg48\'37\"N, 9deg57\'40\"E', 'Germany', 'EUR', '52.810278, 9.961111', 68, 'Bergen', 13027, 12833291, 'http://www.bergen-online.de/'),
(2.3, 'Pembroke/MT', 'Pembroke-MT.jpg', '35deg55\'35\"N, 14deg28\'51\"E', 'Malta', 'EUR', '35.926389, 14.480833', 51, 'Pembroke', 3645, 10645040, 'http://www.pembroke.gov.mt/');

-- --------------------------------------------------------

--
-- Structure for `places` table
--

CREATE TABLE `places` (
  `city` varchar(15) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `geolocation` varchar(25) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `originated` varchar(5) DEFAULT NULL,
  `photo` varchar(10) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `website` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data for `places` table
--

INSERT INTO `places` (`city`, `description`, `geolocation`, `name`, `originated`, `photo`, `type`, `website`) VALUES
('Pembroke/UK', 'A medieval castle. Birthplace of Henry VII', '51.6769031,-4.9227225', 'Pembroke Castle', '1093', '1.jpg', 'Landmark', 'http://pembroke-castle.co.uk/'),
('Pembroke/UK', 'Main train station', '51.7284586,-5.0074532', 'Pembroke Railway Station', '1863', '2.jpg', 'Public Transport', 'http://www.nationalrail.co.uk/stations_destinations/PMB.aspx'),
('Pembroke/UK', 'Welsh rugby union team', '51.7285002,-5.0074532', 'Pembroke Rugby Football Club', '1896', '3.jpg', 'Sports Club', 'http://pembroke.rfc.wales/'),
('Pembroke/UK', 'Highly rated pub', '51.6775255,-4.9201554', 'Watermans Arms', '-', '4.jpg', 'Public House', 'http://www.watermansarmspembroke.co.uk/'),
('Pembroke/UK', 'Grade I listed building', '51.6753018,-4.9243469', 'Monkton Old Hall', '~1350', '5.jpg', 'Landmark', 'https://en.wikipedia.org/wiki/Monkton_Old_Hall'),
('Pembroke/UK', 'Relaxed hotel offering classic rooms, a cosy bar and a restaurant with wood-beamed ceilings.', '51.6760237,-4.9200796', 'Old Kings Arms Hotel', '1522', '6.jpg', 'Accomodation', 'http://www.oldkingsarmshotel.co.uk'),
('Pembroke/UK', 'Local school', '51.6845965,-4.9284571', 'Pembroke School', '1972', '7.jpg', 'Education', 'https://hwbpluse.wales.gov.uk/en/6684038/Pages/home.aspx'),
('Bergen/DE', 'A farmhouse museum dedicated to local and regional history', '52.8096001,9.9592813', 'Museum R?mstedthaus', '~1650', '8.jpg', 'Museum', 'http://www.bergen-online.de/77-0-Museum-Roemstedthaus.hrml'),
('Bergen/DE', 'Tourist information', '52.80995,9.9605614', 'Tourism Bergen', '-', '9.jpg', 'Organisation', 'http://www.tourismus-bergen.de/'),
('Bergen/DE', 'Local church', '52.8089819,9.9602081', 'St. Lambert\'s Church, Bergen', '1826', '10.jpg', 'POI', 'http://www.lamberti-bergen.de/Lambertikirche'),
('Bergen/DE', 'Local window maker', '52.8099461,9.9452406', 'Zink GmbH', '', '0.png', 'Window company', 'http://www.zink-fenster.de/'),
('Bergen/DE', 'Ice cream parlour', '52.807424,9.9636833', 'Eiscafe Miriam', '', '12.jpg', 'Restaurant', ''),
('Bergen/DE', 'Indoor heated pool', '52.809202,9.9472403', 'Stadtverwaltung Bergen', '', '13.jpg', 'Swimming Pool', ''),
('Bergen/DE', 'Used for various events including music concerts', '52.80823,9.9572913', 'Stadthaus', '', '14.jpg', 'Venue', 'https://www.bergen-online.de/68-0-Stadthaus.html'),
('Pembroke/MT', 'A polygonal fort built by the British to defend part of the Victoria Lines\r\n', '35.9268796,14.478803', 'Fort Pembroke', '', '15.jpg', 'Fortress', ''),
('Pembroke/MT', 'Monument to wounded ANZAC troops nursed in Malta\r\n', '35.9256399,14.4733885', 'Australia Hall', '', '22.jpg', 'Landmark', ''),
('Pembroke/MT', 'Local football club\r\n', '35.9308411,14.4720813', 'Melita Football Club', '', '17.jpg', 'Football Club', ''),
('Pembroke/MT', 'Soon to become a museum\r\n', '35.927303,14.4817936', 'Pembroke Battery', '', '18.jpg', 'Historical Place', ''),
('Pembroke/MT', 'Tower overlooking Bahar ic-Caghaq\r\n', '35.9365984,14.4709146', 'Madliena Tower', '', '19.jpg', 'Tower', ''),
('Pembroke/MT', 'Abandoned holiday complex', '35.9317494,14.4720553', 'White Rocks', '', '20.jpg', 'Ghost Town', ''),
('Pembroke/MT', 'Open urban space to built to improve area', '35.9289509,14.4887602', 'Pembroke Gardens', '', '23.jpg', 'Garden', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

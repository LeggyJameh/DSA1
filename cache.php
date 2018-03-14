<?php
	include_once 'db-cache.php';
	include_once 'objects.php';
	final class Cache
	{
		public static $cities, $countries, $places;
		
		public static function Instance()
		{
			static $inst = null;
			if ($inst === null) {
				$inst = new Cache();
				Cache::$cities = array();
				Cache::$countries = array();
				Cache::$places = array();
				Cache::getCities();
				Cache::getCountries();
				Cache::getPlaces();
			}
			return $inst;
		}
		
		private function __construct()
		{
		}
		
		static function getCities()
		{
			$query = "SELECT * FROM cities";
			$result = executeQuery($query);
			
			foreach ($result as $row)
			{
				array_push(Cache::$cities, new City($row));
			}
		}
		
		static function getCountries()
		{
			$query = "SELECT * FROM countries";
			$result = executeQuery($query);
			
			foreach ($result as $row)
			{
				array_push(Cache::$countries, new Country($row));
			}
		}
		
		static function getPlaces()
		{
			$query = "SELECT * FROM places";
			$result = executeQuery($query);
			
			foreach ($result as $row)
			{
				array_push(Cache::$places, new Place($row));
			}
		}
		
		static function getCityFromID($cityID)
		{
			foreach (Cache::$cities as $city)
			{
				if ($city->UID == $cityID)
				{
					return $city;
				}
			}
		}
		
		static function getCountryFromID($countryID)
		{
			foreach (Cache::$countries as $country)
			{
				if ($country->UID == $countryID)
				{
					return $country;
				}
			}
		}
		
		static function getPlaceFromID($placeID)
		{
			foreach (Cache::$places as $place)
			{
				if ($place->UID == $placeID)
				{
					return $place;
				}
			}
		}
		
		static function getPlacesForCity($CityUID)
		{
			$idFilter = new idFilter($CityUID);
			return array_filter(Cache::$places, array(new IDFilter($CityUID), 'isSame'));
		}
		
		static function getTwins($cityID)
		{
			$pairedCities = array();
			$query = "SELECT `UID` FROM `cities` c LEFT OUTER JOIN `twins` p ON p.`City2_ID` = c.`UID` WHERE p.`City1_ID`='".$cityID."';";
			
			$result = executeQuery($query);
			
			foreach ($result as $row)
			{
				array_push($pairedCities, Cache::getCityFromID($row["UID"]));
			}
			return $pairedCities;
		}
		
		
	}
	
	class IDFilter
	{
		private $UID;

        function __construct($ID) {
                $this->UID = $ID;
        }

        function isSame($i) {
			if ($i->CityID == $this->UID) {
				return true;
			}
			else {
				return false;
			}
        }
	}
?>

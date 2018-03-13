<?php
	include_once 'api.php';
	include_once 'objects.php';
	final class Cache
	{
		public static $cities, $countries, $images, $places;
		
		public static function Instance()
		{
			static $inst = null;
			if ($inst === null) {
				$inst = new Cache();
				Cache::$cities = array();
				Cache::$countries = array();
				Cache::$images = array();
				Cache::$places = array();
				Cache::getCities();
				Cache::getCountries();
			}
			return $inst;
		}
		
		private function __construct()
		{
		}
		
		static function getCities()
		{
			$query = "SELECT * FROM cities";
			$result = getQuery($query);
			
			foreach ($result as $row)
			{
				array_push(Cache::$cities, new City($row));
			}
		}
		
		static function getCountries()
		{
			$query = "SELECT * FROM countries";
			$result = getQuery($query);
			
			foreach ($result as $row)
			{
				array_push(Cache::$countries, new Country($row));
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
		
		static function getTwins($cityID)
		{
			$pairedCities = array();
			$query = "SELECT `UID` FROM `cities` c LEFT OUTER JOIN `twins` p ON p.`City2_ID` = c.`UID` WHERE p.`City1_ID`='".$cityID."';";
			
			$result = getQuery($query);
			
			foreach ($result as $row)
			{
				array_push($pairedCities, Cache::getCityFromID($row["UID"]));
			}
			return $pairedCities;
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
	}
?>

<?php
/*
	Caching class used for all data storage. At the start of the application, this pulls all necessary data from the database.
	This class is a simpleton, meaning there is only ever one instance of it.
	This allows other parts of the application to access data without delays from fetching from the database.
	This could later be improved to only keep recently accessed data when the database is too big to make
	storing it all here, simultaneously, unviable.
*/

	include_once 'db-cache.php';
	include_once 'objects.php';
	final class Cache
	{
		public static $cities, $countries, $places;
		
		// Get the current and -only- instance. If there isn't one, construct one, and return it
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
			// No need for construction, cache is simpleton.
		}
		
		// Pull all cities from the database
		static function getCities()
		{
			$query = "SELECT * FROM cities";
			$result = executeQuery($query);
			
			foreach ($result as $row)
			{
				array_push(Cache::$cities, new City($row));
			}
		}
		
		// Pull all countries from the database
		static function getCountries()
		{
			$query = "SELECT * FROM countries";
			$result = executeQuery($query);
			
			foreach ($result as $row)
			{
				array_push(Cache::$countries, new Country($row));
			}
		}
		
		// Pull all places from the database
		static function getPlaces()
		{
			$query = "SELECT * FROM places";
			$result = executeQuery($query);
			
			foreach ($result as $row)
			{
				array_push(Cache::$places, new Place($row));
			}
		}
		
		// Returns a city object from the given city ID
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
		
		// Returns a country object from the given country ID
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
		
		// Returns a place object from the given place ID
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
		
		// Returns a list of places for the given city ID
		static function getPlacesForCity($CityUID)
		{
			$idFilter = new idFilter($CityUID);
			return array_filter(Cache::$places, array(new IDFilter($CityUID), 'isSame'));
		}
		
		// Returns a list of cities that are pairs of the given city ID
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
	
	// Filter class and functions used for getPlacesForCity()
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

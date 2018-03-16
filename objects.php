<?php
/* 
	This php file is just used for the various data objects that will be used for our Object-oriented approach.
	The properties of each object map perfectly to the structure of the database.
*/

class City
{
	public $UID, $Area, $CoaURL, $Coordinates, $CountryID, $Decimal_coords, $Elevation, $Name, $Population, $woeid, $Website, $flickr_id, $Pair;
	
	function __construct($row_from_database)
	{
		$this->UID = $row_from_database["UID"];
		$this->Area = $row_from_database["Area"];
		$this->CoaURL = $row_from_database["CoaURL"];
		$this->Coordinates = $row_from_database["Coordinates"];
		$this->CountryID = $row_from_database["CountryID"];
		$this->Decimal_coords = $row_from_database["Decimal_coords"];
		$this->Elevation = $row_from_database["Elevation"];
		$this->Name = $row_from_database["Name"];
		$this->Population = $row_from_database["Population"];
		$this->woeid = $row_from_database["woeid"];
		$this->Website = $row_from_database["Website"];
		$this->flickr_id = $row_from_database["flickr_id"];
		$this->Pair = $row_from_database["Pair"];
	}
}

class Country
{
	public $UID, $Name, $Name_Short, $Population, $Language, $Currency, $Geo_Location, $FlagURL, $CoaURL, $WOE_ID, $Total_Area, $Time_Zone, $Photo_url, $Wiki_url;
	
	function __construct($row_from_database)
	{
		$this->UID = $row_from_database["UID"];
		$this->Name = $row_from_database["Name"];
		$this->Name_Short = $row_from_database["Name_Short"];
		$this->Population = $row_from_database["Population"];
		$this->Language = $row_from_database["Language"];
		$this->Currency = $row_from_database["Currency"];
		$this->Geo_Location = $row_from_database["Geo_Location"];
		$this->FlagURL = $row_from_database["FlagURL"];
		$this->CoaURL = $row_from_database["CoaURL"];
		$this->WOE_ID = $row_from_database["WOE_ID"];
		$this->Total_Area = $row_from_database["Total_Area"];
		$this->Time_Zone = $row_from_database["Time_Zone"];
		$this->Photo_url = $row_from_database["Photo_url"];
		$this->Wiki_url = $row_from_database["Wiki_url"];
	}
}

class Place
{
	public $UID, $CityID, $description, $geolocation, $name, $originated, $ImageURL, $type, $website;
	
	function __construct($row_from_database)
	{
		$this->UID = $row_from_database["UID"];
		$this->CityID = $row_from_database["CityID"];
		$this->description = $row_from_database["description"];
		$this->geolocation = $row_from_database["geolocation"];
		$this->name = $row_from_database["name"];
		$this->originated = $row_from_database["originated"];
		$this->ImageURL = $row_from_database["ImageURL"];
		$this->type = $row_from_database["type"];
		$this->website = $row_from_database["website"];
	}
}
?>
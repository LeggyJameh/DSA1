<?php
class City
{
	public $UID, $Area, $CoaID, $Coordinates, $CountryID, $Decimal_coords, $Elevation, $Name, $Population, $woeid, $Website, $Pair;
	
	function __construct($row_from_database)
	{
		$this->UID = $row_from_database["UID"];
		$this->Area = $row_from_database["Area"];
		$this->CoaID = $row_from_database["CoaID"];
		$this->Coordinates = $row_from_database["Coordinates"];
		$this->CountryID = $row_from_database["CountryID"];
		$this->Decimal_coords = $row_from_database["Decimal_coords"];
		$this->Elevation = $row_from_database["Elevation"];
		$this->Name = $row_from_database["Name"];
		$this->Population = $row_from_database["Population"];
		$this->woeid = $row_from_database["woeid"];
		$this->Website = $row_from_database["Website"];
		$this->Pair = $row_from_database["Pair"];
	}
}

class Country
{
	public $UID, $Name, $Name_Short, $Population, $Language, $Currency, $Geo_Location, $FlagID, $CoaID, $WOE_ID, $Total_Area, $Time_Zone, $Photo_url, $Wiki_url;
	
	function __construct($row_from_database)
	{
		$this->UID = $row_from_database["UID"];
		$this->Name = $row_from_database["Name"];
		$this->Name_Short = $row_from_database["Name_Short"];
		$this->Population = $row_from_database["Population"];
		$this->Language = $row_from_database["Language"];
		$this->Currency = $row_from_database["Currency"];
		$this->Geo_Location = $row_from_database["Geo_Location"];
		$this->FlagID = $row_from_database["FlagID"];
		$this->CoaID = $row_from_database["CoaID"];
		$this->WOE_ID = $row_from_database["WOE_ID"];
		$this->Total_Area = $row_from_database["Total_Area"];
		$this->Time_Zone = $row_from_database["Time_Zone"];
		$this->Photo_url = $row_from_database["Photo_url"];
		$this->Wiki_url = $row_from_database["Wiki_url"];
	}
}

class Image
{
	public $UID, $url, $desc;
	
	function __construct($row_from_database)
	{
		$this->UID = $row_from_database["UID"];
		$this->url = $row_from_database["url"];
		$this->desc = $row_from_database["desc"];
	}
}

class Place
{
	public $UID, $CityID, $description, $geolocation, $name, $originated, $ImageID, $type, $website;
	
	function __construct($row_from_database)
	{
		$this->UID = $row_from_database["UID"];
		$this->CityID = $row_from_database["CityID"];
		$this->description = $row_from_database["description"];
		$this->geolocation = $row_from_database["geolocation"];
		$this->name = $row_from_database["name"];
		$this->originated = $row_from_database["originated"];
		$this->ImageID = $row_from_database["ImageID"];
		$this->type = $row_from_database["type"];
		$this->website = $row_from_database["website"];
	}
}
?>
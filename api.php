<?php
/*
	This php file handles AJAX requests from JScript, and returns data from the cache
*/

// Public rss feed library
include 'jsonfeed2rss.php'; // https://gist.github.com/daveajones/be26f5ca9cb7559d0c33549b53323770
require_once ('cache.php');

$resultAsXML = true;
$result = ["success" => false];
$cache = Cache::Instance();

// Returns the cities that are paired with the selected main city, including the main city itself
function getCurrentCities()
{
	$currentCityID = $_COOKIE["cityID"];
	if (isset($_COOKIE["cityID"])) {
		$cities = Cache::getTwins($currentCityID);
		array_unshift($cities, Cache::getCityFromID($currentCityID));
		return $cities;
	}
	else {
		return null;
	}
}

// Postback code
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	// If the request is for cities...
    if ($_REQUEST['method'] == 'cities') 
    {
		$cities = getCurrentCities();
		if ($cities != null) {
			$result["data"] = $cities;
			$result["success"] = true;
		}
		else {
			$result["success"] = false;
		}
    }

	// If the request is for places...
    else if($_REQUEST['method'] == 'places') 
    {
		$cities = getCurrentCities();
		$places = array();
		foreach ($cities as $city)
		{
			$placesForCity = Cache::getPlacesForCity($city->UID);
			foreach ($placesForCity as $place)
			{
				array_push($places, $place);
			}
		}
		
		if (count($places) > 0)
		{
			$result["data"] = $places;
			$result["success"] = true;
		}
		else {
			$result["success"] = false;
		}
    }
	
	// If the request is for countries...
	else if($_REQUEST['method'] == 'countries')
	{
		$cities = getCurrentCities();
		$countries = array();
		foreach ($cities as $city)
		{
			array_push($countries, Cache::getCountryFromID($city->CountryID));
		}
		
		if (count($countries) > 0)
		{
			$result["data"] = $countries;
			$result["success"] = true;
		}
		else
		{
			$result["success"] = false;
		}
	}

	// If the request is for items for the RSS feed...
    else if($_REQUEST['method'] == 'feed')
    {
    	$places = Cache::$places;
    	$cities = Cache::$cities;

    	// id, url, title, content_html, date_published, attachments
    	$root_url = "http://example.com/";
    	$rss = [
    		"version" => "https://jsonfeed.org/version/1",
    		"title" => "Twin Cities RSS",
    		"home_page_url" => $root_url,
    		"items" => []
    	];

    	foreach ($cities as $v) {
			$country = Cache::getCountryFromID($v->CountryID);
    		$html = "<ul><li><strong>Population</strong> {$v->Population}</li>".
			    	"<li><strong>Area</strong> {$v->Area} km2</li>".
			        "<li><strong>Elevation</strong> {$v->Elevation} m</li>".
			        "<li><strong>Coordinates</strong> {$v->Coordinates}</li>".
			        "<li><strong>Currency</strong> {$country->Currency}</li></ul>";
    		$item = [
    			"id" => $v->UID,
    			"url" => $v->Website,
    			"title" => $v->Name.", ".$country->Name_Short,
    			"content_html" => $html,
    			"date_published" => date(DATE_RFC2822),
    			"attachments" => []
    		];

    		array_push($rss['items'], $item);
    	}

    	foreach ($places as $v) {
			$city = Cache::getCityFromID($v->CityID);
    		$html = "<strong>{$v->type}</strong>".
			    	"<p>{$v->description}</p>".
			        "<small>{$v->geolocation}</small>";
    		$item = [
    			"id" => $v->UID,
    			"url" => $v->website,
    			"title" => $v->name.", ".$city->Name,
    			"content_html" => $html,
    			"date_published" => date(DATE_RFC2822),
    			"attachments" => []
    		];

    		array_push($rss['items'], $item);
    	}

		$result["success"] = true;
    	$result = $rss;
    	$resultAsXML = false;
    }
}
else // Otherwise, it's not a request. Go away please....
{
	$result["info"] = "Invalid request method, POST only";
}

if ($resultAsXML) {
	header('Content-Type: application/json');
	header('Cache-Control: no-cache');
	echo json_encode($result, JSON_PRETTY_PRINT);
}
else {
	$str = json_encode($result);
	header('Content-Type: application/xml');
	echo convert_jsonfeed_to_rss($str);
}
?>
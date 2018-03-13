<?php
include 'jsonfeed2rss.php'; // https://gist.github.com/daveajones/be26f5ca9cb7559d0c33549b53323770

function getQuery($query) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "twincities";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$arr = [];
	$result = $conn->query($query);
	
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	        array_push($arr, $row);
	    }
	} 
	$conn->close();

	return $arr;
}

$resultAsXML = false;
$result = ["success" => false];

if($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if ($_REQUEST['method'] === 'cities') 
    {
    	$query = "SELECT area, city, coat_of_arms, coordinates, country, currency, decimal_coords, elevation, name, population, woeid, website FROM cities";
    	$result["data"] = getQuery($query);
    	$result["success"] = true;
    }

    else if($_REQUEST['method'] === 'places') 
    {
        $query = "SELECT city, description, geolocation, name, originated, photo, type, website FROM places";
    	$result["data"] = getQuery($query);
    	$result["success"] = true;
    }

    else if($_REQUEST['method'] === 'feed') 
    {
        $queryPlaces = "SELECT city, description, geolocation, name, originated, photo, type, website FROM places";
    	$places = getQuery($queryPlaces);

    	$queryCities = "SELECT area, city, coat_of_arms, coordinates, country, currency, decimal_coords, elevation, name, population, woeid, website FROM cities";
    	$cities = getQuery($queryCities);

    	// id, url, title, content_html, date_published, attachments
    	$root_url = "http://example.com/";
    	$rss = [
    		"version" => "https://jsonfeed.org/version/1",
    		"title" => "Twin Cities RSS",
    		"home_page_url" => $root_url,
    		"items" => []
    	];

    	foreach ($cities as $v) {
    		$html = "<ul><li><strong>Population</strong> {$v['population']}</li>".
			    	"<li><strong>Area</strong> {$v['area']} km2</li>".
			        "<li><strong>Elevation</strong> {$v['elevation']} m</li>".
			        "<li><strong>Coordinates</strong> {$v['coordinates']}</li>".
			        "<li><strong>Currency</strong> {$v['currency']}</li></ul>";
    		$item = [
    			"id" => $v['city'],
    			"url" => $v['website'],
    			"title" => $v['name'].", ".$v["country"],
    			"content_html" => $html,
    			"date_published" => date(DATE_RFC2822),
    			"attachments" => []
    		];

    		array_push($rss['items'], $item);
    	}

    	foreach ($places as $v) {
    		$html = "<strong>{$v['type']}</strong>".
			    	"<p>{$v['description']}</p>".
			        "<small>{$v['geolocation']}</small>";
    		$item = [
    			"id" => $v['city'],
    			"url" => $v['website'],
    			"title" => $v['name'],
    			"content_html" => $html,
    			"date_published" => date(DATE_RFC2822),
    			"attachments" => []
    		];

    		array_push($rss['items'], $item);
    	}

    	$result = $rss;
    	$resultAsXML = true;
    }

}
else 
{
	$result["info"] = "Invalid request method, POST only";
}

if (!$resultAsXML) {
	header('Content-Type: application/json');
	header('Cache-Control: no-cache');
	echo json_encode($result, JSON_PRETTY_PRINT);
}
else {
	$str = json_encode($result);
	header('Content-Type: application/xml');
	echo convert_jsonfeed_to_rss($str);
}
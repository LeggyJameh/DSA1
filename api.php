<?php
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
$result = ["success" => false];
if($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if ($_REQUEST['method'] === 'cities') 
    {
    	$query = "SELECT * FROM cities";
    	$result["data"] = getQuery($query);
    	$result["success"] = true;
    }
    else if($_REQUEST['method'] === 'places') 
    {
        $query = "SELECT * FROM places";
    	$result["data"] = getQuery($query);
    	$result["success"] = true;
    }
}
else 
{
	$result["info"] = "Invalid request method, POST only";
}
header('Content-Type: application/json');
header('Cache-Control: no-cache');
echo json_encode($result, JSON_PRETTY_PRINT);
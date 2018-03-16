<?php
/* 
	This file is reserved for database functions that the cache uses.
*/

// Execute the given query and return any data it returns as an associative array
function executeQuery($query) {
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
	
	$result = $conn->query($query);
	
	for ($data = array (); $row = $result->fetch_assoc(); $data[] = $row);
		
	return $data;
}
?>
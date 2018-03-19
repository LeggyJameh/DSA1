<?php
/* 
	This file is reserved for database functions that the cache uses.
*/

// Execute the given query and return any data it returns as an associative array
function executeQuery($query) {
	$servername = Cache::$settings->DBConn->host;
	$username = Cache::$settings->DBConn->user;
	$password = Cache::$settings->DBConn->password;
	$dbname = Cache::$settings->DBConn->database;

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
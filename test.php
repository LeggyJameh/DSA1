<?php
	include_once 'cache.php';
	$cache = Cache::Instance();
	
	$pairs = Cache::getTwins(1);
	
	foreach ($pairs as $city)
	{
		print($city->Name);
	}
?>

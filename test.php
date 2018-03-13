<?php
	include_once 'cache.php';
	$cache = Cache::Instance();
	
	$url = Cache::getImageURLFromID(1);
	
	echo '<img src="'.$url.'">';
?>

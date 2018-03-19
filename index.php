<?php
	// Initialise the cache before going any further
	require_once ('cache.php');
	$cache = Cache::Instance();
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Twin Cities</title>
  </head>  
  <body>
	<!-- Main city selection pane off to the left -->
    <div class="citySelectPane">
		<div class="selectPaneTitle">Cities:</div>
		<div class="citySelectNav">
			<nav class="mainTabs">
				<ul>
					<?php
						// For each city...
						foreach(Cache::$cities as $city)
						{
							// If the city is a main city and not a pair...
							if ($city->Pair == '0')
							{
								// Add it to the main city selection list
								$currentCountry = Cache::getCountryFromID($city->CountryID);
								echo '<li data-maincity="'.$city->UID.'"><a href="javascript:">'.$city->Name.' / '.$currentCountry->Name_Short.'</a></li>';
							}
						}
					?>
				</ul>
			</nav>
		</div>
	</div>
	
	<!-- Main content -->
    <div class="content">
	
	<!-- Pairs navigation menu at the top -->
      <nav class="tabs">
		<div class="title">Pairs:</div>
        <ul id="pairList">
			<li><a href="javascript:">Select a city to the left to see pairs.</a></li>
        </ul>
		<img src="img/zoom-out-w.png" alt="enlarge-icon" class="enlarge" title="reset map">
      </nav>

	  <!-- Teh map :D -->
      <div id="map"></div>

	  <!-- Flickr images -->
      <div class="flickr0"></div>

	  <!-- Weather widget -->
      <div class="weather"></div>
      
    </div>
	
	<!-- RSS Feed, off to the right -->
	<div class="feedbar">
		<header>RSS Feed</header>
		<div class="feed"></div>
	</div>
	
	<!-- Script references -->
	<?php
		echo '<script src="'.Cache::$settings->scripts->jQuery.'"></script>';
		echo '<script async defer src="'.Cache::$settings->scripts->googleMap.'"></script>';
		echo '<script id="weatherwidget-io-js" src="'.Cache::$settings->scripts->weatherWidget.'"></script>';
	?>
    <script src="script.js"></script>
  </body>
</html>
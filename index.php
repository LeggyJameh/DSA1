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
      <div class="weather">
        <div class="openweathermap-widget" id="openweathermap-31602"><a class="weatherwidget-io" href="https://forecast7.com/en/51d67n4d91/pembroke/" data-label_1="PEMBROKE" data-label_2="WEATHER" data-days="5" data-theme="orange" data-icons="Climacons Animated">PEMBROKE WEATHER</a></div>
        <div class="openweathermap-widget" id="openweathermap-12833291"><a class="weatherwidget-io" href="https://forecast7.com/en/52d819d96/bergen/" data-label_1="BERGEN" data-label_2="WEATHER" data-days="5" data-theme="orange" data-icons="Climacons Animated">BERGEN WEATHER</a></div>
        <div class="openweathermap-widget" id="openweathermap-10645040"><a class="weatherwidget-io" href="https://forecast7.com/en/35d9314d48/pembroke/" data-label_1="PEMBROKE" data-label_2="WEATHER" data-days="5" data-theme="orange" data-icons="Climacons Animated">PEMBROKE WEATHER</a></div>
      </div>
      
    </div>
	
	<!-- RSS Feed, off to the right -->
	<div class="feedbar">
		<header>RSS Feed</header>
		<div class="feed"></div>
	</div>
	
	<!-- Script references -->
    <script>
      !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7v1ol30fETyVST2Tc9-bhwqDIhAmriUE&callback=initMap">
    </script>
    <script src="script.js"></script>
  </body>
</html>
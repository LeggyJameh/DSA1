<?php
	require_once ('cache.php');
	$cache = Cache::Instance();
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Twin Cities</title>
  </head>  
  <body>
    <div class="citySelectPane">
		<div class="selectPaneTitle">Cities:</div>
		<div id="citySelectNav">
			<nav>
				<ul>
					<?php
						$cache = Cache::Instance();
						
						foreach(Cache::$cities as $city)
						{
							if ($city->Pair == '0')
							{
								$currentCountry = Cache::getCountryFromID($city->CountryID);
								echo '<li name="changeCity" data-maincity="'.$city->UID.'"><a href="?city='.$city->UID.'">'.$city->Name.' / '.$currentCountry->Name_Short.'</a></li>';
							}
						}
					?>
				</ul>
			</nav>
		</div>
	</div>
    <div class="content">
      <nav class="tabs">
		<div class="title">Pairs:</div>
        <ul>
			<?php
				$countries = array();
				if (!empty($_GET['city'])) {
					$currentCityID = $_GET['city'];
					setcookie("cityID", $currentCityID, time()+3600);
					$cache = Cache::Instance();
					
					$cities = Cache::getTwins($currentCityID);
					$currentCity = Cache::getCityFromID($currentCityID);
					array_unshift($cities, $currentCity);
					
					foreach ($cities as $city)
					{
						$currentCountry = Cache::getCountryFromID($city->CountryID);
						array_push($countries, $currentCountry);
						echo '<li data-cityid="'.$city->UID.'"><a href="javascript:">'.$city->Name.' / '.$currentCountry->Name_Short.'</a></li>';
					}
				}
				else
				{
					$cities = [];
					echo '<li><a href="">Select a city to the left to see pairs.</a></li>';
				}
				array_unique($countries, SORT_REGULAR);
			?>
        </ul>
		<img src="img/zoom-out-w.png" alt="enlarge-icon" class="enlarge" title="reset map">
      </nav>

      <div id="map"></div>

      <div class="flickr0"></div>

      <div class="weather">
        <div class="openweathermap-widget" id="openweathermap-31602"><a class="weatherwidget-io" href="https://forecast7.com/en/51d67n4d91/pembroke/" data-label_1="PEMBROKE" data-label_2="WEATHER" data-days="5" data-theme="orange" data-icons="Climacons Animated">PEMBROKE WEATHER</a></div>
        <div class="openweathermap-widget" id="openweathermap-12833291"><a class="weatherwidget-io" href="https://forecast7.com/en/52d819d96/bergen/" data-label_1="BERGEN" data-label_2="WEATHER" data-days="5" data-theme="orange" data-icons="Climacons Animated">BERGEN WEATHER</a></div>
        <div class="openweathermap-widget" id="openweathermap-10645040"><a class="weatherwidget-io" href="https://forecast7.com/en/35d9314d48/pembroke/" data-label_1="PEMBROKE" data-label_2="WEATHER" data-days="5" data-theme="orange" data-icons="Climacons Animated">PEMBROKE WEATHER</a></div>
      </div>
      
    </div>
	<div class="feedbar">
		<header>RSS Feed</header>
		<div class="feed"></div>
	</div>
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
var markers = [], map, infowin, cities = [], places = [], countries = [], feedXML;
var loaded = 0;
var center = {lat: 48.8588377, lng: 2.2770202};

// Loads the currently required cities, places and countries from the server using AJAX
function loadFromCache()
{
	loadCitiesFromCache();
	loadPlacesFromCache();
	loadCountriesFromCache();
}

// Loads the cities from the server
function loadCitiesFromCache()
{
	$.post("api.php", {method:'cities'} , function(response) {
		var citiesList = response.data;
		citiesList.forEach(function(item) {
			var coords = item.Decimal_coords.split(',');
			cities.push({
				ID: item.UID,
				Area: item.Area,
				CoaURL: item.CoaURL,
				Coordinates: item.Coordinates,
				CountryID: item.CountryID,
				Elevation: item.Elevation,
				name: item.Name,
				Population: item.Population,
				woeid: item.woeid,
				Website: item.Website,
				flickr_id: item.flickr_id,
				lat: parseFloat(coords[0]),
				lng: parseFloat(coords[1]),
				cluster: 'main'
			});
		});
		finishedLoading();
	});
}

// Loads the places of interest from the server
function loadPlacesFromCache()
{
	$.post("api.php", {method:'places'} , function(response) {
		var placesList = response.data;
		placesList.forEach(function(item) {
			var coords = item.geolocation.split(',');
			places.push({
				ID: item.UID,
				CityID: item.CityID,
				description: item.description,
				name: item.name,
				originated: item.originated,
				ImageURL: item.ImageURL,
				type: item.type,
				website: item.website,
				lat: parseFloat(coords[0]),
				lng: parseFloat(coords[1]),
				cluster: item.CityID
			});
		});
		finishedLoading();
	});
}

// Loads the countries for the server
function loadCountriesFromCache()
{
	$.post("api.php", {method:'countries'} , function(response) {
		countries = response.data;
		finishedLoading();	
	});
}

// Function that is called when each AJAX loading procedure is finished
function finishedLoading()
{
	// If everything has loaded...
	if (loaded >= 2)
	{
		// Load the map with the new points.
		var placesList = places;
		cities.forEach(function(item) {
			placesList.push(item);
		});
		
		setMarkers(map, placesList);
	}
	else // If not everything has loaded, indicate that this one has.
	{
		loaded++;
	}
}

/* 	Initialise/reload the map. This loads the currently required objects from the server,
	and loads them into the markers list. It then pulls the rss feed
*/
function initMap() {
	loadFromCache();
	map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: center
	});

    map.addListener('zoom_changed', function() {
		var currentZoom = map.getZoom();
		if (currentZoom < 6) {
			infowin.close();
			displayFlickr(null);
			displayWeather(null);
			displayMarkers('main');
			setSelectedPairTab(null);
		}
	});

	infowin = new google.maps.InfoWindow({ content: "" });
  
	loadRSSFeed();
}

// Pull the contents of the rss feed, and then display it
function loadRSSFeed() {
	$.ajax({
    type: "POST",
    url: "api.php",
    data: {method:'feed'},
    dataType:"xml"
  })
  .then(function(data) {
    var $feed = $('.feed');
    $(data).find("item").each(function () {
      var el = $(this);
      var html = `
        <h3><a href="${el.find("link").text() || '#'}" target="_blank">${el.find("title").text()}</a></h3>
        <small>${el.find("pubDate").text()}</small>
        <article>${el.find("description").text()}</article>
      `;
      $feed.append(html);
    });

    $('.feedbar header').text($(data).find('title')[0].textContent);
  });  
}

// Setup the current markers. This includes both cities and places of interest, in different visible "clusters"
function setMarkers(map, places) {
	places.forEach(function(place) {
		var pos = {lat:place.lat, lng:place.lng};
		
		var mk = new google.maps.Marker({
		  position: pos,
		  map: map,
		  title: place.name
		});
		
		if(place.cluster == 'main') {
			mk.addListener('click', function(e) { 
			zoomCity(place.ID); 
		  });

			mk.addListener('mouseover', function(e) {
				infowin.setContent(setCityContent(place.ID));
			infowin.open(map, this);
			});
		}
		else {
			mk.addListener('click', function(e) {
				infowin.setContent(setPlaceContent(place.ID));
			infowin.open(map, this);
			});
		}

		mk.category = place.cluster;
		mk.setVisible(place.cluster == 'main');

		markers.push(mk);
  });
}

// Display the markers for the given "cluster"
function displayMarkers(category) {
	for (var i = 0; i < markers.length; i++)
	{   
		if (markers[i].category == category) {
			markers[i].setVisible(true);
		} 
		else 
		{
			markers[i].setVisible(false);
		}
	}
}

// Update the weather widget for the current city
function displayWeather(city) {
  if (city == null) {
    $('.openweathermap-widget').hide();
  }
  else {
    $(`#openweathermap-${city.woeid}`).show().siblings().hide();
  }
}

// Update the flickr widget for the current city
function displayFlickr(city) {
  var $flickrContainer = $('.flickr0');
  $flickrContainer.html('');

  if (city != null) {
    var placeid = city.flickr_id;
    var apikey = "ca370d51a054836007519a00ff4ce59e";
    var rootUrl = "https://api.flickr.com/services/rest/?method=";
    var apiPlacesUrl = `flickr.photos.search&api_key=${apikey}&place_id=${placeid}&format=json&nojsoncallback=1&per_page=20`;

    $.getJSON(rootUrl+apiPlacesUrl, function(list) {
      var photos = list.photos.photo;
      photos.forEach(p => {
        var apiPhotosUrl = `flickr.photos.getSizes&api_key=${apikey}&photo_id=${p.id}&format=json&nojsoncallback=1`;

        $.getJSON(rootUrl + apiPhotosUrl, function(json2) {
          var thumb = json2.sizes.size.find(s => s.label == "Thumbnail");
          $flickrContainer.append(`<img src="${thumb.source}" alt="${p.title}" title="${p.title}">`);
        });

      });
    });
  }
}    

// Produces the mouseover content window for cities
function setCityContent(cityID) {
	var city = cities.find(c => c.ID == cityID);
	var country = countries.find(c => c.UID == city.CountryID);
  return `<div class="city-info">
    <img src="img/${city['CoaURL']}" alt="${city.name} Coat of Arms" class="coa" />
    <section>
      <h2>${city.name} <small>${country.Name}</small></h2>
      <ul>
        <li><strong>Population</strong> ${city.Population}</li>
        <li><strong>Area</strong> ${city.Area} km2</li>
        <li><strong>Elevation</strong> ${city.Elevation} m</li>
        <li><strong>Coordinates</strong> ${city.Coordinates}</li>
        <li><strong>Currency</strong> ${country.Currency}</li>
        <li>
          <strong>Website</strong> 
          <a href="${city.Website}" target="_blank">${city.Website}</a>
        </li>
      </ul>
    </section>
  </div>
  `;   
}

// Produces the mouseover content window for places of interest
function setPlaceContent(id) {
	var place = places.find(c => c.ID == id);
  return `
  <div class="city-info">
    <img src="img/${place.ImageURL}" alt="${place.name}" class="photo" />
    <section>
      <h2>${place.name} <small>${place.type}</small></h2>
      <ul>
        <li>${place.description}</li>
        <li>
          <a href="${place.website}" target="_blank">Website</a>
        </li>
      </ul> 
    </section> 
  </div>`;  
}

// Default set up for the map
function zoomInit() {
  infowin.close();
  map.setZoom(4);
  map.setCenter(center);
  displayFlickr(null);
  displayWeather(null);
  displayMarkers('main');
  setSelectedPairTab(null);
}

// Zoom in to the selected city and display flickr, weather and markers for it
function zoomCity(cityID) {
  var city = cities.find(c => c.ID == cityID);
  if (typeof(city) != "undefined")
  {
	  var position = {lat: city.lat, lng: city.lng};
	  infowin.close();
	  var currentZoom = 12;
	  map.setZoom(currentZoom);
	  map.setCenter(position);
	  displayMarkers(cityID);
	  displayWeather(city);
	  displayFlickr(city);
	  setSelectedPairTab(city);
  }
}

// Make the selected pair element pretty!
function setSelectedPairTab(city) {
  if (!city) {
    $('nav.tabs li').removeClass('selected');
  }
  else {
    var $li = $(`nav.tabs li[data-cityid="${city.ID}"]`);
    $li.addClass('selected').siblings('li').removeClass('selected');
  }
}

// Make the selected main city element pretty!
function setSelectedMainTab(city)
{
	if (!city) {
		$('nav.mainTabs li').removeClass('selected');
	}
	else {
		var $li = $(`nav.mainTabs li[data-maincity="${city.ID}"]`);
		$li.addClass('selected').siblings('li').removeClass('selected');
	}
}

// Select the given city as the primary city
function selectMainCity(cityID)
{
	document.cookie = "cityID=" + cityID;
	initMap();
	var city = cities.find(c => c.ID == cityID);
	if (typeof city != "undefined") {
		setSelectedMainTab(city);
		generatePairNav();
	}
}

// Generate the html for the navigation panel for pairs
function generatePairNav() {
	var nav = $('#pairList');
	var html = "";
	cities.forEach(function(city) {
		var country = countries.find(c => c.UID == city.CountryID);
		html += '<li data-cityid="' + city.ID + '"><a href="javascript:">'+ city.name +' / ' + country.Name_Short + '</a></li>';
	});
	
	nav.html(html);
}

// Event handlers for button presses
$('nav.tabs .enlarge').on('click', zoomInit);

$('nav.tabs').delegate('li', 'click', function(e) {
    var $li = $(this);
    
    if (!$li.is('.selected')) {
      var cityID = $li.data('cityid');
      zoomCity(cityID);
    }
});

$('nav.mainTabs').delegate('li', 'click', function(e) {
	var $li = $(this);
	
	if (!$li.is('.selected')) {
		var cityID = $li.data('maincity');
		selectMainCity(cityID);
	}
});



var markers = [], map, infowin, citiesList = [], placesList = [];

var center = {lat: 48.8588377, lng: 2.2770202};

function loadCities()
{
	citiesList = [];
	if (typeof cities != 'undefined')
	{
		cities.forEach(function(item) {
			var coords = item.Decimal_coords.split(',');
			citiesList.push({
				id: item.UID,
				CountryID: item.CountryID,
				name: item.name,
				lat: parseFloat(coords[0]),
				lng: parseFloat(coords[1]),
				cluster: 'main'
			})
		});
	}
}

function initMap() {
	loadCities();
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: center
  });

  map.addListener('zoom_changed', function() {
    var currentZoom = map.getZoom();
    if (currentZoom < 6) {
      infowin.close();
      displayFlickr('hideAll');
      displayWeather('hideAll');
    	displayMarkers('main');
      setSelectedTab(null);
    }
  });


  infowin = new google.maps.InfoWindow({ content: "" });

 // get points of interest
  $.post("api.php", {method:'places'} , function(response) {
    placesList = response.data;
    var places = citiesList;
    placesList.forEach(function(item) {
    	var coords = item.geolocation.split(',');
    	places.push({
    		name: item.name,
    		cluster: item.CityID,
			id: item.UID,
    		lat: parseFloat(coords[0]),
    		lng: parseFloat(coords[1])
    	})
    });
	
    setMarkers(map, places);
  });

  $.post("api.php", {method:'cities'} , function(response) {
    citiesList = response.data;
  });  
}

function setMarkers(map, data) {
	for(var i in data) {
    var place = data[i];
  
    var pos = {lat:place.lat, lng:place.lng};
    
    var mk = new google.maps.Marker({
      position: pos,
      map: map,
      title: place.id
    });

    if(place.cluster == 'main') {
      mk.addListener('click', function(e) { 
        zoomCity(this.title, this.getPosition()); 
      });

	    mk.addListener('mouseover', function(e) {
	    	infowin.setContent(setCityContent(this.title));
        infowin.open(map, this);
	    });
    }
    else {
    	mk.addListener('click', function(e) {
	    	infowin.setContent(setPlaceContent(this.title));
        infowin.open(map, this);
	    });
    }

    mk.category = place.cluster;
    mk.setVisible(place.cluster == 'main');

    markers.push(mk);
  }
}


function displayMarkers(category) {
	for (var i = 0; i < markers.length; i++)
	{   
		if (markers[i].category === category) {
			markers[i].setVisible(true);
		} 
		else 
		{
			markers[i].setVisible(false);
		}
	}
}

function displayWeather(city) {
  if (city == null) {
    $('.openweathermap-widget').hide();
  }
  else {
    $(`#openweathermap-${city.woeid}`).show().siblings().hide();
  }
}

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

function setCityContent(cityID) {
	var city = cities.find(c => c.UID == cityID);
	var country = countries.find(c => c.UID == city.CountryID);
  return `<div class="city-info">
    <img src="img/${city['CoaURL']}" alt="${city.Name} Coat of Arms" class="coa" />
    <section>
      <h2>${city.Name} <small>${country.Name}</small></h2>
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

function setPlaceContent(id) {
	var place = placesList.find(c => c.UID == id);
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

function zoomInit() {
  infowin.close();
  map.setZoom(4);
  map.setCenter(center);
  displayFlickr(null);
  displayWeather(null);
  displayMarkers('main');
  setSelectedTab(null);
}

function zoomCity(cityID) {
  var city = cities.find(c => c.UID == cityID);
  var coords = city.Decimal_coords.split(',');
  var position = {lat: parseFloat(coords[0]), lng: parseFloat(coords[1])};
  infowin.close();
  var currentZoom = 12;
  map.setZoom(currentZoom);
  map.setCenter(position);
  displayMarkers(cityID);
  displayWeather(city);
  displayFlickr(city);
  setSelectedTab(city);
}

function setSelectedTab(city) {
  if (!city) {
    $('nav.tabs li').removeClass('selected');
  }
  else {
    var $li = $(`nav.tabs li[data-cityid="${city.UID}"]`);
    $li.addClass('selected').siblings('li').removeClass('selected');
  }
}

$('nav.tabs .enlarge').on('click', zoomInit);

$('nav.tabs').delegate('li', 'click', function(e) {
    var $li = $(this);
    
    if (!$li.is('.selected')) {
      var cityID = $li.data('cityid');
      var city = cities.find(c => c.UID == cityID);
      zoomCity(cityID);
    }
});


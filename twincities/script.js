var markers = [],
  map, 
  infowin,
  citiesJson,
  placesJson,
  feedXML;

var center = {lat: 48.8588377, lng: 2.2770202};
var cities = [
  {name: "Pembroke/UK", lat: 51.676111, lng: -4.915833, cluster:'main'},
  {name: "Bergen/DE", lat: 52.810278, lng: 9.961111, cluster:'main'}, 
  {name: "Pembroke/MT", lat: 35.926389, lng: 14.480833, cluster:'main'}
];

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: center
  });

  map.addListener('zoom_changed', function() {
    //infowindow.setContent('Zoom: ' + map.getZoom());
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
  //$.getJSON("data/places.json", {}, function(response) {
  $.post("api.php", {method:'places'} , function(response) {
    placesJson = response.data;
    var places = cities;
    placesJson.forEach(function(item) {
    	var coords = item.geolocation.split(',');
    	places.push({
    		name: item.name,
    		cluster: item.city,
    		lat: parseFloat(coords[0]),
    		lng: parseFloat(coords[1])
    	})
    });

    setMarkers(map, places);
  });

  $.post("api.php", {method:'cities'} , function(response) {
    citiesJson = response.data;
  });

  $.ajax({
    type: "POST",
    url: "api.php",
    data: {method:'feed'},
    dataType:"xml"
  })
  .then(function(data) {
    var $feed = $('.feed');
    $(data).find("item").each(function () { // or "item" or whatever suits your feed
      var el = $(this);
      var html = `
        <h3><a href="${el.find("link").text() || '#'}" target="_blank">${el.find("title").text()}</a></h3>
        <small>${el.find("pubDate").text()}</small>
        <article>${el.find("description").text()}</article>
      `;
      $feed.append(html);
    });

    $('.sidebar header').text($(data).find('title')[0].textContent);
  });

}

function setMarkers(map, data) {
	for(var i in data) {
    var place = data[i];
  
    var pos = {lat:place.lat, lng:place.lng};
    
    var mk = new google.maps.Marker({
      position: pos,
      map: map,
      title: place.name
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

function displayWeather(name) {
  if (name == 'hideAll') {
    $('.openweathermap-widget').hide();
  }
  else {
    var city = citiesJson.find(c => c.city == name);
    $(`#openweathermap-${city.woeid}`).show().siblings().hide();
  }
}

function displayFlickr(name) {
  var $flickrContainer = $('.flickr0');
  $flickrContainer.html('');

  if (name != 'hideAll') {
    var placeIds = {
      "Pembroke/UK": "ZIa1xkZQULySiSPLdA",
      "Bergen/DE": "qyw9WdNXUb1WY6c",
      "Pembroke/MT": "Xb438KZQUrxS60kmdA"
    };

    var placeid = placeIds[name];
    var apikey = "ca370d51a054836007519a00ff4ce59e";
    var rootUrl = "https://api.flickr.com/services/rest/?method=";
    var apiPlacesUrl = `flickr.photos.search&api_key=${apikey}&place_id=${placeid}&format=json&nojsoncallback=1&per_page=20`;

    $.getJSON(rootUrl+apiPlacesUrl, function(json) {
      var photos = json.photos.photo;
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

function setCityContent(name) {
  var city = citiesJson.find(c => c.city == name);
  return `
  <div class="city-info">
    <img src="img/coa/${city['coat_of_arms']}" alt="${city.name} Coat of Arms" class="coa" />
    <section>
      <h2>${city.name} <small>${city.country}</small></h2>
      <ul>
        <li><strong>Population</strong> ${city.population}</li>
        <li><strong>Area</strong> ${city.area} km2</li>
        <li><strong>Elevation</strong> ${city.elevation} m</li>
        <li><strong>Coordinates</strong> ${city.coordinates}</li>
        <li><strong>Currency</strong> ${city.currency}</li>
        <li>
          <strong>Website</strong> 
          <a href="${city.website}" target="_blank">${city.website}</a>
        </li>
      </ul>
    </section>
  </div>`;   
}

function setPlaceContent(name) {
	var place = placesJson.find(c => c.name == name);
  return `
  <div class="city-info">
    <img src="img/photos/${place['photo']}" alt="${place.name}" class="photo" />
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
  displayFlickr('hideAll');
  displayWeather('hideAll');
  displayMarkers('main');
  setSelectedTab(null);
}

function zoomCity(name, position) {
  infowin.close();
  var currentZoom = (name.indexOf('UK') != -1)? 12 : 14;
  map.setZoom(currentZoom);
  map.setCenter(position);
  displayMarkers(name);
  displayWeather(name);
  displayFlickr(name);
  setSelectedTab(name);
}

function setSelectedTab(name) {
  if (!name) {
    $('nav.tabs li').removeClass('selected');
  }
  else {
    var $li = $(`nav.tabs li[data-city="${name}"]`);
    $li.addClass('selected').siblings('li').removeClass('selected');
  }
}

$('nav.tabs .enlarge').on('click', zoomInit);

$('nav.tabs').delegate('li', 'click', function(e) {
    var $li = $(this);
    
    if (!$li.is('.selected')) {
      var cityName = $li.data('city');
      var city = cities.find(c => c.name == cityName);
      zoomCity(cityName, city);
    }
});


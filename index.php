<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Cities</title>
  </head>
  <body>
    
    <div class="content">
      <nav class="tabs">
        <img src="img/zoom-out-w.png" alt="enlarge-icon" class="enlarge" title="reset map">
        <ul>
            <li data-city="Pembroke/UK"><a href="javascript:">Pembroke, Wales</a></li>
            <li data-city="Bergen/DE"><a href="javascript:">Bergen, Germany</a></li>
            <li data-city="Pembroke/MT"><a href="javascript:">Pembroke, Malta</a></li>
        </ul>
      </nav>

      <div id="map"></div>

      <div class="flickr0"></div>

      <div class="weather">
        <div class="openweathermap-widget" id="openweathermap-31602"><a class="weatherwidget-io" href="https://forecast7.com/en/51d67n4d91/pembroke/" data-label_1="PEMBROKE" data-label_2="WEATHER" data-days="5" data-theme="orange" data-icons="Climacons Animated">PEMBROKE WEATHER</a></div>
        <div class="openweathermap-widget" id="openweathermap-12833291"><a class="weatherwidget-io" href="https://forecast7.com/en/52d819d96/bergen/" data-label_1="BERGEN" data-label_2="WEATHER" data-days="5" data-theme="orange" data-icons="Climacons Animated">BERGEN WEATHER</a></div>
        <div class="openweathermap-widget" id="openweathermap-10645040"><a class="weatherwidget-io" href="https://forecast7.com/en/35d9314d48/pembroke/" data-label_1="PEMBROKE" data-label_2="WEATHER" data-days="5" data-theme="orange" data-icons="Climacons Animated">PEMBROKE WEATHER</a></div>
      </div>
      
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
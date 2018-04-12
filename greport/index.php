<?php
?>

<html>
	<link rel="stylesheet" type="text/css" href="style.css">
	<head>
		<title>Twin Cities Group Report</title>
	</head>
	<body class="content">
		<h3>Twin Cities Group Report</h3>
		<div class="splitter-line"></div>
		<div class="content" style="font-weight:bold;">
			Database design &amp; implementation
		</div>
		<div class="content">
			The database was designed by first planning the tables and data
			that we needed on paper, this formed a rough schema that was then
			used to create the database tables. We filled out the data in the
			database by first laying it out in an Excel spreadsheet. We then
			imported the data into the database manually via phpMyAdmin.
		</div>
		<div class="content" style="font-weight:bold;">
			Use and Integration of external APIs
		</div>
		<div class="content">
			The map was made using the Google Maps API, for which we needed an
			API key. All displayed data for cities and places of interest is
			pulled from the database, into a local cache via AJAX. The weather
			widget was made using a free weather widget at http://weatherwidget.io
			that is then configured using a url from the database before being
			loaded into the page.
		</div>
		<div class="content" style="font-weight:bold;">
			XML configuration file &amp; schema
		</div>
		<div class="content">
			The xml configuration file includes connection information for the
			database (user, password, host & database) as well as the url’s to
			the used external API’s, and is valid against the included schema.
		</div>
		<div class="content" style="font-weight:bold;">
			RSS Feed
		</div>
		<div class="content">
			The RSS feed is the same data that is used to power the map API,
			but converted into JSON, so that we could then use a freely available
			php module to convert the JSON into an RSS feed.
		</div>
	</body>
</html>
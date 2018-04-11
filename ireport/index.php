<?php
?>

<html>
	<link rel="stylesheet" type="text/css" href="style.css">
	<head>
		<title>Twin Cities Individual Task</title>
	</head>
	<body class="content">
		<h3>Twin Cities Individual Task</h3>
		<h3>Refactor the data set using XML and XML-Schema</h3>
		<h3>Jamie Mills (16004255)</h3>
		<div class="splitter-line"></div>
		<div class="content">
			I first exported the entire database with all tables into an XML file.
			This file is not formatted correctly for what we want, so I then
			went about formatting it correctly. Referencing
			https://www.w3schools.com/xml/schema_intro.asp for assistance.
		</div>
		<a href="phpMyAdminExport.xsd" class="link">Original export from PHPMyAdmin</a>
		<div class="content">
			The next thing I did was create the schema for the data.
			This involved taking each table as a complex element that is a
			sequence, making each record a complex element as part of that
			sequence, and then defining a sequence of simple elements that
			would make up the columns for each table. Each record element
			also needed the attribute maxOccurs="unbounded" in order to allow
			multiple entries.
		</div>
		<div class="content">
			The final thing was to painstakingly take the data that was originally
			exported, and format it so it abided by the constraints set out by the
			schema. I did this manually.
		</div>
		<table class="content">
			<tr>
				<td style="width:50%">
					<a href="../XML_DB_Dump/db_schema.xsd" class="link">Final Schema</a>
				</td>
				<td style="width:50%">
					<a href="../XML_DB_Dump/db_dump.xml" class="link">Final Data</a>
				</td>
			</tr>
		</table>
	</body>
</html>
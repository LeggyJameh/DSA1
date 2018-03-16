<?php
	header('Content-Type: text/plain');
	$schemaFile = simplexml_load_file("Schema.xsd");
?>

<html>
	<head>
		<title>Twin Cities Data Schema</title>
	</head>
	<body>
		<div>
			<?php
				echo $schemaFile->asXML();
			?>
		</div>
	</body>
</html>
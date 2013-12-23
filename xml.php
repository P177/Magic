<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Magic-live.cz - Nejlépe rozdané karty na webu</title>
</head>
<body>
<?php
$tornaments = simplexml_load_file("http://herna.najada.cz/xml/tournaments/");
foreach ($tornaments as $tornament){
	echo "<p>";
	echo $tornament->id."<br>";
	echo $tornament->date."<br>";
	echo $tornament->title."<br>";
	echo $tornament->format."<br>";
	echo $tornament->registration."<br>";
	echo $tornament->start."<br>";
	echo $tornament->fee."<br>";
	echo $tornament->prices."<br>";
	echo "</p>";
}
?>
</body>
</html>
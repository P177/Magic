<?php
if ($ar2['category_shows'] == 1){
	echo "<br><span class=\"odkazy_nadpis\">"; $category_name = explode ("]", $ar2['category_name']); if ($category_name[1] != ""){echo $category_name[1];} else {echo $category_name[0];} echo "</span><br>";
}
while ($ar = mysql_fetch_array($res)){
	$links_name_array = explode ("]", $ar['links_name']);
	if ($links_name_array[1] != ""){$links_name = $links_name_array[1];} else {$links_name = $links_name_array[0];}
	echo "<strong>".$links_name."</strong> - <a href=\"http://".$ar['links_link']."\" target=\"_blank\">".$ar['links_link']."</a><br>";
	if ($ar['links_description'] != ""){
		echo $ar['links_description'];
		echo "<br>";
	}
}
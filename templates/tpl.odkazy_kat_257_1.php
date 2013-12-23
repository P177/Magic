<?php
	if ($ar2['category_shows'] == 1){
		echo "<br><span class=\"odkazy_nadpis\">"; $category_name = explode (']', $ar2['category_name']); if ($category_name[1] != ""){echo $category_name[1];} else {echo $category_name[0];} echo "</span><br>";
	}
	echo "<table width=\"586\" height=\"75\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\">";
	$cislo = 1;
	while ($ar = mysql_fetch_array($res)){
		$links_name_array = explode (']', $ar['links_name']);
		if ($links_name_array[1] != ""){$links_name = $links_name_array[1];} else {$links_name = $links_name_array[0];}
		echo "<tr"; if ($cislo % 2 == 0){echo " class=\"suda\"";} else {echo " class=\"licha\"";} echo ">";
		echo "		<td rowspan=\"2\" width=\"175\" valign=\"top\"><a href=\"http://".$ar['links_link']."\" target=\"_blank\"><img src=\"".$url_links.$ar['links_picture2']."\" width=\"175\" height=\"60\"></a></td>";
		echo "		<td width=\"411\" height=\"30\" valign=\"top\"><strong>".$links_name."</strong><br><a href=\"http://".$ar['links_link']."\" target=\"_blank\">".$ar['links_link']."</a></td>";
		echo "	</tr>";
		echo "	<tr"; if ($cislo % 2 == 0){echo " class=\"suda\"";} else {echo " class=\"licha\"";} echo ">";
		echo "		<td width=\"411\" height=\"30\" valign=\"top\">".$ar['links_description']."</td>";
		echo "	</tr>";
		$cislo++;
	}
echo "</table>";
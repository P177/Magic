<?php
if ($links_gfx == 1 && $links_main == 0){
	echo "<img vspace=\"10\" src=\"".$url_links.$links_picture."" border=\"0\" alt=\"".$links_link."\"><br>";
}elseif ($links_gfx == 0 && $links_main == 1) {
	echo "<div align=\"left\"><a href=\"eden_jump.php?id=".$links_id."&amp;project=".$project."\" target=\"_blank\">"; $name = explode ("]", $links_name); if ($name[1] != ""){echo $name[1];} else {echo $name[0];} echo "</a></div><br>";
} else {
	echo "<a href=\"".$eden_cfg['url_edencms']."eden_jump.php?id=".$links_id."&amp;project=".$project."\" target=\"_blank\">";
	if ($links_gfx == 1){
		echo "<img vspace=\"10\" src=\"".$url_links.$links_picture."\" border=\"0\" alt=\"".$links_link."\">";
	} else {
		$name = explode ("]", $links_name); 
		if ($name[1] != ""){
			echo $name[1];
		} else {
			echo $name[0];
		}
	}
	echo "</a>";
	if ($i>0){
		echo "<br><br>";
	}
	echo "<br>";
}
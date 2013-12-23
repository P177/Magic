<?php /*ř*/ 
echo "<div style=\"margin-left:0px;\" "; if ($ar['adds_link_onclick'] != ""){ echo "onclick=\"window.open('".$ar['adds_link_onclick']."','_blank')\"";} echo ">";
if ($ar['adds_gfx'] == 1){
	$extenze = substr($ar['adds_picture'], -3);
	if ($extenze != "swf"){
		echo "<a href=\"".$eden_cfg['url_edencms']."eden_jump.php?id=".$ar['adds_id']."&amp;project=".$project."&amp;jump_mode=".$jump_mode."\" target=\"_blank\"><img src=\"".$url_adds.$ar['adds_picture']."\" border=\"0\" alt=\"".$ar['adds_link']."\"></a>";
	} else {
		echo "<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" width=\"251\" height=\"250\" id=\"251x250\" align=\"middle\">\n";
		echo "	<param name=\"movie\" value=\"".$url_adds.$ar['adds_picture'].$ar['adds_link']."\" />\n";
		echo "	<param name=\"quality\" value=\"high\" />\n";
		echo "	<param name=\"bgcolor\" value=\"#ffffff\" />\n";
		echo "	<param name=\"play\" value=\"true\" />\n";
		echo "	<param name=\"loop\" value=\"true\" />\n";
		echo "	<param name=\"wmode\" value=\"window\" />\n";
		echo "	<param name=\"scale\" value=\"showall\" />\n";
		echo "	<param name=\"menu\" value=\"true\" />\n";
		echo "	<param name=\"devicefont\" value=\"false\" />\n";
		echo "	<param name=\"salign\" value=\"\" />\n";
		echo "	<param name=\"allowScriptAccess\" value=\"sameDomain\" />\n";
		echo "	<!--[if !IE]>-->\n";
		echo "	<object type=\"application/x-shockwave-flash\" data=\"".$url_adds.$ar['adds_picture']."\" width=\"251\" height=\"250\">\n";
		echo "		<param name=\"movie\" value=\"".$url_adds.$ar['adds_picture'].$ar['adds_link']."\" />\n";
		echo "		<param name=\"quality\" value=\"high\" />\n";
		echo "		<param name=\"bgcolor\" value=\"#ffffff\" />\n";
		echo "		<param name=\"play\" value=\"true\" />\n";
		echo "		<param name=\"loop\" value=\"true\" />\n";
		echo "		<param name=\"wmode\" value=\"window\" />\n";
		echo "		<param name=\"scale\" value=\"showall\" />\n";
		echo "		<param name=\"menu\" value=\"true\" />\n";
		echo "		<param name=\"devicefont\" value=\"false\" />\n";
		echo "		<param name=\"salign\" value=\"\" />\n";
		echo "		<param name=\"allowScriptAccess\" value=\"sameDomain\" />\n";
		echo "	<!--<![endif]-->\n";
		echo "		<a href=\"http://www.adobe.com/go/getflash\">\n";
		echo "			<img src=\"http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif\" alt=\"Get Adobe Flash player\" />\n";
		echo "		</a>\n";
		echo "	<!--[if !IE]>-->\n";
		echo "	</object>\n";
		echo "	<!--<![endif]-->\n";
		echo "</object>";
	}
} else { 
	echo "<a href=\"".$eden_cfg['url_edencms']."eden_jump.php?id=".$ar['adds_id']."&amp;project=".$project."&amp;jump_mode=".$jump_mode."\" target=\"_blank\">".$ar['adds_name']."</a>";
}
echo "</div>";
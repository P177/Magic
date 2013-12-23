<?php 
if ($ar['adds_gfx'] == 1){
	echo "<div "; if ($ar['adds_link_onclick'] != ""){ echo "onclick=\"window.open('".$ar['adds_link_onclick']."')\"";} echo " align=\"center\">";
	$extenze = substr($ar['adds_picture'], -3);
	if ($extenze != "swf"){
		echo "<a href=\"".$eden_cfg['url_edencms']."eden_jump.php?id=".$ar['adds_id']."&amp;project=".$project."&amp;jump_mode=".$jump_mode."\" target=\"_new\"><img src=\"".$url_adds.$ar['adds_picture']."\" border=\"0\" alt=\"".$ar['adds_link']."\"></a>";
	} else {
		echo "<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" width=\"468\" height=\"60\" id=\"".$ar['adds_name']."\" align=\"middle\">\n";
		echo "	<param name=\"movie\" value=\"".$url_adds.$ar['adds_picture'].$ar['adds_link']."\"/>\n";
		echo "	<!--[if !IE]>-->\n";
		echo "		<object type=\"application/x-shockwave-flash\" data=\"".$url_adds.$ar['adds_picture'].$ar['adds_link']."\" width=\"468\" height=\"60\">\n";
		echo "			<param name=\"movie\" value=\"".$url_adds.$ar['adds_picture'].$ar['adds_link']."\"/>\n";
		echo "			<param name=\"allowScriptAccess\" value=\"sameDomain\">\n";
		echo "			<param name=\"menu\" value=\"false\">\n";
		echo "			<param name=\"quality\" value=\"high\">\n";
		echo "			<param name=\"wmode\" value=\"opaque\">\n";
		echo "			<param name=\"loop\" value=\"true\">\n";
		echo "	<!--<![endif]-->\n";
		echo "			<p>"._MSG_FLASH_NO_FLASH."</p>\n";
		echo "	<!--[if !IE]>-->\n";
		echo "		</object>\n";
		echo "	<!--<![endif]-->\n";
		echo "</object>";
	}
	echo "</div>\n";
}

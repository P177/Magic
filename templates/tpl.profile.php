<?php
echo "<h2><img src=\"".$url_flags."/".$ar_profile['country_shortname'].".gif\" alt=\"".$ar_profile['country_name']."\" title=\"".$ar_profile['country_name']."\" width=\"18\" height=\"12\" border=\"0\"> ".$ar_profile['profile_firstname']." ".$ar_profile['profile_surname']."</h2>";
if ($ar_profile['profile_image_1'] != ""){
	echo "<img src=\"".$url_profiles.$ar_profile['profile_image_1']."\" width=\"".GetSetupImageInfo("profile","width")."\" height=\"".GetSetupImageInfo("profile","height")."\" style=\"margin:5px 5px 0px 10px;\" alt=\"".stripslashes($ar_profile['profile_nickname'])."\">";
}
if ($ar_profile['profile_nickname'] != ""){
	echo "<br><strong>Nick:</strong> ".stripslashes($ar_profile['profile_nickname']);
}
if ($ar_profile['profile_windfalls'] != ""){
	echo "<br><strong>Výhry:</strong> ".stripslashes($ar_profile['profile_windfalls']);
}
//if ($ar_profile['profile_birth'] != "0000-00-00"){echo "<br><strong>Narozen:</strong> ".FormatDate($ar_profile['profile_birth'],"d.m.Y");}
if ($ar_profile['profile_info'] != ""){
	echo "<br><strong>Popis:</strong> ".stripslashes($ar_profile['profile_info']);
}
if ($ar_profile['profile_article_id'] != 0){
	echo "<br><a href=\"http://www.magic-live.cz/index.php?action=clanek&amp;id=".$ar_profile['profile_article_id']."\" target=\"_blank\">Hráčův profil</a>";
}

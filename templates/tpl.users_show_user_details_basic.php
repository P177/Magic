<?php
	echo "	<div id=\"eden_league_player_personal_1\">";
	echo "		<div style=\"width:21px;height:30px;float:left;vertical-align:bottom;\"><img src=\""._URL_FLAGS.$ar_country['country_shortname'].".gif\" width=\"18\" height=\"12\" style=\"margin-top:2px;\" alt=\"".stripslashes($ar_country['country_shortname'])."\" title=\"".stripslashes($ar_country['country_shortname'])."\"></div><div style=\"width:179px;height:30px;float:left;\"><h2 style=\"margin:0px 0px 0px 0px;\">".stripslashes($ar['admin_nick'])."</h2></div>";
	echo "		<div style=\"width:175px;text-align:center\"><img src=\""._URL_ADMINS.$ar['admin_userimage']."\" class=\"eden_personality_menu_img\" alt=\"".stripslashes($ar['admin_nick'])."\"></div>";
	echo "	</div>";
	echo "	<div id=\"eden_league_player_personal_2\">";
	echo "		<table id=\"eden_league_player_personal_profile\" cellpadding=\"3\" cellspacing=\"2\" border=\"0\">";
	echo "			<tr>";
	echo "				<td><h3>Profil</h3></td>";
	echo "				<td>&nbsp;</td>";
	echo "			</tr>";
	$player_data = array(
		array ("ID",$ar['admin_id']),
   		array ("Nick",stripslashes($ar['admin_nick'])),
		array ("Team",$team_name),
		array ("Země",stripslashes($ar['country_name'])),
		array ("ICQ",stripslashes($ar['admin_contact_icq'])),
		array ("Xfire",stripslashes($ar['admin_contact_xfire'])),
		array ("MSN",stripslashes($ar['admin_contact_msn'])),
		array ("Skype",stripslashes($ar['admin_contact_skype'])),
		array ("Narozeniny",$birthday),
		array ("Účet založen",$reg_date),
	);
	$player_data_num = count($player_data);
	$i=0;
	while ($player_data_num > $i){
		if (!empty($player_data[$i][1])){
			if ($i % 2 == 0){$td_class = "eden_league_player_personal_names_odd";} else {$td_class =  "eden_league_player_personal_names_even";}
			echo " 	<tr>";
			echo " 		<td class=\"".$td_class."\">".$player_data[$i][0]."</td>";
			echo "		<td class=\"".$td_class."\">".$player_data[$i][1]."</td>";
			echo "	</tr>";
		}
		$i++;
	}
	if ($ar['admin_poker_fav_player'] != ""){
		echo "		<tr>";
		echo "			<td colspan=\"2\">&nbsp;</td>";
		echo "		</tr>";
		echo "		<tr>";
		echo "			<td colspan=\"2\"><h3>Oblíbený hráč</h3></td>";
		echo "		</tr>";
		echo "		<tr>";
		echo "			<td class=\"eden_league_player_personal_names_odd\">&nbsp;</td>";
		echo "			<td class=\"eden_league_player_personal_datas_odd\">".stripslashes($ar['admin_poker_fav_player'])."</td>";
		echo "		</tr>";
	}
	echo "			</table>";
   	echo "		</div>";
	echo "		<div id=\"eden_league_player_personal_comm\">";
	echo "			<a href=\"index.php?action=forum&faction=pm&&pm_user=".$_SESSION['loginid']."&pm_rec=".$id."&lang=".$_GET['lang']."&filter=".$_GET['filter']."\" target=\"_self\"><img src=\"./images/sys_message.gif\" width=\"15\" height=\"10\" alt=\""._CMN_PM_SEND_PM."\" title=\""._CMN_PM_SEND_PM."\"> "._CMN_PM_SEND_PM."</a>";
	echo "		</div>";


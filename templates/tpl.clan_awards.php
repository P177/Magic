<?php
echo '<table height="120" cellspacing="0" cellpadding="0" width="600" border="0">';
	for ($i=date("Y");$i>=FormatDatetime($ar_setup['setup_basic_date'],"Y");$i--){
		$res_award_num = mysql_query("SELECT COUNT(*) FROM $db_clan_awards WHERE clan_award_date BETWEEN '".(integer)$i."-01-01 00:00:00' AND '".(integer)$i."-12-31 23:59:59'") or die ("<strong>"._ERROR."</strong> ".mysql_error());
		$ar_award_num = mysql_fetch_array($res_award_num);
		if ($ar_award_num[0] > 0){?>
			<tr>
				<td width="600" colspan="5"><h1><?php echo $i;?></h1></td>
			</tr><?php
		}else{}
		$where = "WHERE clan_award_date BETWEEN '".(integer)$i."-01-01 00:00:00' AND '".(integer)$i."-12-31 23:59:59'";
		$res_award = mysql_query("SELECT * FROM $db_clan_awards $where ORDER BY clan_award_date DESC") or die ("<strong>"._ERROR."</strong> ".mysql_error());
		while ($ar_award = mysql_fetch_array($res_award)){
			$res_game = mysql_query("SELECT clan_games_id, clan_games_game, clan_games_shortname FROM $db_clan_games WHERE clan_games_id=".$ar_award['clan_award_game_id']) or die ("<strong>"._ERROR."</strong> ".mysql_error());
			$ar_game = mysql_fetch_array($res_game);
			$res_flag = mysql_query("SELECT country_shortname FROM $db_country WHERE country_id=".$ar_award['clan_award_country_id']) or die ("<strong>"._ERROR."</strong> ".mysql_error());
			$ar_flag = mysql_fetch_array($res_flag);?>
			<tr>
				<td width="20" height="15" valign="top"><img src="<?php echo $url_clan_awards.$ar_award['clan_award_place'].'.gif';?>" width="16" height="13" alt="<?php echo $ar_award['clan_award_place'].ClanAwardsPlaceExt($ar_award['clan_award_place']);?>"></td>
				<td width="50" height="15" valign="top"><?php echo FormatDatetime($ar_award['clan_award_date'],"d.m.Y");?></td>
				<td width="200" height="15" valign="top"><img src="<?php echo $url_calendar_groups.$ar_game['clan_games_shortname'].'.gif';?>"> <?php echo $ar_game['clan_games_game'];?></td>
				<td width="50" height="15" valign="top"><?php echo $ar_award['clan_award_place'].ClanAwardsPlaceExt($ar_award['clan_award_place']);?></td>
				<td align="left" height="15" valign="top"><img src="<?php echo $url_flags.$ar_flag['country_shortname'].'.gif';?>" width="18" height="12"> <a href="<?php echo $ar_award['clan_award_link'];?>" target="_blank"><?php echo $ar_award['clan_award_name'];?></a></td>
			</tr><?php
		}
	}
echo '</table>';
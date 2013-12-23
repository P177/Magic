<?php
echo "<table cellspacing=\"0\" cellpadding=\"4\">\n";
echo "	<tr>\n";
echo "		<td align=\"left\" valign=\"top\">\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td align=\"right\" valign=\"middle\">&nbsp;</td>\n";
echo "		<td align=\"left\" valign=\"top\"><h2>"._ADMIN_INFO_BASIC."</h2></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td align=\"right\" valign=\"top\"><strong>"._ADMIN_NICK."</strong></td>\n";
echo "		<td align=\"left\" valign=\"top\"><h3 style=\"color: ff0000;\">".$ar['admin_nick']."</h3></td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td align=\"right\" valign=\"middle\"><strong>"._ADMIN_FIRSTNAME."</strong></td>\n";
echo "		<td align=\"left\" valign=\"top\">".$ar['admin_firstname']."</td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td align=\"right\" valign=\"middle\"><strong>"._ADMIN_NAME."</strong></td>\n";
echo "		<td align=\"left\" valign=\"top\">".$ar['admin_name']."</td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td align=\"right\" valign=\"middle\"><strong>"._ADMIN_CONTACT_COUNTRY."</strong></td>\n";
echo "		<td align=\"left\" valign=\"top\">\n";
	  		$res2 = mysql_query("SELECT country_shortname FROM $db_country WHERE country_id=".(float)$ar['admin_contact_country']) or die ("<strong>"._ERROR." 5</strong> ".mysql_error());
			$ar2 = mysql_fetch_array($res2);
			if ($ar['admin_contact_country'] == 0){$shortname = "00";} else {$shortname = $ar2['country_shortname'];}
echo "			<img src=\"".$url_flags.$ar2['country_shortname'].".gif\" width=\"18\" height=\"12\" alt=\""; if ($ar['country'] == 0){$alt = "No Selected";} else {echo NazevVlajky($ar2['country_shortname'],AGet($_GET,'lang'));} echo "\">\n";
echo "		</td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td align=\"right\" valign=\"middle\">&nbsp;</td>\n";
echo "		<td align=\"left\" valign=\"top\"><h2>"._ADMIN_INFO_CONTACT."</h2></td>\n";
echo "	</tr>\n";
if($ar['admin_contact_icq'] != ""){
	echo "	<tr>\n";
	echo "		<td align=\"right\" valign=\"middle\"><strong>"._ADMIN_ICQ."</strong></td>\n";
	echo "		<td align=\"left\" valign=\"top\">".$ar['admin_contact_icq']."</td>\n";
	echo "	</tr>\n";
}
if($ar['admin_contact_msn'] != ""){
	echo "	<tr>\n";
	echo "		<td align=\"right\" valign=\"middle\"><strong>"._ADMIN_MSN."</strong></td>\n";
	echo "		<td align=\"left\" valign=\"top\">".$ar['admin_contact_msn']."</td>\n";
	echo "	</tr>\n";
}
if($ar['admin_contact_skype'] != ""){
	echo "	<tr>\n";
	echo "		<td align=\"right\" valign=\"middle\"><strong>"._ADMIN_SKYPE."</strong></td>\n";
	echo "		<td align=\"left\" valign=\"top\">".$ar['admin_contact_skype']."</td>\n";
	echo "	</tr>\n";
}
if($ar['admin_contact_xfire'] != ""){
	echo "	<tr>\n";
	echo "		<td align=\"right\" valign=\"middle\"><strong>"._ADMIN_XFIRE."</strong></td>\n";
	echo "		<td align=\"left\" valign=\"top\">".$ar['admin_contact_xfire']."</td>\n";
	echo "	</tr>\n";
}
if ($ar['admin_contact_web'] != ""){
	echo "	<tr>\n";
	echo "		<td align=\"right\" valign=\"middle\"><strong>"._ADMIN_WEB." 1</strong></td>\n";
	echo "		<td align=\"left\" valign=\"top\"><a href=\"http://".$ar['admin_contact_web']."\" target=\"_BLANK\">".$ar['admin_contact_web']."</a></td>\n";
	echo "	</tr>\n";
}
if ($ar['admin_contact_web'] != ""){
	echo "	<tr>\n";
	echo "		<td align=\"right\" valign=\"middle\"><strong>"._ADMIN_WEB." 2</strong></td>\n";
	echo "		<td align=\"left\" valign=\"top\"><a href=\"http://".$ar['admin_contact_web2']."\" target=\"_BLANK\">".$ar['admin_contact_web2']."</a></td>\n";
	echo "	</tr>\n";
}
if ($ar['admin_contact_web'] != ""){
	echo "	<tr>\n";
	echo "		<td align=\"right\" valign=\"middle\"><strong>"._ADMIN_WEB." 3</strong></td>\n";
	echo "		<td align=\"left\" valign=\"top\"><a href=\"http://".$ar['admin_contact_web3']."\" target=\"_BLANK\">".$ar['admin_contact_web3']."</a></td>\n";
	echo "	</tr>\n";
}
if ($ar['admin_contact_web'] != ""){
	echo "	<tr>\n";
	echo "		<td align=\"right\" valign=\"middle\"><strong>"._ADMIN_WEB." 4</strong></td>\n";
	echo "		<td align=\"left\" valign=\"top\"><a href=\"http://".$ar['admin_contact_web4']."\" target=\"_BLANK\">".$ar['admin_contact_web4']."</a></td>\n";
	echo "	</tr>\n";
}
echo "	<tr>\n";
echo "		<td align=\"right\" valign=\"top\"><strong>"._ADMIN_USERINFO."</strong></td>\n";
echo "		<td align=\"left\" valign=\"top\">".$ar['admin_userinfo']."</td>\n";
echo "	</tr>\n";
echo "</table>";
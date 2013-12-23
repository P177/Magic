<?php  
if ($_GET['team_detail'] == "open" && $admin_id == $_GET['id_clena'] && $_GET['open_cat'] == $category){?>
<tr>
	<td colspan="5">
		<table width="574" cellspacing="0" cellpadding="2" border="0">
			<tr>
				<td colspan="4"><h3>Personal Details</h3></td>
			</tr>
			<tr class="suda">
				<td rowspan="7" width="200px"><a name="<?php echo $admin_id;?>"></a><img src="<?php echo $url_admins.$admin_userimage2;?>" width="195" height="195"  alt="" border="0"></td>
				<td width="95px"><span class="atc_09">Nickname:</span></td>
				<td width="200px"><h2><?php echo $admin_nick;?></h2></td>
				<td><a href="?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=<?php echo AGet($_GET,'action');?>&team_detail=close&id_clena=<?php echo $admin_id;?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo _CLOSE;?></a></td>
			</tr>
			<tr>
				<td><span class="atc_09">Name:</span></td>
				<td colspan="2"><?php echo $admin_firstname.' '.$admin_name;?></td>
			</tr>
			<tr class="suda">
				<td><span class="atc_09">Country:</span></td>
				<td colspan="2"><img src="<?php echo $url_flags.$country_shortname;?>.gif" width="18" height="12" id="admin_team_country_img" alt="<?php  if ($admin_contact_country == 0){$alt = "No Selected";} else {echo NazevVlajky($country_shortname,AGet($_GET,'lang'));};?>"></td>
			</tr>
			<tr>
				<td><span class="atc_09">City:</span></td>
				<td colspan="2"><?php echo $admin_contact_city;?></td>
			</tr>
			<tr class="suda">
				<td><span class="atc_09">Email:</span></td>
				<td colspan="2"><a href="mailto:<?php echo TransToASCII($admin_email);?>"><img src="images/sys_message.gif" width="15" height="10" alt="email"></a></td>
			</tr>
			<tr>
				<td><span class="atc_09">ICQ:</span></td>
				<td colspan="2"><?php echo $admin_contact_icq;?></td>
			</tr>
			<tr class="suda">
				<td><span class="atc_09">Date of birth:</span></td>
				<td colspan="2"><?php echo $admin_day_of_birth;?></td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="5">
		<table width="574" cellspacing="0" cellpadding="2" border="0">
			<tr>
				<td colspan="2"><h3>Hardware</h3></td>
			</tr>
			<tr>
				<td width="150px"><span class="atc_08">CPU:</span></td>
				<td><?php echo $admin_hw_cpu;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Motherboard:</span></td>
				<td ><?php echo $admin_hw_mb;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Videocard:</span></td>
				<td ><?php echo $admin_hw_vga;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Memory:</span></td>
				<td ><?php echo $admin_hw_ram;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Harddisk:</span></td>		
				<td ><?php echo $admin_hw_hdd;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">CD/DVD:</span></td>
				<td ><?php echo $admin_hw_cd;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Sound:</span></td>
				<td ><?php echo $admin_hw_soundcard;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Monitor:</span></td>
				<td ><?php echo $admin_hw_monitor;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Mouse:</span></td>
				<td ><?php echo $admin_hw_mouse;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Mousepad:</span></td>
				<td ><?php echo $admin_hw_mousepad;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Headset:</span></td>
				<td ><?php echo $admin_hw_headset;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Keyboard:</span></td>
				<td ><?php echo $admin_hw_key;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Gamepad:</span></td>
				<td ><?php echo $admin_hw_gamepad;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Connection:</span></td>
				<td ><?php echo $admin_hw_conection;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Operating system:</span></td>
				<td valign="top"><?php echo $admin_hw_os;?></td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="5">
		<table width="574" cellspacing="0" cellpadding="2" border="0">
			<tr>
				<td colspan="2"><h3>Game Settings</h3></td>
			</tr>
			<tr>
				<td width="150px"><span class="atc_08">Resolution:</span></td>
				<td><?php echo $admin_game_resolution;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Mouse Sensitivity:</span></td>
				<td ><?php echo $admin_game_mouse_sens;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Mouse Acceleration:</span></td>
				<td ><?php echo $admin_game_mouse_accel;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Invert Mouse:</span></td>
				<td ><?php echo $admin_game_mouse_invert;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Favorite Weapon:</span></td>		
				<td ><?php echo $admin_game_fav_weapon;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Favorite Team:</span></td>
				<td ><?php echo $admin_game_fav_team;?></td>
			</tr>
			<tr>
				<td><span class="atc_08">Favorite Map:</span><br><br><br></td>
				<td  valign="top"><?php echo $admin_game_fav_map;?></td>
			</tr>
		</table>
		<?php GuestBookAdmin($admin_id,564,$align="center");?>
	</td>
</tr><?php  
} else {?>
	<tr <?php if ($i % 2 == 0){echo 'class="suda"';}?>>
		<td id="eden_atc_02"><img src="<?php echo $url_flags.$country_shortname;?>.gif" width="18" height="12" alt="<?php  if ($admin_contact_country == 0){$alt = "No Selected";} else {echo NazevVlajky($country_shortname,AGet($_GET,'lang'));};?>">&nbsp;<?php if ($category == 1){ echo $admin_firstname.' <strong>"'.$admin_nick.'"</strong> '.$admin_name;} else { echo "<strong>".$admin_nick."</strong>";}?></td>
		<td id="eden_atc_03">&nbsp;<?php echo $admin_player_status;?></td>
		<td id="eden_atc_04"><a href="mailto:<?php echo  TransToASCII($admin_email);?>"><img src="images/sys_message.gif" width="15" height="10" alt="email" title="email"></a></td>
		<td id="eden_atc_05">ICQ: <?php echo $admin_contact_icq;?></td>
		<td id="eden_atc_06"><a href="?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=<?php echo AGet($_GET,'action');?>&team_detail=<?php  if ($_GET['team_detail'] == "open" && $admin_id == $_GET['id_clena']){echo "close";} else {echo "open";}?>&id_clena=<?php echo $admin_id;?>&open_cat=<?php echo $category;?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>#<?php echo $admin_id;?>"><?php echo _DETAILS;?></a></td>
	</tr><?php  
}?>
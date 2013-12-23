<tr  <?php  if ($pritel == "TRUE"){?>bgcolor="#D9D9D9"<?php  }?>>
	<td width="30"><?php  if ($ar['admin_id'] != $_SESSION['loginid'] && $pritel != "TRUE" && ($_SESSION['u_status'] == "user" || $_SESSION['u_status'] == "admin")){?><input type="checkbox" name="friends[]" value="<?php echo $ar['admin_id'];?>"><?php  }?></td>
	<td><img src="<?php echo $url_flags.$ar2['country_shortname'];?>.gif" width="18" height="12" alt="<?php  if ($ar['admin_contact_country'] == 0){$alt = "No Selected";} else {echo NazevVlajky($ar2['country_shortname'],AGet($_GET,'lang'));};?>"></td>
	<td>&nbsp;<strong><span class="cw_link"><a href="index.php?action=user_details&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;user_id=<?php echo $ar['admin_id'];?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo $ar['admin_nick'];?></a></span></strong></td>
	<td>&nbsp;ICQ: <?php echo $ar['admin_contact_icq'];?></td>
	<td>&nbsp;X-Fire: <?php echo $ar['admin_contact_xfire'];?></td>
</tr>
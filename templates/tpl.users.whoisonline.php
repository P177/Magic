<tr>
	<td><img src="<?php echo $url_flags.$country_shortname;?>.gif" width="18" height="12" alt="<?php  if ($admin_contact_country == 0){$alt = "No Selected";} else {echo NazevVlajky($country_shortname,AGet($_GET,'lang'));};?>" title="<?php  if ($admin_contact_country == 0){$alt = "No Selected";} else {NazevVlajky($country_shortname,AGet($_GET,'lang'));};?>"></td>
	<td>&nbsp;<strong><span class="cw_link"><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;action=user_details&amp;user_id=<?php echo $admin_id;?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo $admin_nickname;?></a></span></strong></td>
	<td>&nbsp;ICQ: <?php echo $admin_contact_icq;?></td>
	<td>&nbsp;X-Fire: <?php echo $admin_contact_xfire;?></td>
</tr>
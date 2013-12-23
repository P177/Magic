	<tr>
		<td align="right" valign="top" width="150"><strong><?php echo _LINKS_TITLE;?></strong><form action="eden_save.php?action=links&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;project=<?php echo $_SESSION["project"];?>" method="post" name="forma" enctype="multipart/form-data"></td>
		<td align="left" valign="top"><input type="text" name="addlink_name" size="30"></td>
	</tr>
	<tr>
		<td align="right" valign="top" width="150"><strong><?php echo _LINKS_LINK;?> http://</strong></td>
		<td align="left" valign="top"><input type="text" name="addlink_link" size="30"></td>
	</tr>
	<tr>
		<td align="right" valign="top" width="150"><strong><?php echo _LINKS_DESC;?></strong></td>
		<td align="left" valign="top"><textarea name="addlink_desc" cols="30" rows="7"></textarea></td>
	</tr><?php
	/* Moznost pridani obrazku odkazu */
	if ($img = 1){?>
	<tr>
		<td align="right" valign="top" width="150"><strong><?php echo _LINKS_IMAGE;?></strong><br><?php 
		$size = $ar_setup['setup_links_img2_size']/1000;?></td>
		<td align="left" valign="top"><input type="file" name="addlink_img" size="30"></td>
	</tr>
	<tr>
		<td align="center" valign="top" colspan="2"><?php echo _LINKS_IMAGE_WIDTH.' '.$ar_setup['setup_links_img2_width'].'px, '._LINKS_IMAGE_HEIGHT.' '.$ar_setup['setup_links_img2_height'].'px, '._LINKS_IMAGE_SIZE.' '.$size.' kB';?></td>
	</tr><?php
	}
	if ($_SESSION['u_status'] == "user" || $_SESSION['u_status'] == "admin"){
	
	} else {?>
	<tr>
		<td valign="top">&nbsp;</td>
		<td><input maxlenght="4" size="8" name="addlink_userstring" type="text" value="" class="captcha"></td>
	</tr><?php
	}?>
	<tr>
		<td align="left" valign="top">
			<input type="hidden" name="odkaz" value="<?php echo $eden_cfg['misc_web'];?>/index.php?action=msg&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>">
			<input type="hidden" name="mode" value="addlink">
			<input type="hidden" name="cid" value="<?php echo $cid;?>">
			<input type="hidden" name="project" value="<?php echo $_SESSION["project"];?>">
		</td>
		<td align="left" valign="top"><input type="submit" value="<?php echo _LINKS_ADD_TEAM;?>" class="button">
			</form>
		</td>
	</tr>

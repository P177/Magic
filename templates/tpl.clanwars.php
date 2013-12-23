				<tr <?php  if ($_GET['stav'] == "open" && $ar['clan_cw_id'] == $_GET['id_cw']){?> bgcolor="#d0d0d0"<?php  }?>>
					<td width="12"><img src="images/hry/<?php echo $ar['clan_cw_game'];?>.gif" alt="<?php echo $ar['clan_cw_game'];?>" width="12" height="12" border="0"></td>
					<td width="18"><img src="edencms/vlajky/<?php echo $ar['clan_cw_team2_country'];?>.gif" width="18" height="12" alt="<?php echo NazevVlajky($ar['clan_cw_team2_country'],AGet($_GET,'lang'));?>"></td>
					<td width="208">&nbsp;&nbsp;<strong><span class="cw_link"><?php  if ($_GET['stav'] != "open" || $ar['clan_cw_id'] != $_GET['id_cw']){?><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=<?php echo AGet($_GET,'action');?>&amp;stav=<?php  if ($_GET['stav'] == "open" && $ar['clan_cw_id'] == $_GET['id_cw']){echo "close";} else {echo "open";}?>&amp;id_cw=<?php echo $ar['clan_cw_id'];?>&amp;page=<?php echo $_GET['page'];?>#<?php echo $ar['clan_cw_id'];?>"><?php echo $team2;?></a><?php  } else {?><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=<?php echo AGet($_GET,'action');?>&amp;stav=close&amp;cw_game=<?php echo $_GET['cw_game'];?>"><?php echo $team2;?></a><?php  }?></span></strong></td>
					<td width="65"><?php echo $datum;?><a name="#<?php echo $ar['clan_cw_id'];?>"></a></td>
					<td width="80"><strong><?php echo $gametype;?></strong></td>
					<td width="50"><strong><?php echo $team1_score.':'.$team2_score;?></strong></td>
					<td align="left"><?php  if ($_GET['stav'] != "open" || $ar['clan_cw_id'] != $_GET['id_cw']){?><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=<?php echo AGet($_GET,'action');?>&amp;stav=<?php  if ($_GET['stav'] == "open" && $ar['clan_cw_id'] == $_GET['id_cw']){echo "close";} else {echo "open";}?>&amp;id_cw=<?php echo $ar['clan_cw_id'];?>&amp;cw_game=<?php echo $_GET['cw_game'];?>&amp;page=<?php echo $_GET['page'];?>#<?php echo $ar['clan_cw_id'];?>"><?php echo _INFO;?>&nbsp;&nbsp;(<?php echo $num2[0];?>)</a><?php  } else {?><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=<?php echo AGet($_GET,'action');?>&amp;stav=close&amp;cw_game=<?php echo $_GET['cw_game'];?>"><?php echo _CLOSE;?></a><?php  }?></td>
				</tr><?php
		  	if ($_GET['stav'] == "open" && $ar['clan_cw_id'] == $_GET['id_cw']){?>	
				<tr>
					<td colspan="7" bgcolor="#E2E2E2"><h2><?php echo _CW_INFO;?></h2></td>
				</tr>	
				<tr>
					<td colspan="3" bgcolor="#E2E2E2"><strong><?php echo _DATUM;?></strong></td>
					<td colspan="4" bgcolor="#E2E2E2"><?php echo $datum;?></td>
				</tr>
				<tr>
					<td colspan="3" bgcolor="#E2E2E2"><strong><?php echo _SESTAVA;?></strong></td>
					<td colspan="4" bgcolor="#E2E2E2"><?php echo $ar['clan_cw_team1_roster'];?></td>
				</tr>
				<tr>
					<td colspan="3" bgcolor="#E2E2E2"><strong><?php echo _MAPS;?></strong></td>
					<td colspan="4" bgcolor="#E2E2E2"><?php echo $ar['clan_cw_team1_map'].' - '.$ar['clan_cw_team2_map'];?></td>
				</tr>
				<tr>
					<td colspan="3" bgcolor="#E2E2E2"><strong><?php echo _SCORE;?></strong></td>
					<td class="text_14" colspan="4" bgcolor="#E2E2E2"><strong><?php echo $team1_score.':'.$team2_score;?></strong></td>
				</tr>
				<tr>
					<td colspan="3" bgcolor="#E2E2E2"><strong><?php echo _GAMETYPE;?></strong></td>
					<td colspan="4" bgcolor="#E2E2E2"><?php echo $ar['clan_cw_gametype'];?></td>
				</tr>
				<tr>
					<td colspan="3" bgcolor="#E2E2E2"><strong><?php echo _LIGA;?></strong></td>
					<td colspan="4" bgcolor="#E2E2E2"><?php echo $ar['clan_cw_league'];?></td>
				</tr>
				<tr>
					<td colspan="7" bgcolor="#E2E2E2"><h2><?php echo _ENEMY_INFO;?></h2></td>
				</tr>
				<tr>
					<td colspan="3" bgcolor="#E2E2E2"><strong><?php echo _TAG;?></strong></td>
					<td class="text14" colspan="4" bgcolor="#E2E2E2"><strong><?php echo $ar['clan_cw_team2'];?></strong></td>
				</tr>
				<tr>
					<td colspan="3" bgcolor="#E2E2E2"><strong><?php echo _NAZEV;?></strong></td>
					<td colspan="4" bgcolor="#E2E2E2"><strong><?php echo $ar['clan_cw_team2_name'];?></strong></td>
				</tr>
				<tr>
					<td colspan="3" bgcolor="#E2E2E2"><strong><?php echo _WWW;?></strong></td>
					<td colspan="4" bgcolor="#E2E2E2"><a href="http://<?php echo $ar['clan_cw_team2_www'];?>" target="_NEW"><?php echo $ar['clan_cw_team2_www'];?></a></td>
				</tr>
				<tr>
					<td colspan="3" bgcolor="#E2E2E2"><strong>IRC</strong></td>
					<td colspan="4" bgcolor="#E2E2E2">#<?php echo $ar['clan_cw_team2_irc'];?></td>
				</tr>
				<tr>
					<td colspan="3" bgcolor="#E2E2E2"><strong><?php echo _SESTAVA;?></strong></td>
					<td colspan="4" bgcolor="#E2E2E2"><?php echo $ar['clan_cw_team2_roster'];?></td>
				</tr><?php
				if (AGet($_GET,'lang') == "cz"){
					if ($ar['clan_cw_comments_cs'] != ""){ $on = 1;}
				} else {
					if ($ar['clan_cw_comments_en'] != ""){ $on = 1;}
				}
				if ($on == 1){?>
				<tr>
					<td colspan="7" bgcolor="#E2E2E2"><h2><?php echo _COMMENTS;?></h2></td>
				</tr>
				<tr>
					<td colspan="7" bgcolor="#E2E2E2"><?php  if (AGet($_GET,'lang') == "en"){echo $comments_en;} else {echo $comments_cs;}?></td>
				</tr><?php
  				}
				if ($ar['clan_cw_scr_1'] != ""){?>
				<tr>
					<td colspan="7" bgcolor="#E2E2E2"><h2><?php echo _SCREENY;?></h2></td>
				</tr>
				<tr>
					<td colspan="7" bgcolor="#d0d0d0">
						<?php  if ($ar['clan_cw_scr_1'] != ""){$size = getimagesize($url_screenshots.$ar['clan_cw_scr_1']);?> <strong># 1</strong><img src="images/scr.gif" alt="" width="75" height="50" border="0" class="scr" onclick="window.open('eden_show_images.php?lang=<?php echo AGet($_GET,'lang')?>&mode=scr&img=<?php echo $ar['clan_cw_scr_1'];?>&project=<?php echo $_SESSION['project'];?>','','menubar=no,resizable=yes,toolbar=no,status=no,width=<?php  echo $size[0]?>,height=<?php  echo $size[1]?>')"><?php  }?>
						<?php  if ($ar['clan_cw_scr_2'] != ""){$size = getimagesize($url_screenshots.$ar['clan_cw_scr_2']);?> <strong># 2</strong><img src="images/scr.gif" alt="" width="75" height="50" border="0" class="scr" onclick="window.open('eden_show_images.php?lang=<?php echo AGet($_GET,'lang')?>&mode=scr&img=<?php echo $ar['clan_cw_scr_2'];?>&project=<?php echo $_SESSION['project'];?>','','menubar=no,resizable=yes,toolbar=no,status=no,width=<?php  echo $size[0]?>,height=<?php  echo $size[1]?>')"><?php  }?>
						<?php  if ($ar['clan_cw_scr_3'] != ""){$size = getimagesize($url_screenshots.$ar['clan_cw_scr_3']);?> <strong># 3</strong><img src="images/scr.gif" alt="" width="75" height="50" border="0" class="scr" onclick="window.open('eden_show_images.php?lang=<?php echo AGet($_GET,'lang')?>&mode=scr&img=<?php echo $ar['clan_cw_scr_3'];?>&project=<?php echo $_SESSION['project'];?>','','menubar=no,resizable=yes,toolbar=no,status=no,width=<?php  echo $size[0]?>,height=<?php  echo $size[1]?>')"><?php  }?>
						<?php  if ($ar['clan_cw_scr_4'] != ""){$size = getimagesize($url_screenshots.$ar['clan_cw_scr_4']);?> <strong># 4</strong><img src="images/scr.gif" alt="" width="75" height="50" border="0" class="scr" onclick="window.open('eden_show_images.php?lang=<?php echo AGet($_GET,'lang')?>&mode=scr&img=<?php echo $ar['clan_cw_scr_4'];?>&project=<?php echo $_SESSION['project'];?>','','menubar=no,resizable=yes,toolbar=no,status=no,width=<?php  echo $size[0]?>,height=<?php  echo $size[1]?>')"><?php  }?>
						<?php  if ($ar['clan_cw_scr_5'] != ""){$size = getimagesize($url_screenshots.$ar['clan_cw_scr_5']);?> <strong># 5</strong><img src="images/scr.gif" alt="" width="75" height="50" border="0" class="scr" onclick="window.open('eden_show_images.php?lang=<?php echo AGet($_GET,'lang')?>&mode=scr&img=<?php echo $ar['clan_cw_scr_5'];?>&project=<?php echo $_SESSION['project'];?>','','menubar=no,resizable=yes,toolbar=no,status=no,width=<?php  echo $size[0]?>,height=<?php  echo $size[1]?>')"><?php  }?>
						<?php  if ($ar['clan_cw_scr_6'] != ""){$size = getimagesize($url_screenshots.$ar['clan_cw_scr_6']);?> <strong># 6</strong><img src="images/scr.gif" alt="" width="75" height="50" border="0" class="scr" onclick="window.open('eden_show_images.php?lang=<?php echo AGet($_GET,'lang')?>&mode=scr&img=<?php echo $ar['clan_cw_scr_6'];?>&project=<?php echo $_SESSION['project'];?>','','menubar=no,resizable=yes,toolbar=no,status=no,width=<?php  echo $size[0]?>,height=<?php  echo $size[1]?>')"><?php  }?>
						<?php  if ($ar['clan_cw_scr_7'] != ""){$size = getimagesize($url_screenshots.$ar['clan_cw_scr_7']);?> <strong># 7</strong><img src="images/scr.gif" alt="" width="75" height="50" border="0" class="scr" onclick="window.open('eden_show_images.php?lang=<?php echo AGet($_GET,'lang')?>&mode=scr&img=<?php echo $ar['clan_cw_scr_7'];?>&project=<?php echo $_SESSION['project'];?>','','menubar=no,resizable=yes,toolbar=no,status=no,width=<?php  echo $size[0]?>,height=<?php  echo $size[1]?>')"><?php  }?>
					</td>
				</tr><?php
				}
				if ($ar['clan_cw_demo_01'] != ""){?>
				<tr>
					<td colspan="7" bgcolor="#E2E2E2"><h2><?php echo _DEMA;?></h2></td>
				</tr>
				<tr>
					<td colspan="7" bgcolor="#d0d0d0">
						<?php  if ($ar['clan_cw_demo_01'] != ""){?> <strong># 01</strong>&nbsp;&nbsp;<img src="images/demo.gif" alt="" width="17" height="18" border="0" align="middle">&nbsp;&nbsp;&nbsp;<a href="<?php echo $ar['clan_cw_demo_01']?>" target="_blank">download</a>&nbsp;&nbsp;&nbsp;<?php echo $ar['clan_cw_demo_desc_01'];}?>
						<?php  if ($ar['clan_cw_demo_02'] != ""){?> <strong># 02</strong>&nbsp;&nbsp;<img src="images/demo.gif" alt="" width="17" height="18" border="0" align="middle">&nbsp;&nbsp;&nbsp;<a href="<?php echo $ar['clan_cw_demo_02']?>" target="_blank">download</a>&nbsp;&nbsp;&nbsp;<?php echo $ar['clan_cw_demo_desc_02'];}?>
						<?php  if ($ar['clan_cw_demo_03'] != ""){?> <strong># 03</strong>&nbsp;&nbsp;<img src="images/demo.gif" alt="" width="17" height="18" border="0" align="middle">&nbsp;&nbsp;&nbsp;<a href="<?php echo $ar['clan_cw_demo_03']?>" target="_blank">download</a>&nbsp;&nbsp;&nbsp;<?php echo $ar['clan_cw_demo_desc_03'];}?>
						<?php  if ($ar['clan_cw_demo_04'] != ""){?> <strong># 04</strong>&nbsp;&nbsp;<img src="images/demo.gif" alt="" width="17" height="18" border="0" align="middle">&nbsp;&nbsp;&nbsp;<a href="<?php echo $ar['clan_cw_demo_04']?>" target="_blank">download</a>&nbsp;&nbsp;&nbsp;<?php echo $ar['clan_cw_demo_desc_04'];}?>
						<?php  if ($ar['clan_cw_demo_05'] != ""){?> <strong># 05</strong>&nbsp;&nbsp;<img src="images/demo.gif" alt="" width="17" height="18" border="0" align="middle">&nbsp;&nbsp;&nbsp;<a href="<?php echo $ar['clan_cw_demo_05']?>" target="_blank">download</a>&nbsp;&nbsp;&nbsp;<?php echo $ar['clan_cw_demo_desc_05'];}?>
						<?php  if ($ar['clan_cw_demo_06'] != ""){?> <strong># 06</strong>&nbsp;&nbsp;<img src="images/demo.gif" alt="" width="17" height="18" border="0" align="middle">&nbsp;&nbsp;&nbsp;<a href="<?php echo $ar['clan_cw_demo_06']?>" target="_blank">download</a>&nbsp;&nbsp;&nbsp;<?php echo $ar['clan_cw_demo_desc_06'];}?>
						<?php  if ($ar['clan_cw_demo_07'] != ""){?> <strong># 07</strong>&nbsp;&nbsp;<img src="images/demo.gif" alt="" width="17" height="18" border="0" align="middle">&nbsp;&nbsp;&nbsp;<a href="<?php echo $ar['clan_cw_demo_07']?>" target="_blank">download</a>&nbsp;&nbsp;&nbsp;<?php echo $ar['clan_cw_demo_desc_07'];}?>
						<?php  if ($ar['clan_cw_demo_08'] != ""){?> <strong># 08</strong>&nbsp;&nbsp;<img src="images/demo.gif" alt="" width="17" height="18" border="0" align="middle">&nbsp;&nbsp;&nbsp;<a href="<?php echo $ar['clan_cw_demo_08']?>" target="_blank">download</a>&nbsp;&nbsp;&nbsp;<?php echo $ar['clan_cw_demo_desc_08'];}?>
						<?php  if ($ar['clan_cw_demo_09'] != ""){?> <strong># 09</strong>&nbsp;&nbsp;<img src="images/demo.gif" alt="" width="17" height="18" border="0" align="middle">&nbsp;&nbsp;&nbsp;<a href="<?php echo $ar['clan_cw_demo_09']?>" target="_blank">download</a>&nbsp;&nbsp;&nbsp;<?php echo $ar['clan_cw_demo_desc_09'];}?>
						<?php  if ($ar['clan_cw_demo_10'] != ""){?> <strong># 10</strong>&nbsp;&nbsp;<img src="images/demo.gif" alt="" width="17" height="18" border="0" align="middle">&nbsp;&nbsp;&nbsp;<a href="<?php echo $ar['clan_cw_demo_10']?>" target="_blank">download</a>&nbsp;&nbsp;&nbsp;<?php echo $ar['clan_cw_demo_desc_10'];}?>
					</td>
				</tr><?php
				}?>
				<tr>
					<td colspan="7" bgcolor="#E2E2E2"><h2><?php echo _USERS_COMMENTS;?></h2></td>
				</tr>
				<tr>
					<td colspan="7" bgcolor="#ffffff"><?php  Comments($ar['clan_cw_id'],"clanwars",90,566,400,566,566);?></td>
				</tr>
				<tr>
					<td colspan="7"><hr width="574" size="1" noshade></td>
				</tr><?php
  			}?>
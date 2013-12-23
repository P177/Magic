<table cellpadding="3">	
		<tr>
			<td align="left" valign="top"><h1><?php echo $hlavicka;?></h1><br></td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<strong><?php echo FormatTimestamp($news_date_on,"d/m/Y");?> - <a href="index.php?action=user_details&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;user_id=<?php echo $admin_id;?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo $admin_nickname;?></a></strong>
			</td>
		</tr>	
<!--***************** ZACATEK TEXTU *****************-->
		<tr>
			<td align="left" valign="top" style="text-align: justify;"><?php
  			echo "<br>";
			echo "	$text<br><br>\n";
//<!--***************** KONEC TEXTU *****************-->
//<!--***************** ZOBRAZENI PATY CLANKU *****************-->
			$vysledek2 = mysql_query("SELECT comment_author, comment_subject FROM $db_comments WHERE comment_pid=".(float)$aid." AND comment_modul='news'") or die ("<strong>"._ERROR." 5</strong> ".mysql_error()); // Nastaveni ukazatele na komentare v danem clanku
			$num2 = mysql_num_rows($vysledek2);
			if ($news_comments == 1){?>
				&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index.php?action=komentar&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;id=<?php echo $news_id;?>&amp;modul=news&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo _COM_SHOW_OR_ADD;?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo _COM_COM;?> <?php echo $num2;?><br><br><?php
 			}?>
			</td>
		</tr>
<!--***************** KONEC PATY CLANKU *****************--><?php
 			if ($news_comments == 1){?>
<!--***************** ZACATEK KOMENTARU *****************-->
				<tr>
					<td align="left" valign="top" class="kapitoly"><?php echo _DISC;?></td>
				</tr>
				<tr>
					<td align="left" valign="top" class="kapitoly_seznam">
						<table><?php
  				$i=1;	
				while($ar2 = mysql_fetch_array($vysledek2)){
					echo '<tr>';
							
					if ($i % 2 == 0){
						echo '<td align="left" valign="top" class="suda" style="padding: 5px;">'.$i.'. '.$ar2['comment_author'].'</strong> - '.$ar2['comment_subject'].'</td>';
					} else {
						echo '<td align="left" valign="top" style="padding: 5px;">'.$i.'. '.$ar2['comment_author'].'</strong> - '.$ar2['comment_subject'].'</td>';
					}
					echo '	
						</tr>';
					$i++;
				}?>
					<tr>
						<td align="left" valign="top">
							<form action="index.php?action=komentar&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;id=<?php echo $aid;?>&amp;modul=news&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" method="post" name="formular">
							<input type="hidden" name="action" value="komentar">
							<input type="submit" value="<?php echo _COM_SUBMIT;?>">
							</form>
						</td>
					</tr><?php
 			}?>
				</table>
<!--***************** KONEC KOMENTARU *****************-->

			</td>
		</tr>
		</table>
<table width="594" cellpadding="3">
		<tr>
			<td align="left" valign="top" style="text-align: justify;"><h1><?php echo $article_headline;?></h1><br></td>
		</tr>
		<tr>
			<td align="left" valign="top" style="text-align: justify;">
				<strong><?php echo FormatTimestamp($arkap1['article_date_on'],"d/m/Y");?> - <a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;action=user_details&amp;user_id=<?php echo $admin_id;?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo $admin_nickname;?></a></strong>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo "<a href=\"#\" onclick=\"window.open('./edencms/eden_recommend.php?action=clanek&amp;lang=".AGet($_GET,'lang')."&amp;filter=".AGet($_GET,'filter')."&amp;project=".$_SESSION['project']."&amp;id=".$article_id."','','menubar=no,resizable=no,toolbar=no,directories=no,status=no,width=475,height=550')\">"._RECOMMEND."</a>";?>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top" style="text-align: justify;"><?php  if ($article_img_1 != ""){?><img src="<?php echo $url_articles.$article_img_1;?>" alt="" width="100" height="100" border="1" align="left" class="img_articles"><?php  }?>
			<?php  if ($article_perex != "" && $arkap1['article_prevoff'] == 0){echo $article_perex;} ?></td>
		</tr>

<!--***************** SEZNAM KAPITOL *****************--><?php
		if ($arkap1['article_chapter_name'] != ""){?>
		<tr>
			<td align="left" valign="top" class="kapitoly" style="text-align: justify;"><?php echo _CL_TOPICS;?></td>
		</tr>
		<tr>
			<td align="left" valign="top" class="kapitoly_seznam" style="text-align: justify;"> <?php
  			$reskap = mysql_query("SELECT article_id, article_chapter_number, article_chapter_name, article_views FROM $db_articles WHERE article_parent_id=".(integer)$par." ORDER BY article_chapter_number ASC") or die ("<strong>"._ERROR."5</strong>".mysql_error());?>
			1. <?php  if ($cid != $par){?><a href="index.php?action=clanek&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;id=<?php echo $arkap1['article_id'];?>&amp;par=<?php echo $par;?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo $arkap1['article_chapter_name'];?></a><?php  } else {echo $arkap1['article_chapter_name']." ("._COM_COM_VIEWS." ".$article_views.") ";}?>
				<br><?php
  			$i = 2;
			while($arkap = mysql_fetch_array($reskap)){?>
				<?php echo $i;?>. <?php  if ($cid != $arkap['article_id']){?><a href="index.php?action=clanek&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;id=<?php echo $arkap['article_id'];?>&amp;par=<?php echo $par;?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo $arkap['article_chapter_name'];?></a><?php  } else {echo $arkap['article_chapter_name'];} if ($_SESSION['u_status'] == "admin"){ echo " ("._COM_COM_VIEWS." ".$arkap['article_views'].") ";}?>
				<br><?php
  				$i++;
				$poslednikapitola = $arkap['article_chapter_number'];
			}?>
			</td>
		</tr><?php
  		}?>
<!--***************** KONEC SEZNAMU KAPITOL *****************-->
<!--***************** ZACATEK TEXTU *****************-->
		<tr>
			<td align="left" valign="top" style="text-align: justify;"><?php
  			echo "	$article_text<br><br>\n";
//<!--***************** KONEC TEXTU *****************-->
//<!--***************** ZOBRAZENI PATY CLANKU *****************-->
	if ($article_parent_id == 0){$nid = $article_id;} else {$nid = $arr['article_id'];}
	$vysledek2 = mysql_query("SELECT comment_author, comment_subject FROM $db_comments WHERE comment_pid=".(float)$nid." AND comment_modul='article' ORDER BY comment_id ASC"); // Nastaveni ukazatele na komentare v danem clanku
	$num2 = mysql_num_rows($vysledek2);
	if ($arkap1['article_comments'] == 1){?>
				<a href="index.php?action=komentar&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;id=<?php  if ($ar['article_parent_id'] == 0){echo $article_id;} else {echo $arr['article_id'];}?>&amp;modul=article&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo _COM_SHOW_OR_ADD;?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo _COM_COM;?> <?php echo $num2;?><?php  if ($article_source != ""){?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo _ARTICLES_SOURCE;?>: <a href="http://<?php echo $article_source;?>" target="_self"><?php echo $article_source;?></a><?php }?><br><br>
			</td>
		</tr><?php
  		if ($ar['article_poll'] != 0){?>
		<tr>
			<td align="left" valign="top" style="text-align: justify;"><?php  Poll($ar['article_poll'],AGet($_GET,'lang'),600,10,"article",560,40);?></td>
		</tr><?php
		}?>
<!--***************** KONEC PATY CLANKU *****************-->
<!--***************** DALSI A PREDCHOZI KAPITOLA *****************--><?php
  				if ($par != 0){
					if ($par == $cid){$query_id = "article_parent_id=0";} else {$query_id = "article_parent_id=".(float)$par."";}
					$res4 = mysql_query("SELECT article_chapter_number FROM $db_articles WHERE $query_id AND article_id=".(float)$cid) or die ("<strong>"._ERROR."5</strong>".mysql_error());
					$ar4 = mysql_fetch_array($res4);
					$predchozi_kapitola = $ar4['article_chapter_number']-1;
					if ($par == $cid){$query_id = "article_id=".(float)$par."";}elseif ($ar4['article_chapter_number'] == 2){$query_id = "article_id=".(float)$par."";} else {$query_id = "article_parent_id=".(float)$par."";}
					$res5 = mysql_query("SELECT article_id FROM $db_articles WHERE $query_id AND article_chapter_number=".(float)$predchozi_kapitola) or die ("<strong>"._ERROR."5</strong>".mysql_error());
					$ar5 = mysql_fetch_array($res5);
					$predchozi = $ar5['article_id'];
					$dalsi_kapitola = $ar4['article_chapter_number']+1;
					$res6 = mysql_query("SELECT article_id FROM $db_articles WHERE article_parent_id=".(float)$par." AND article_chapter_number=".(float)$dalsi_kapitola) or die ("<strong>"._ERROR."5</strong>".mysql_error());
					$ar6 = mysql_fetch_array($res6);
					$dalsi = $ar6['article_id'];?>
					<tr>
						<td align="left" valign="top" style="text-align: justify;"><br><?php  if ($ar4['article_chapter_number'] <= $poslednikapitola && $ar4['article_chapter_number'] > 1){echo '<a href="index.php?action=clanek&amp;id='.$predchozi.'&par='.$par.'" target="_self"><<< Predchozí kapitola</a>';} if ($ar4['article_chapter_number'] < $poslednikapitola){echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?action=clanek&amp;id='.$dalsi.'&par='.$par.'" target="_self">Další kapitola >>>';}?><br></td>
					</tr><?php
  				}?>
<!--***************** KONEC DALSI A PREDCHOZI KAPITOLY *****************-->
<!--***************** REKLAMA *****************-->
				<tr>
					<td align="left" valign="top" style="text-align: justify;">
					</td>
				</tr>
<!--***************** KONEC REKLAMA *****************-->
<!--***************** ZACATEK KOMENTARU *****************-->
				<tr>
					<td align="left" valign="top" class="kapitoly" style="text-align: justify;"><?php echo _DISC;?></td>
				</tr>
				<tr>
					<td align="left" valign="top" class="kapitoly_seznam" style="text-align: justify;">
						<table><?php
  				$i=1;
				while($ar2 = mysql_fetch_array($vysledek2)){
					echo '<tr>';

					if ($i % 2 == 0){
						echo '<td width="564px" align="left" valign="top" class="suda" style="padding:5px;"><strong>'.$i.'. '.$ar2['comment_author'].'</strong> - '.$ar2['comment_subject'].'</td>';
					} else {
						echo '<td width="564px" align="left" valign="top" style="padding:5px;"><strong>'.$i.'. '.$ar2['comment_author'].'</strong> - '.$ar2['comment_subject'].'</td>';
					}
					echo '
						</tr>';
					$i++;
				}?>
					<tr>
						<td align="left" valign="top" style="text-align: justify;">
							<form action="index.php?action=komentar&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;id=<?php  if ($ar['article_parent_id'] == 0){echo $article_id;} else {echo $arr['article_id'];}?>&amp;modul=article&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" method="post" name="formular">
							<input type="hidden" name="action" value="komentar">
							<input type="submit" value="<?php echo _COM_SUBMIT;?>">
							</form>
						</td>
					</tr>
				</table>
<!--***************** KONEC KOMENTARU *****************--><?php
 	}?>

			</td>
		</tr>
</table>
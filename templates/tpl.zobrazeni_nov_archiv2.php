<div id="content_template_col_top"></div>
<div id="content_template_col_cont">
	<div class="content_template_col_text"><table cellspacing="0" cellpadding="3" border="0" width="620"  bgcolor="#ffffff">
			<tr>
				<td><h1><?php  if ($article_link == "TRUE"){?><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=clanek&amp;id=<?php echo $article_id;?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo $article_headline;?></a><?php  } else {echo $article_headline;}?></h1></td>
			</tr>
			<tr>
				<td><strong><?php echo FormatTimestamp($article_date_on,"d/m/Y");?> - <a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;action=user_details&amp;user_id=<?php echo $admin_id;?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo $admin_nickname;?></a></strong><?php  if ($article_comments != "0"){?> (<?php  if (AGet($_GET,'lang') == "cz"){echo "komentářů";} else {echo "comments";}?>: <a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=komentar&amp;id=<?php echo $article_id;?>&amp;modul=article&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo $num2[0];?></a>)<?php  }?></td>
			</tr>
			<tr>
				<td align="left" valign="top" style="text-align: justify;"><?php  if ($article_img_1 != ""){?><img src="<?php echo $url_articles.$article_img_1;?>" alt="" width="100" height="100" border="1" align="left" style="margin-right:5px;"><?php  }if ($article_link == "TRUE"){echo $article_perex;} else {echo $article_text;}?>
				<?php  if ($article_ftext == 1){?><br><a href="<?php echo $url_articles;?>?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=clanek&amp;id=<?php echo $article_id;?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo _FULL_ARTICLE;?></a><br><?php  }?>
				</td>
			</tr>
		</table></div>
</div>
<div id="content_template_col_bottom"></div>
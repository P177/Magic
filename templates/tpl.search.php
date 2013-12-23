<div id="content_template_col_cont">
		<div class="content_template_col_text">
			<table cellspacing="0" cellpadding="3" border="0" width="584"  bgcolor="#ffffff">
				<tr>
					<td><h1><?php  if ($article_link == "TRUE"){?><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=clanek&amp;id=<?php echo $article_id;?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo $article_headline;?></a><?php  } else {echo $article_headline;}?></h1></td>
				</tr>
				<tr>
					<td><strong><?php echo FormatTimestamp($article_date_on,"d/m/Y");?> - <a href="mailto:<?php echo TransToASCII($admin_email);?>"><?php echo $admin_nick;?></a></strong><?php if ($article_comments != "0"){?> (<?php  if (AGet($_GET,'lang') == "cz"){echo "komentářů";} else {echo "comments";}?>: <a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=komentar&amp;id=<?php echo $article_id;?>&amp;modul=<?php echo $_POST['search_choice'];?>" target="_self"><?php echo $num2[0];?></a>)<?php  }?></td>
				</tr>
				<tr>
					<td align="left" valign="top" style="text-align: justify;"><?php  if ($article_img_1 != ""){?><img src="<?php echo $url_articles.$article_img_1;?>" alt="" width="100" height="100" border="1" align="left" class="img_articles"><?php  }echo $article_perex; echo "<br><br>"; echo $article_text;?></td>
				</tr>
			</table>
	</div>
</div>

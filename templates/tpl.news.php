<div class="content_act_col_cont"><a name="act_<?php echo $i;?>"></a>
	<div class="content_act_col_text">
		<h2><img src="<?php echo $url_category.$category_image;?>" title="<?php echo $category_name;?>" alt="<?php echo $category_name;?>" width="16" height="16" border="0">&nbsp;<?php echo $news_headline;?></h2>
		<div class="aktuality_popis">
		<div class="aktuality_date"><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=komentar&amp;id=<?php echo $news_id;?>&amp;modul=news&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo formatDateOnLang($datum_clanku);?></a></div>
		<div class="aktuality_name"><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;action=user_details&amp;user_id=<?php echo $admin_id;?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo $admin_nickname;?></a></div>
		</div><br>
		<?php echo $news_text;?><br>
		<?php  if ($news_source != ""){echo _NEWS_SOURCE;?>: <a href="http://<?php echo $news_source;?>" target="_self"><?php echo $news_source;?></a><br><?php }?>
		<?php if ($news_comments == 1){?><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=komentar&amp;id=<?php echo $news_id;?>&amp;modul=news&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo _COM_COM.' '.$num2;?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php  if (($_SESSION['u_status'] == "user" || $_SESSION['u_status'] == "admin") && ($comments_log_comments < $num2)){$new_comments = ($num2 - $comments_log_comments);?><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=komentar&amp;id=<?php echo $news_id;?>&amp;modul=news&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo _COM_COM_NEW.' '.$new_comments;?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php }}?><a href="#top"><?php echo _CMN_ONTOP;?></a>
	</div>
</div>

		<h1><img src="<?php echo $url_category.$category_image;?>" alt="" width="16" height="16" border="0">&nbsp;<?php echo $news_headline;?></h1>
		<div class="aktuality_popis">
		<div class="aktuality_date"><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=komentar&amp;id=<?php echo $news_id;?>&amp;modul=news&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php $datum_clanku = FormatTimestamp($news_date_on,"l d.m.Y, H:i"); echo formatDateOnLang($datum_clanku);?></a></div>
		<div class="aktuality_name"><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;action=user_details&amp;user_id=<?php echo $admin_id;?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo $admin_nickname;?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo "<a href=\"#\" onclick=\"window.open('./edencms/eden_recommend.php?action=komentar&amp;lang=".AGet($_GET,'lang')."&amp;filter=".AGet($_GET,'filter')."&amp;project=".$_SESSION['project']."&amp;id=".$news_id."&amp;modul=news','','menubar=no,resizable=no,toolbar=no,directories=no,status=no,width=475,height=550')\">"._RECOMMEND."</a>";?></div>
		</div><br>
		<span class="aktuality"><?php echo $news_text;?><br>
			<?php  if ($news_source != ""){echo _NEWS_SOURCE;?>: <a href="http://<?php echo $news_source;?>" target="_self"><?php echo $news_source;?></a><br><?php }?>
		</span>

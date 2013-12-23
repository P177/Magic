<tr>
	<td width="12"><img src="<?php echo $url_category.$category_image;?>" alt="<?php $datum_clanku = FormatTimestamp($news_date_on,"l d.m.Y, H:i");  echo formatDateOnLang($datum_clanku);?>" width="12" height="12" border="0"></td>
	<td width="231" align="left" valign="top" style="font-size:10px;">&nbsp;<a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=komentar&amp;modul=news&amp;id=<?php echo $news_id;?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo $hlavicka;?></a><?php 	if ($news_comments == 1){?>&nbsp;(<a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=komentar&amp;id=<?php echo $news_id;?>&amp;modul=news&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo $num2[0];?></a>)<?php }?>
	</td>
</tr>


<tr <?php if ($cislo % 2 == 0){echo 'class="suda"';} else {echo 'class="licha"';}?>>
	<td valign="top" width="12"><img src="<?php echo $url_games.$category_img;?>" alt="<?php echo $category_name;?>" width="12" height="12" border="0"></td>
	<td valign="top" width="40"><?php echo FormatTimestamp($article_date_on,"d.m.y");?></td>
	<td valign="top"><a href="index.php?action=clanek&amp;id=<?php echo $article_id;?>&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>" title="<?php echo $article_headline;?>"><?php echo ShortText($article_headline,40);?></a></td>
	<td valign="top" width="24" align="right"><a href="index.php?action=komentar&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;id=<?php echo $article_id;?>&amp;modul=article&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo $num2[0];?></a></td>
</tr>
<tr <?php if ($cislo % 2 == 0){echo 'class="suda"';} else {echo 'class="licha"';}?>>
	<td valign="top" width="16"><img src="<?php echo $url_category.$category_img;?>" alt="<?php echo $category_name;?>" width="16" height="16" border="0"></td>
	<td valign="top" width="60"><?php echo $article_date;?></td>
	<td valign="top"><a href="index.php?action=clanek&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;id=<?php echo $article_id;?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" title="<?php echo $article_headline;?>"><?php echo $article_headline;?></a></td>
	<td valign="top" width="40" align="right"><a href="index.php?action=komentar&amp;lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;id=<?php echo $article_id;?>&amp;modul=article&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo $num2[0];?></a></td>
</tr>
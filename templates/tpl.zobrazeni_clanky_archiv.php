<li>
<div class='left'>
	<img src="<?php echo $url_category.$category_image;?>" title="<?php echo $category_name;?>" alt="<?php echo $category_name;?>" width="16" height="16" border="0">&nbsp;&nbsp;<acronym title='<?php echo $article_headline_long;?>'><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=clanek&amp;id=<?php echo $article_id;?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo $article_headline;?></a></acronym>
</div>
<div class='right'>
	<img src="/images/bod.gif" alt="" width="1" height="16" border="0"><acronym title='<?php echo $num2[0];?>'><a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=komentar&amp;id=<?php echo $article_id;?>&amp;modul=article&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo $num2[0];?></a></acronym>
</div>
</li>
&nbsp;&nbsp;<?php echo FormatTimestamp($article_date_on,"d/m/Y");?> . <a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;filter=<?php echo AGet($_GET,'filter');?>&amp;action=clanek&amp;id=<?php echo $article_id;?>&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>"><?php echo $article_headline;?></a>&nbsp;(<?php  if (AGet($_GET,'lang') == "cz"){echo "komentářů";} else {echo "comments";}?>: <a href="index.php?lang=<?php echo AGet($_GET,'lang');?>&amp;action=komentar&amp;id=<?php echo $article_id;?>&amp;modul=article&amp;page_mode=<?php echo AGet($_GET,'page_mode');?>" target="_self"><?php echo $num2[0];?></a>)<br>
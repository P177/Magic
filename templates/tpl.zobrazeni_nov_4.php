<?php 
echo "<div class=\"content_article_home_cont\">\n";
echo "	<div class=\"content_article_home_text\"><h2><img src=\"".$url_category.$category_image."\" title=\"".$category_name."\" alt=\"".$category_name."\" width=\"16\" height=\"16\" border=\"0\">&nbsp;"; if ($article_link == true){ echo "<a href=\"index.php?lang=".AGet($_GET,'lang')."&amp;filter=".AGet($_GET,'filter')."&amp;action=clanek&amp;id=".$article_id."&amp;page_mode=".AGet($_GET,'page_mode')."\" title=\"".$article_headline."\">".$article_headline."</a>"; } else { echo $article_headline;} echo "</h2>\n";
echo "		<strong>".FormatTimestamp($article_date_on,"d/m/Y")." - <a href=\"index.php?lang=".AGet($_GET,'lang')."&amp;action=user_details&amp;user_id=".$admin_id."&amp;filter=".AGet($_GET,'filter')."&amp;page_mode=".AGet($_GET,'page_mode')."\">".$admin_nickname."</a></strong> ("; if ($_SESSION['u_status'] == "admin"){ echo _COM_COM_VIEWS." ".$article_views."&nbsp;";} if ($article_comments != "0"){ echo "<a href=\"index.php?lang=".AGet($_GET,'lang')."&amp;filter=".AGet($_GET,'filter')."&amp;action=komentar&amp;id=".$article_id."&amp;modul=article&amp;page_mode=".AGet($_GET,'page_mode')."&amp;page_mode=".AGet($_GET,'page_mode')."\" target=\"_self\">"._COM_COM." ".$num2."</a>";  } if (($_SESSION['u_status'] == "user" || $_SESSION['u_status'] == "admin") && ($comments_log_comments < $num2)){$new_comments = ($num2 - $comments_log_comments); echo "&nbsp; <a href=\"index.php?lang=".AGet($_GET,'lang')."&amp;filter=".AGet($_GET,'filter')."&amp;action=komentar&amp;id=".$article_id."&amp;modul=article&amp;page_mode=".AGet($_GET,'page_mode')."\" target=\"_self\">"._COM_COM_NEW." ".$new_comments."</a>"; } echo ") "; 
		/* Stream status */
		$channel_source = explode("*||*",$article_source);
		$stream = new Stream($eden_cfg);
		if ($stream->CheckActiveChannel(AGet($channel_source,1),$channel_source[0]) == true){echo "<span style=\"color:#00ff00\"><strong>On Air</strong></span>";} else {echo "<span style=\"color:#ff0000;\"><strong>Offline</strong></span>";} 
		/* Stream status Konec */
			echo "<br>\n";
			if ($article_img_1 != ""){ echo "<img src=\"edencms/img_articles/".$article_img_1."\" alt=\"\" width=\"100\" height=\"100\" border=\"1\" align=\"left\" class=\"img_articles\">"; } if ($article_link == true){echo $article_perex;} else {echo $article_text;} echo "<br>\n";
echo "			<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\n";
echo "				<tr>\n";
echo "					<td width=\"464\" align=\"left\">&nbsp;&nbsp;</td>\n";
echo "					<td width=\"100\" align=\"right\">";  if ($article_ftext == 1){ echo "<a href=\"index.php?action=clanek&amp;id=".$article_id."&amp;lang=".AGet($_GET,'lang')."&amp;filter=".AGet($_GET,'filter')."&amp;page_mode=".AGet($_GET,'page_mode')."\" target=\"_self\">"._FULL_ARTICLE."</a>"; } echo "</td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "		</div>\n";
echo "	</div>\n";
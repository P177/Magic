<?php
echo "<tr>\n";
echo "	<td width=\"590\" align=\"left\" valign=\"top\"><h1><img src=\"".$url_category.$category_image."\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">&nbsp;".$article_headline."</h1><br></td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "	<td width=\"590\" align=\"left\" valign=\"top\">\n";
echo "		<strong>".FormatTimestamp($article_date_on,"d/m/Y")." - <a href=\"".$eden_cfg['url']."index.php?action=user_details&amp;lang=".AGet($_GET,'lang')."&amp;filter=".AGet($_GET,'filter')."&amp;user_id=".$admin_id."&amp;page_mode=".AGet($_GET,'page_mode')."\" target=\"_blank\">".$admin_nickname."</a></strong>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"#\" onclick=\"window.open('./eden_recommend.php?action=komentar&amp;lang=".AGet($_GET,'lang')."&amp;filter=".AGet($_GET,'filter')."&amp;project=".$_GET['project']."&amp;id=".$article_id."&amp;modul=article','','menubar=no,resizable=no,toolbar=no,directories=no,status=no,width=475,height=550')\">"._RECOMMEND."</a><br clear=\"all\">\n";
echo "	</td>\n";
echo "</tr>	\n";
echo "<tr>\n";
echo "	<td width=\"590\" align=\"left\" valign=\"top\">\n";
		if ($article_perex != "" && $article_prevoff == 0){echo $article_perex."<hr noshade size=\"1\" width=\"500\" align=\"center\">\n";}
echo "	</td>\n";
echo "</tr>\n";
echo "<tr class=\"clanekiframe\">\n";
echo "	<td width=\"590\" align=\"left\" valign=\"top\" style=\"text-align: justify;\">\n";
echo $article_text."<br><br>\n";
echo "	</td>\n";
echo "</tr>";
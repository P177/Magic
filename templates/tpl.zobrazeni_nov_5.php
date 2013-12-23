<?php 
echo "<div style=\"height:25px;\" class=\"".$css_class."\">";
echo "<div style=\"padding:0px 0px 0px 5px;height:20px;width:150px;float:left\">";
echo "	<h2><img src=\"".$url_category.$category_image."\" title=\"".$category_name."\" alt=\"".$category_name."\" width=\"16\" height=\"16\" border=\"0\">&nbsp;"; if ($article_link == true){ echo "<a href=\"index.php?lang=".AGet($_GET,'lang')."&amp;filter=".AGet($_GET,'filter')."&amp;action=clanek&amp;id=".$article_id."&amp;page_mode=".AGet($_GET,'page_mode')."\" title=\"".$article_headline."\">".$article_headline."</a>"; } else { echo $article_headline;} echo "</h2> ";
echo "</div>\n";
echo "<div style=\"height:20px;float:left;vertical-align:middle;\">";
echo $article_perex;
echo "</div>\n";
echo "<div style=\"padding:0px 5px 0px 0px;height:20px;float:right;\">";
/* Stream status */
$channel_source = explode("*||*",$article_source);
$stream = new Stream($eden_cfg);
if ($stream->CheckActiveChannel($channel_source[1],$channel_source[0]) == true){echo "<span style=\"color:#00ff00\"><strong>On Air</strong></span>";} else {echo "<span style=\"color:#ff0000;\"><strong>Offline</strong></span>";} 
/* Stream status Konec */
echo "</div>";
echo "</div>\n";

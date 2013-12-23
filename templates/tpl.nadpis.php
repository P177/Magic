<?php
if (AGet($_GET,'action') == "komentar" || AGet($_GET,'action') == "send"){echo "<span style=\"color = #FFCC00\">Komentár k clánku:</span> ".$article_headline;}
if (AGet($_GET,'action') == "clanek"){echo "<span style=\"color = #FFCC00\">Clánek:</span> ".$article_headline;}
?>
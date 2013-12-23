<?php
$i = 0;

foreach ($tournaments as $tournament){
	if ($i <= $num){
		if ($i % 2 == 0){$css_class = "suda";} else {$css_class = "licha";}
		echo"	<div class=\"".$css_class."\" style=\"padding:4px;\">";
		echo"		".$tournament->date." - Najada<br>";
		echo"		<a href=\"http://www.magic-live.cz/index.php?action=tournaments\">".$tournament->title."</a>";
		echo"	</div>";
		$i++;
	}
}

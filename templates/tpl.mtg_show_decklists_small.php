<?php
$format = 0;
$i=0;
while ($ar = mysql_fetch_array($res)){
	if ($i % 2 == 0){$css_class = "suda";} else {$css_class = "licha";}
	if ($ar['decklist_format'] == 1){
		$format_title = "Standard";
	} elseif ($ar['decklist_format'] == 2){
		$format_title = "Modern";
	} elseif ($ar['decklist_format'] == 3){
		$format_title = "Extended";
	} elseif ($ar['decklist_format'] == 4){
		$format_title = "Legacy";
	} elseif ($ar['decklist_format'] == 5){
		$format_title = "Vintage";
	} elseif ($ar['decklist_format'] == 6){
		$format_title = "Commander";
	}
?>
	<div class="<?php echo $css_class; ?>" style="padding:4px;">
		<a href="index.php?action=decklist_show&lang=<?php echo $_GET['lang']; ?>&did=<?php echo $ar['decklist_id']; ?>" title="Formát: <?php echo $format_title;?> Od: <?php echo $ar['admin_nick']; ?>"><?php echo $ar['decklist_name']; ?></a>
	</div>
	<?php
	$i++;
}
?>

<div class="content_article_home_cont">
	<div class="content_article_home_text">
		<?php
		$format = 0;
		while ($ar = mysql_fetch_array($res)){
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
			
			if ($format < $ar['decklist_format']){
				echo "<br><h2>".$format_title."</h2>";
				$format = $ar['decklist_format'];
			}?>
			<div><?php echo FormatDatetime($ar['decklist_date_created'],"d.m.Y"); ?> - <strong><a href="index.php?action=decklist_show&lang=<?php echo $_GET['lang']; ?>&did=<?php echo $ar['decklist_id']; ?>"><?php echo $ar['decklist_name']; ?></a></strong><span style="color:grey;"> by <a href="index.php?action=decklists_his&lang=<?php echo $_GET['lang']; ?>&aid=<?php echo $ar['decklist_admin_id']; ?>"><?php echo $ar['admin_nick']; ?></a></span></div>
			<?php
		}
		?>
	</div>
</div>
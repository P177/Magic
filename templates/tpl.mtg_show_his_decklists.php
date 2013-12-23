<div class="content_article_home_cont">
	 <div class="content_article_home_text"><?php
		$user = new User($eden_cfg);
		echo $user->showUserDetails($_GET['aid'], "basic");?>
	</div>
	<div class="content_article_home_text"><?php
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
			<div><a href="index.php?action=decklist_show&lang=<?php echo $_GET['lang']; ?>&did=<?php echo $ar['decklist_id']; ?>"><?php echo $ar['decklist_name']; ?></a></div>
			<?php
		}
		?>
	</div>
</div>

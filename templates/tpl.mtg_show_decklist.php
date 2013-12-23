<div class="content_article_home_cont">
	<div class="content_article_home_text"><?php
		$user = new User($eden_cfg);
		echo $user->showUserDetails($ar['decklist_admin_id'], "basic");?>
	</div>
	<div class="content_article_home_text">
		<h2><?php echo $ar['decklist_name']; ?></h2>
		<p><strong>Formát: <?php echo $this->getDecklistFormatName($ar['decklist_format']); ?></strong></p>
		<p><?php echo $ar['decklist_description'];?></p>
		<?php 
		if ($_SESSION['loginid'] == $ar['decklist_admin_id']){?>
			<a href="index.php?action=decklist_edit&lang=<?php echo $_GET['lang']; ?>&did=<?php echo $ar['decklist_id']; ?>">Editovat decklist</a>
			<div class="clear"></div><?php
		}
		$main_decklist = $this->showDecklisCards($ar['decklist_id'], 1);
		$side_decklist = $this->showDecklisCards($ar['decklist_id'], 2); ?>
		<div style="width:198px; float:left;">
			<h3 style="font-size: medium">Main deck (<?php echo $main_decklist['num'];?> karet)</h3><p><?php
			echo $main_decklist['decklist'];
			?></p>
		</div>

		<div style="width:198px; float:left;">
			<h3 style="font-size: medium">Sideboard (<?php echo $side_decklist['num'];?> karet)</h3><p><?php
			echo $side_decklist['decklist'];
			?></p>
		</div>
		<div class="clear"></div>
	</div>
</div>
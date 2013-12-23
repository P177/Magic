<?php
$res_cards = mysql_query("SELECT decklist_card_id, decklist_card_decklist_id, decklist_card_num, mtg_card_id, mtg_card_mtg_id, mtg_card_name, mtg_card_set, mtg_card_set_code, mtg_card_type, mtg_card_variation 
FROM "._DB_MTG_DECKLISTS_CARDS." 
JOIN "._DB_MTG_CARDS." ON mtg_card_id = decklist_card_card_id 
WHERE  	decklist_card_decklist_id = ".(integer)$ar['decklist_id']." AND decklist_card_mode = 1
ORDER BY mtg_card_type ASC, mtg_card_name ASC 
") or die ("<strong>File:</strong> ".__FILE__."<br><strong>Line:</strong>".__LINE__."<br>".mysql_error());
$type = "";
$num_main = 0;?>
<div style="width:198px; float:left;">
	<h3 style="font-size: medium">Main deck</h3><p>
	<?php
	while ($ar_cards = mysql_fetch_array($res_cards)){
		$card_type = $this->getSimpleCardType($ar_cards['mtg_card_type']);
		$num_main = $num_main + $ar_cards['decklist_card_num'];
		if ($type != $card_type){
			echo "<h4>".$card_type."</h4>";
			$type = $card_type;
		}?>
		<span><?php echo $ar_cards['decklist_card_num']."x "?><a href="#" rel="magic,cz,mtgcard,<?php echo $ar_cards['mtg_card_id']; ?>" class="eden_hintbox_trigger"><?php echo $ar_cards['mtg_card_name']; ?></a> 
		<a href="#" style="color:#0000FF" onclick="$.ajax({
			type: 'POST',
			url: '<?php echo $this->eden_cfg['url_edencms']; ?>eden_ajax.php?project=<?php echo $this->eden_cfg['project'];?>',
			data: { 
				action: 'mtg_decklist_card_del', 
				decklist_id: '<?php echo $ar_cards['decklist_card_decklist_id']; ?>', 
				card_id: '<?php echo $ar_cards['decklist_card_id']; ?>'
			},	
			success: function(html) { 
    	        $('#htmlCardTarget').html(html);
	        } 
		});">x</a></span><br><?php
	}?></p>
	<p><span style="font-weight: bold">Karet: <?php echo $num_main;?></span><?php
		if ($ar['decklist_format'] == 8 && $num_main < 40){?>
			<br><span style="font-weight: bold;color:#ff0000;">Váš main deck není ještě kompletní. Musí obsahovat minimálně 40 karet.</span><?php
		} elseif ($num_main < 60){?>
			<br><span style="font-weight: bold;color:#ff0000;">Váš main deck není ještě kompletní. Musí obsahovat minimálně 60 karet.</span><?php
		}?>
	</p>
</div>

<?php
$res_cards = mysql_query("SELECT decklist_card_id, decklist_card_decklist_id, decklist_card_num, mtg_card_id, mtg_card_mtg_id, mtg_card_name, mtg_card_set, mtg_card_set_code, mtg_card_type, mtg_card_variation 
FROM "._DB_MTG_DECKLISTS_CARDS." 
JOIN "._DB_MTG_CARDS." ON mtg_card_id = decklist_card_card_id 
WHERE  	decklist_card_decklist_id = ".(integer)$ar['decklist_id']." AND decklist_card_mode = 2
ORDER BY mtg_card_type ASC, mtg_card_name ASC 
") or die ("<strong>File:</strong> ".__FILE__."<br><strong>Line:</strong>".__LINE__."<br>".mysql_error());
$type = "";
$num_side = 0;?>
<div style="width:198px; float:left;">
	<h3 style="font-size: medium">Sideboard</h3><p>
	<?php
	while ($ar_cards = mysql_fetch_array($res_cards)){
		$card_type = $this->getSimpleCardType($ar_cards['mtg_card_type']);
		$num_side = $num_side + $ar_cards['decklist_card_num'];
		if ($type != $card_type){
			echo "<h4>".$card_type."</h4>";
			$type = $card_type;
		}?>
		<span><?php echo $ar_cards['decklist_card_num']."x "?><a href="#<?php echo $ar_cards['mtg_card_id']; ?>" rel="magic,cz,mtgcard,<?php echo $ar_cards['mtg_card_id']; ?>" class="eden_hintbox_trigger"><?php echo $ar_cards['mtg_card_name']; ?></a>
		<a href="#" style="color:#0000FF" onclick="$.ajax({
			type: 'POST',
			url: '<?php echo $this->eden_cfg['url_edencms']; ?>eden_ajax.php?project=<?php echo $this->eden_cfg['project'];?>',
			data: { 
				action: 'mtg_decklist_card_del', 
				decklist_id: '<?php echo $ar_cards['decklist_card_decklist_id']; ?>', 
				card_id: '<?php echo $ar_cards['decklist_card_id']; ?>'
			},	
			success: function(html) { 
    	        $('#htmlCardTarget').replaceWith(html);
	        } 
		});">x</a></span><br><?php
	}?></p>
	<p><span style="font-weight: bold">Karet: <?php echo $num_side;?></span><?php
		if ($num_side > 0 && $num_side < 15){?>
			<br><span style="font-weight: bold;color:#ff0000;">Váš said deck není ještě kompletní. Musí obsahovat 0 nebo 15 karet.</span><?php
		} elseif ($num_side > 15){ ?>
			<br><span style="font-weight: bold;color:#ff0000;">Váš said deck má více jak povolených 15 karet.</span><?php
		}?></p>
</div>
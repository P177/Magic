<table class="eden_mtg_list" cellspacing="2" cellpadding="1">
	<tr>
		<td align="left" colspan="3">
			<?php echo Alphabeth('index.php?action=mtg_card_list&amp;letter=','', 0, 0); ?>
		</td>
	</tr>
	<tr class="eden_dictionary">
		<td class="eden_mtg_list_title_name"><?php echo _MTG_CARD_NAME; ?></td>
		<td class="eden_mtg_list_title_set"><?php echo _MTG_CARD_SET; ?></td>
		<td class="eden_mtg_list_title_manacost"><?php echo _MTG_CARD_MANA_COST; ?></td>
		<td class="eden_mtg_list_title_type"><?php echo _MTG_CARD_TYPES; ?></td>
	</tr><?php
$num = 0;
while($ar = mysql_fetch_array($res)){
	if ($num % 2 == 0){$class = "suda";} else { $class = "licha";}?>
		<tr class="<?php echo $class; ?>">
			<td class="eden_mtg_list_name"><a name="<?php echo $ar['mtg_card_id']; ?>"></a>
				<a href="<?php echo $this->eden_cfg['url']; ?>index.php?action=mtg_card_list&amp;id=<?php echo $ar['mtg_card_id']; ?>&amp;letter=<?php echo $card['letter']; ?>&amp;mode=<?php
			if ($card['mode'] == "open"	&& $card['id'] == $ar['mtg_card_id'] ){
				echo "close";
			} else { 
				echo "open";
			}?>
			#<?php echo $ar['mtg_card_id']; ?>" rel="magic,cz,mtgcard_full,<?php echo $ar['mtg_card_id']; ?>" class="eden_hintbox_trigger"><?php echo $ar['mtg_card_name']; ?></a>
			</td>
			<td class="eden_mtg_list_set"><?php echo $ar['mtg_card_set']; ?></td>
			<td class="eden_mtg_list_manacost"><?php echo MtGTranslateFromDB::transformStringToImgs($ar['mtg_card_manacost'],12,12); ?></td>
			<td class="eden_mtg_list_type"><?php echo $ar['mtg_card_type']; ?></td>
		</tr> 
<?php	
	if ($card['mode'] == "open" && $card['id'] == $ar['mtg_card_id']){?>
			<tr>
				<td class="eden_mtg_list_details" colspan="4"><?php
			    	$mtg_card = new MtGShowCard($this->eden_cfg);
					ob_start();
					$mtg_card->showCard($card['id']);
			    	$details = ob_get_contents();
			   		ob_end_clean();
					echo $details;?>
		
				</td>
			</tr><?php
	}
	$num++;
}
?>
</table>
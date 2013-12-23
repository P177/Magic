<table class="eden_mtg_card_details">
	<tr>
		<td class="eden_mtg_left_col">
			<div style="width:199px; height: 285px; border:10px solid #000000;border-radius:10px;-moz-border-radius:10px;">
				<img src="<?php echo _URL_MTG_CARDS.$ar_mtg_card['mtg_card_set_code']."/".toAscii($card_name).$ar_mtg_card['mtg_card_variation'];?>.full.jpg" width="199" height="285" border="0" alt="<?php echo $ar_mtg_card['mtg_card_name'];?>">
			</div>
		</td>
		<td class="eden_mtg_right_col">
			<div>
				<div class="eden_mtg_row">
					<div class="eden_mtg_label">
						Card Name:
					</div>
					<div class="eden_mtg_value eden_mtg_name">
						<?php echo $ar_mtg_card['mtg_card_name'];?>
					</div>
				</div>
<?php if (!empty($ar_mtg_card['mtg_card_manacost'])){?>
				<div class="eden_mtg_row">
					<div class="eden_mtg_label">
						Mana Cost:
					</div>
					<div class="eden_mtg_value"><?php	echo MtGTranslateFromDB::transformStringToImgs($ar_mtg_card['mtg_card_manacost'],21,21);?>&nbsp;</div>
				</div>

				<div class="eden_mtg_row">
					<div class="eden_mtg_label" style="font-size: 0.85em;">
						Converted Mana Cost:
					</div>
					<div class="eden_mtg_value">
						<?php echo $ar_mtg_card['mtg_card_converted_manacost'];?>
					</div>
				</div>
<?php }?>
				<div class="eden_mtg_row">
					<div class="eden_mtg_label">
						Types:
					</div>
					<div class="eden_mtg_value">
						<?php echo $ar_mtg_card['mtg_card_type'];?>
					</div>
				</div>
<?php if (!empty($ar_mtg_card['mtg_card_ability'])){?>
				<div class="eden_mtg_row">
					<div class="eden_mtg_label">
						Card Text:
					</div>
					<div class="eden_mtg_value eden_mtg_card_textbox">
						<?php echo MtGTranslateFromDB::transformStringToImgs($ar_mtg_card['mtg_card_ability'],12,12);?>
					</div>
				</div>
<?php }?>
<?php if (!empty($ar_mtg_card['mtg_card_flavor'])){?>
				<div class="eden_mtg_row">
					<div class="eden_mtg_label">
						Flavor Text:
					</div>
					<div class="eden_mtg_value">
						<div class="eden_mtg_card_textbox">							
							<?php echo MtGTranslateFromDB::transformStringToImgs($ar_mtg_card['mtg_card_flavor'],12,12);?>
						</div>
					</div>
				</div>
<?php }?>
<?php if (!empty($ar_mtg_card['mtg_card_toughness'])){?>
				<div class="eden_mtg_row">
					<div class="eden_mtg_label">
						Power/Toughness:
					</div>
					<div class="eden_mtg_value">
						<?php echo $ar_mtg_card['mtg_card_power']."/".$ar_mtg_card['mtg_card_toughness'];?>
					</div>
				</div>
 <?php }?>				
				<div class="eden_mtg_row">
					<div class="eden_mtg_label">
						Expansion:
					</div>
					<div class="eden_mtg_value">
						<?php echo $ar_mtg_card['mtg_card_set'];?>
					</div>
				</div>

				<div class="eden_mtg_row">
					<div class="eden_mtg_label">
						Rarity:
					</div>
					<div class="eden_mtg_value">
						<?php echo MtGTranslateFromDB::transformRarityCharToWords($ar_mtg_card['mtg_card_rarity']);?>&nbsp;
					</div>
				</div>
				<div class="eden_mtg_row">
					<div class="eden_mtg_label">
						All Sets:
					</div>
					<div class="eden_mtg_value">
						<?php echo MtGTranslateFromDB::showSets($ar_mtg_card['mtg_card_name']);?>
					</div>
				</div>

				<div class="eden_mtg_row">
					<div class="eden_mtg_label">
						Card #:
					</div>
					<div class="eden_mtg_value">
						<?php echo $ar_mtg_card['mtg_card_number'];?>
					</div>
				</div>

				<div class="eden_mtg_row">
					<div class="eden_mtg_label">
						Artist:
					</div>
					<div class="eden_mtg_value">
						<?php echo $ar_mtg_card['mtg_card_artist'];?>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>
<?php  
//***********************************************
//     Pocitani stranek - Novinky                
//***********************************************
	// Pokud je novinek vice, nezli se vejde na 1 stranku zobrazi se jejich pocitani a prechazeni mezi nima 
	if ($stw2 > 1){ 
		echo '<tr>
				<td align="center" valign="top" colspan="6" width="490">';
			//Zobrazeni cisla poctu stranek
		for ($i=1;$i<=$stw2;$i++) {
			/*if ($_GET['page']==$i) {
				echo ' <strong>'.$i.'</strong> ';
			} elseif ($i==1 || $i==($_GET['page']-4) || $i==($_GET['page']-3)|| $i==($_GET['page']-2) || $i==($_GET['page']-1) || $i==($_GET['page']+1) || $i==($_GET['page']+2) || $i==($_GET['page']+3) || $i==($_GET['page']+4) || $i==$stw2) {
				echo ' <a href="'.$PHP_SELF.'?lang='.AGet($_GET,'lang').'&amp;page='.$i.'&amp;action='.AGet($_GET,'action').'">'.$i.'</a> ';
			}*/
		}
		//Zobrazeni sipek s predchozimi a dalsimi strankami novinek
		if ($_GET['page'] > 1){echo '<br><a href="index.php?lang='.AGet($_GET,'lang').'&amp;filter='.AGet($_GET,'filter').'&amp;page='.$pp.'&amp;action='.AGet($_GET,'action').'&amp;cw_game='.$_GET['cw_game'].'">'._CMN_PREVIOUS.'</a>';} else {echo '<br>'._CMN_PREVIOUS;}?> <--|--> <?php  if ($_GET['page'] == $stw2){echo _CMN_NEXT;} else {echo '<a href="index.php?lang='.AGet($_GET,'lang').'&amp;filter='.AGet($_GET,'filter').'&amp;page='.$np.'&amp;action='.AGet($_GET,'action').'&amp;cw_game='.$_GET['cw_game'].'">'._CMN_NEXT.'</a>';}
		echo'</td></tr>';
	}?>
</table><?php  
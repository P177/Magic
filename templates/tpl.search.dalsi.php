<?php  
echo '<tr>
		<td align="center" valign="top" colspan="3" width="620">';
	//Zobrazeni cisla poctu stranek
for ($i=1;$i<=$stw2;$i++) {
	if ($_GET['page']==$i) {
		echo ' <strong>'.$i.'</strong> ';
	} elseif ($i == 1 || $i == ($_GET['page'] - 4) || $i == ($_GET['page'] - 3)|| $i == ($_GET['page']-2) || $i == ($_GET['page'] - 1) || $i == ($_GET['page'] + 1) || $i == ($_GET['page'] + 2) || $i == ($_GET['page'] + 3) || $i == ($_GET['page'] + 4) || $i == $stw2) {
		echo ' <a href="index.php?lang='.AGet($_GET,'lang').'&amp;filter='.AGet($_GET,'filter').'&amp;page='.$i.'&amp;action='.AGet($_GET,'action').'&podminka='.$podminka.'&retezec='.$retezec.'&search_choice='.$search_choice.'">'.$i.'</a> ';
	}
}
//Zobrazeni sipek s predchozimi a dalsimi strankami novinek
if ($_GET['page'] > 1){echo '<br><a href="index.php?lang='.AGet($_GET,'lang').'&amp;filter='.AGet($_GET,'filter').'&amp;page='.$pp.'&amp;action='.AGet($_GET,'action').'&podminka='.$podminka.'&retezec='.$retezec.'&search_choice='.$search_choice.'">'._CMN_PREVIOUS.'</a>';} else {echo '<br>'._CMN_PREVIOUS;} echo' <--|--> '; if ($_GET['page'] == $stw2){echo _CMN_NEXT;} else {echo '<a href="index.php?lang='.AGet($_GET,'lang').'&amp;filter='.AGet($_GET,'filter').'&amp;page='.$np.'&amp;action='.AGet($_GET,'action').'&podminka='.$podminka.'&retezec='.$retezec.'&search_choice='.$search_choice.'">'._CMN_NEXT.'</a>';}
echo '</td>
</tr>';?>
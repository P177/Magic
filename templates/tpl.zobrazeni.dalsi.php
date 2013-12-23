<?php  
echo '<table border="0" cellpadding="0" cellspacing="0"><tr>
		<td width="524" align="left" valign="top" colspan="2">';
	//Zobrazeni cisla poctu stranek
for ($i=1;$i<=$stw2;$i++) {
	if ($_GET['page']==$i) {
		echo ' <strong>'.$i.'</strong> ';
	} elseif ($i==1 || $i==($_GET['page']-4) || $i==($_GET['page']-3)|| $i==($_GET['page']-2) || $i==($_GET['page']-1) || $i==($_GET['page']+1) || $i==($_GET['page']+2) || $i==($_GET['page']+3) || $i==($_GET['page']+4) || $i==$stw2) {
		echo ' <a href="'.$PHP_SELF.'?action='.AGet($_GET,'action').'&amp;lang='.AGet($_GET,'lang').'&amp;filter='.AGet($_GET,'filter').'&amp;page='.$i.'&amp;hits='.$hits.'&amp;page_mode='.AGet($_GET,'page_mode').'">'.$i.'</a> ';
	}
}
//Zobrazeni sipek s predchozimi a dalsimi strankami novinek
if ($_GET['page'] > 1){echo '<br><a href="'.$PHP_SELF.'?action='.AGet($_GET,'action').'&amp;lang='.AGet($_GET,'lang').'&amp;filter='.AGet($_GET,'filter').'&amp;page='.$pp.'&amp;hits='.$hits.'&amp;page_mode='.AGet($_GET,'page_mode').'">'._CMN_PREVIOUS.'</a>';} else {echo '<br>'._CMN_PREVIOUS;}?> <--|--> <?php  if ($_GET['page'] == $stw2){echo _CMN_NEXT;} else {echo '<a href="'.$PHP_SELF.'?action='.AGet($_GET,'action').'&amp;lang='.AGet($_GET,'lang').'&amp;filter='.AGet($_GET,'filter').'&amp;page='.$np.'&amp;hits='.$hits.'&amp;page_mode='.AGet($_GET,'page_mode').'">'._CMN_NEXT.'</a>';}
echo'</td></tr></table>';

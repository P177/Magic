<?php  
//***********************************************
//     Pocitani stranek - Novinky                
//***********************************************
	//Zobrazeni sipek s predchozimi a dalsimi strankami novinek
	echo '<div style="width:348px; text-align:center;">'; 
	if ($_GET['page'] > 1){echo '<br><a href="index.php?lang='.AGet($_GET,'lang').'&amp;filter='.AGet($_GET,'filter').'&amp;page='.$pp.'&amp;action='.AGet($_GET,'action').'&amp;page_mode='.AGet($_GET,'page_mode').'">'._CMN_PREVIOUS.'</a>';} else {echo '<br><span style="color: #000000;">'._CMN_PREVIOUS.'</span>';} echo' <span style="color: #000000;"><--|--></span> '; if ($_GET['page'] == $stw2){echo '<span style="color: #000000;">'._CMN_NEXT.'</span>';} else {echo '<a href="index.php?lang='.AGet($_GET,'lang').'&amp;filter='.AGet($_GET,'filter').'&amp;page='.$np.'&amp;action='.AGet($_GET,'action').'&amp;page_mode='.AGet($_GET,'page_mode').'">'._CMN_NEXT.'</a>';}
	echo '</div>';
?>
			
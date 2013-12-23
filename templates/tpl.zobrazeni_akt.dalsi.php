<?php  
//***********************************************
//     Pocitani stranek - News              
//***********************************************
echo '<div style="width:250px; text-align:center;">';
		//Zobrazeni sipek s predchozimi a dalsimi strankami novinek
		if ($_GET['akt_page'] > 1){echo '<br><a href="index.php?lang='.AGet($_GET,'lang').'&amp;filter='.AGet($_GET,'filter').'&amp;akt_page='.$akt_pp.'&amp;action='.AGet($_GET,'action').'&amp;page_mode='.AGet($_GET,'page_mode').'">'._CMN_PREVIOUS.'</a>';} else {echo '<br>'._CMN_PREVIOUS;} echo' <--|--> '; if ($_GET['akt_page'] == $akt_stw2){echo _CMN_NEXT;} else {echo '<a href="index.php?lang='.AGet($_GET,'lang').'&amp;filter='.AGet($_GET,'filter').'&amp;akt_page='.$akt_np.'&amp;action='.AGet($_GET,'action').'&amp;page_mode='.AGet($_GET,'page_mode').'">'._CMN_NEXT.'</a>';}
echo '</div>';?>
			
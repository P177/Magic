<div class="content_article_home_cont">
	<div class="content_article_home_text">
		<?php
		while ($ar = mysql_fetch_array($res)){
                echo"   <div class = \"content_template_col_text\">";
                echo"       <h2 class=\"center\">".$ar['tournament_name']."</h2><br/>";
                echo"       <table>\n";
                echo"           <tr>\n";
                echo"               <td><strong>Formát: </strong></td><td>".$this->tournamentFormat($ar['tournament_format'])."</td>\n";
                echo"           </tr>\n";
                echo"           <tr>\n";
                echo"               <td><strong>Datum: </strong></td><td>".$ar['tournament_date']."</td>\n";
                echo"           </tr>\n";
                echo"           <tr>\n";
                echo"               <td><strong>Začátek: </strong></td><td>".$ar['tournament_time']."</td>\n";
                echo"           </tr>\n";
                echo"           <tr>\n";
                echo"               <td><strong>Registrace: </strong></td><td>".$ar['tournament_registration_start']."</td>\n";
                echo"           </tr>\n";
                echo"           <tr>\n";
                echo"               <td><strong>Vstupné: </strong></td><td>".$ar['tournament_buyin']."</td>\n";
                echo"           </tr>\n";
                echo"           <tr>\n";
                echo"               <td><strong>Ceny: </strong></td><td>".$ar['tournament_prizes']."</td>\n";  
                echo"           </tr>\n";
                echo"       </table>\n"; 
                echo"   <p>\n";
                echo"   ".$ar['tournament_description']."";
                echo"   <p>\n";
                echo"   </div>\n";
		}
		foreach ($tournaments as $tournament){
                echo"           <table class=\"tournament_najada\">\n";
                echo"               <tr>\n";
                echo"                  <td colspan=\"2\" style=\"width:250px;\"><strong>Název: <span style=\"color:#b0ad40;\">".$tournament->title."</span></strong></td>\n";
                echo"                  <td colspan=\"2\"><strong>Cena: </strong>".$tournament->prices."</td>\n";
                echo"               </tr>\n";
                echo"               <tr>\n";
				echo"					<td style=\"width:100px\"><strong>Datum: </strong>".$tournament->date."</td>\n";
                echo"                   <td style=\"width:100px\"><strong>Začátek: </strong>".$tournament->start."</td>\n";
				echo"                   <td style=\"width:150px\"><strong>Vstupné: </strong>".$tournament->fee."</td>\n";
                echo"                   <td><strong>Formát: </strong>".$tournament->format."</td>\n";
                echo"               </tr>\n";
                echo"           </table>\n";
		}
		?>
	</div>
</div>


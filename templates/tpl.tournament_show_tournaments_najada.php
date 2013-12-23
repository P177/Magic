<?php
		$najada .= "<p>";
			$najada .= "<strong>ID: </strong>".$tournament->id."<br>";
			$najada .= "<strong>Datum: </strong>".$tournament->date."<br>";
			$najada .= "<strong>Název: </strong>".$tournament->title."<br>";
			$najada .= "<strong>Formát: </strong>".$tournament->format."<br>";
			$najada .= "<strong>Registrace: </strong>".$tournament->registration."<br>";
			$najada .= "<strong>Start: </strong>".$tournament->start."<br>";
			$najada .= "<strong>Polpatek: </strong>".$tournament->fee."<br>";
			$najada .= "<strong>Ceny: </strong>".$tournament->prices."<br>";
			$najada .= "</p>";
		
		foreach ($tournaments as $tournament){
                //echo"           <table class=\"tournament_najada\" onclick=\"location.href='index.php?action=tournament&amp;tid=".$tournament->id."'\" onmouseover=\"this.className='tournament'\" onmouseout=\"this.className='tournament_najada'\">\n";
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
/*
Datum:
Název:
Formát:
Registrace:
Start:
Polpatek:
Ceny:


Format ve tvaru:
Double Draft
Draft
Extended
Highlander
Legacy
Modern
Standard
Vintage
*/
<span class="nadpis"><?php echo $ar2['category_name'];?></span><br><?php  
		while ($ar = mysql_fetch_array($res)){
			echo '<strong>'.$ar['links_name'].'</strong> - <a href="'.$ar['links_link'].'" target="_blank">'.$ar['links_link'].'</a><br>';
			echo $ar['links_description'];
			echo '<br><br>';
		}?>
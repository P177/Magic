<table cellspacing="0" cellpadding="3" border="0">
	<tr>
		<td width="620" align="left" valign="top" colspan="2"><br><?php  if (!isset($article_perex) || $article_perex != ""){echo $article_perex; $rest = substr ($article_perex, -4); $rest2 = substr ($article_perex, -3); if ($rest != "</p>" || $rest2 != "<br>"){echo "<br>";}}?>
			<?php echo $article_text;?></td>
	</tr>
</table>
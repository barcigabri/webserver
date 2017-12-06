<?
echo("<!DOCTYPE html>");
echo("<html>");
	echo("<body>");
		
		if(isset($_GET["numero"]))
			$valore=$_GET["numero"];
		else
		{			
			echo("Non hai messo l'attributo, imposto 10 in automatico");
			echo("</br>");
			$valore=10;
		}
		if(isset($_GET["colore"]))				
			$colore=$_GET["colore"];
		else
		{
			echo("Non hai messo il colore, imposto rosso in automatico");
			echo("</br>");
			$colore="red";
		}
		if(isset($_GET["divisore"]))
			$div=$_GET["divisore"];
		else
		{
			echo("Non hai messo il divisore, imposto rosso in automatico");
			echo("</br>");
			$div=3;
		}
		echo("<table style='border:1px solid;'>");
		for($riga=1;$riga<=$valore;$riga++)
		{
			echo("<tr>");
			for($colonna=1;$colonna<=$valore;$colonna++)
			{	
				if(($colonna*$riga)%$div==0)
					echo("<td style='border:1px solid ".$colore.";background-color:yellow'>");
				else
					echo("<td style='border:1px solid ".$colore."'>");
				echo($colonna*$riga);
				echo("</td>");
			}
			echo("</tr>");
		}
		echo("</table>");
	echo("</body>");
echo("</html>");
?>
<html>
	<head>
		<title>Ricerca</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script>
			function controllo_campi()
			{
				var valore=document.getElementById("lim").value;
				var esito=false;
				var verifica=/^\d{1,2}$/
				if(document.getElementById("lim").value!=""&&document.getElementById("cit").value!=""&&document.getElementById("que").value!="")
					if(valore.match(verifica)&&parseInt(valore)<51)
						esito=true;
				return esito;
			}
		</script>
	</head>
	<body>
		<?php
			if(isset($_POST["lim"]))
			{
				$lim=$_POST["lim"];
			}
			else
			{
				$lim=10;
			}
			if(isset($_POST["cit"]))
			{
				$cit=$_POST["cit"];
			}
			else
			{
				$cit="bergamo";
			}
			if(isset($_POST["que"]))
			{
				$que=$_POST["que"];
			}
			else
			{
				$que="pizzeria";
			}
			# Questo script chiama un'API e la inserisce in una tabella 
			# Indirizzo dell'API da richiedere
			$indirizzo_pagina="https://api.foursquare.com/v2/venues/search?v=20161016&query=$que&limit=$lim&intent=checkin&client_id=YVMN1NGHAW4DWINOY2BHBVQTGR0RG01D4EVZ3Z3TPRN5EBE2&client_secret=GYRAVQCTVV5DUYI3J3OH2GKLQN5S2LEA0QIGECJ1MUFBTX2X&near=$cit";
			# Codice di utilizzo di cURL
			# Chiama l'API e la immagazzina in $json
			$ch = curl_init() or die(curl_error());
			curl_setopt($ch, CURLOPT_URL,$indirizzo_pagina);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$json=curl_exec($ch) or die(curl_error());
			# Decodifico la stringa json e la salvo nella variabile $data
			$data = json_decode($json);
			# Stampa della tabella delle pizzerie.
			echo "<table>";
				echo "<tr>";
					echo "<th>NOME</th>";
					echo "<th>LATITUDINE</th>";
					echo "<th>LONGITUDINE</th>";
				echo "</tr>";
				for($i=0; $i<$lim; $i++)
				{	
					echo "<tr>";
						echo "<td>";
						echo $data->response->venues[$i]->name;
						echo "</td>";
						echo "<td>";
						echo $data->response->venues[$i]->location->lat;
						echo "</td>";
						echo "<td>";
						echo $data->response->venues[$i]->location->lng;
						echo "</td>";
					echo "</tr>";
				}
			echo "</table>";
			# Stampa di eventuali errori
			echo curl_error($ch);
			curl_close($ch);
			
			echo "<form id='forma' method='post' onsubmit='return controllo_campi();'><br/>";
			echo "<table>";
			echo "<tr>";
			echo " <td>Numero elementi (1-50): </td><td><input type='text' value='$lim' name='lim'id='lim' /></td>";
			echo "</tr>";
			echo "<tr>";
			echo " <td>Citta: </td><td><input type='text' value='$cit' name='cit' id='cit' /></td>";
			echo "</tr>";
			echo "<tr>";
			echo " <td>Cosa stai cercando?: </td><td><input type='text' value='$que' name='que' id='que' /></td><br/>";
			echo "</tr>";
			echo "</table>";
			echo " <input type='submit' value='Aggiorna tabella' class='btn'/>";
			echo "</form>";
		?>
	</body>
</html>
Credit to Gabriele Barcella

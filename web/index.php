<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script>
			function controllo_campi()
			{
				var valore=document.getElementById("lim").value;
				var esito=false;
				var verifica=/^\d{1,2}$/
				if(document.getElementById("lim").value!=""&&document.getElementById("cit").value!=""&&document.getElementById("que").value!="")
					if(valore.match(verifica))
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
				for($i=0; $i<3; $i++)
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
		?>
		<form id="forma" method="post" onsubmit="return controllo_campi();>
			Numero elementi (1-50)<input type="text" value="10" name="lim" id="lim" />
			Citta' <input type="text" value="Bergamo" name="cit" id="cit" />
			Cosa stai cercando? <input type="text" value="pizzeria" name="que" id="que" />
			<input type="submit" value="Aggiorna tabella" />
		</form>
	</body>
</html>

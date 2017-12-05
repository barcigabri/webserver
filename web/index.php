<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php

			# Questo script chiama un'API e la inserisce in una tabella 


			# Indirizzo dell'API da richiedere
			$indirizzo_pagina="https://api.foursquare.com/v2/venues/search?v=20161016&query=pizzeria&limit=3&intent=checkin&client_id=YVMN1NGHAW4DWINOY2BHBVQTGR0RG01D4EVZ3Z3TPRN5EBE2&client_secret=GYRAVQCTVV5DUYI3J3OH2GKLQN5S2LEA0QIGECJ1MUFBTX2X&near=Bergamo%2CIT";

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
	</body>
</html>

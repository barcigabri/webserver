<?php

# Questo script chiama una pagina dal web come se fosse un browser, 
# e poi la immagazzina in una variabile

# Indirizzo della pagina da richiamare
$indirizzo_pagina="https://api.foursquare.com/v2/venues/search?v=20161016&query=pizzeria&limit=3&intent=checkin&client_id=YVMN1NGHAW4DWINOY2BHBVQTGR0RG01D4EVZ3Z3TPRN5EBE2&client_secret=GYRAVQCTVV5DUYI3J3OH2GKLQN5S2LEA0QIGECJ1MUFBTX2X&near=Bergamo%2CIT";

# Codice di utilizzo di cURL. 
# Chiama la pagina e la immagazzina in $data
$ch = curl_init() or die(curl_error());
curl_setopt($ch, CURLOPT_URL,$indirizzo_pagina);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$json=curl_exec($ch) or die(curl_error());
#decodifico
$data = json_decode($json);
# Stampa della variabile $data. 
echo $data->response->venues[0]->name;

# Stampa di eventuali errori
echo curl_error($ch);
curl_close($ch);
?>

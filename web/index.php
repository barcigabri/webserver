<?php

# Questo script chiama una pagina dal web come se fosse un browser, 
# e poi la immagazzina in una variabile

# Indirizzo della pagina da richiamare
$indirizzo_pagina="www.giacobbe85.altervista.org";

# Codice di utilizzo di cURL. 
# Chiama la pagina e la immagazzina in $data
$ch = curl_init() or die(curl_error());
curl_setopt($ch, CURLOPT_URL,$indirizzo_pagina);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data=curl_exec($ch) or die(curl_error());

# Stampa della variabile $data. 
echo $data;

# Stampa di eventuali errori
echo curl_error($ch);
curl_close($ch);
?>

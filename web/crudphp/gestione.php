<script>

	function passa_a(valore)
	{
		document.getElementById("stato").value=valore;
		document.getElementById("forma").submit();
	}
	function concatena()
	{
		
		var txt;
		if(document.getElementById("adm").checked)
		    txt=document.getElementById("user").value+";"+document.getElementById("pass").value+";A"+'\n';
		else
			txt=document.getElementById("user").value+";"+document.getElementById("pass").value+";U"+'\n';
		document.getElementById("testo").value=txt;
		//alert(document.getElementById("testo").value);
		document.getElementById("stato").value=4;
		document.getElementById("forma").submit();
		//alert("stop");
	}

	function passa_aa(valore)
	{
		
		document.getElementById("app").value=document.getElementById("eli").value;
		if(document.getElementById("app").value<0||document.getElementById("app").value>document.getElementById("num").value)
		{
			alert("inserire un valore valido!");
			valore--;
		}
		//alert(document.getElementById("app").value)
		document.getElementById("stato").value=valore;
		document.getElementById("forma").submit();
	}
	function logout()
	{
		<?
			echo "window.open('/crudphp','_self');";
		?>
	}
</script>

<head>
	<title>GESTIONE</title>
</head>

<?
	
		
		if(isset($_POST["stato"])&&!empty($_POST["stato"]))
		{
			$stato=$_POST["stato"];
		}
		else
		{
			$stato=0;
			
		}
		echo("<form name='forma' id='forma' method='post'>");
		echo("<input type='hidden' name='stato' id='stato'>");
		switch($stato)
		{
			
			case 0:
					echo("MENU PRINCIPALE<br/>");
					echo("<input type='button' value='Elenco utenti' onclick='passa_a(1);'><br/>");
					echo("<input type='button' value='Gestisci utenti' onclick='passa_a(2);'><br/>");
					echo("<input type='button' value='Logout' onclick='logout();'><br/>");
					break;
			case 1:
					echo("ELENCO UTENTI<br/>");
					if (($handle = fopen("utenti.csv", "r"))) 
						{
						while ($riga = fgetcsv($handle, 1000, ";")) 
							{
								for($k=0;$k<count($riga);$k++)
								   echo($riga[$k]." - ");
								echo("<br/><hr>");
							}
						fclose($handle);
						}		
					else
						echo "non riesco ad aprire il file, mannaggia!";				
					echo("<input type='button' value='Torna al MENU' onclick='passa_a(0);'><br/>");
					
					break;
			case 2:
					echo("GESTIONE UTENTI<br/>");
					echo("<input type='button' value='Inserisci Utente' onclick='passa_a(3);'><br/>");
					echo("<input type='button' value='Elimina Utente' onclick='passa_a(5);'><br/>");
					echo("<input type='button' value='Modifica Utente' onclick='passa_a(7);'><br/>");
					echo("<input type='button' value='Torna al MENU' onclick='passa_a(0);'><br/>");
					
					break;
			case 3:
					
					echo("Username: <input type='text' value='' id='user'><br/>");
					echo("Password: <input type='password' value='' id='pass'><br/>");
					echo("<input type='checkbox' id='adm'> Amministratore<br/>");
					echo("<input type='hidden' name='testo' id='testo'>");
					echo("<input type='button' value='Inserisci Utente' onclick='concatena();'><br/>");
					
					break;
			case 4:
					$se=0;
					$testo=$_POST["testo"];
					$username=explode(";",$testo);
					
					if (($handle = fopen("utenti.csv", "r"))) 
					{
						while ($riga = fgetcsv($handle, 1000, ";")) 
							{
								if($riga[0]==$username[0])
									$se=1;
							}
						fclose($handle);
						}		
					else
						echo "non riesco ad aprire il file, mannaggia!";
					if (($handle = fopen("utenti.csv", "a"))&&$se==0) 
					{
						fwrite($handle,$testo);
						fclose($handle);
					}		
					else
						echo "L'user è gia presente!";
					
					$dati=explode(";",$testo);
					if($se==0)
					{
					echo "Inserito l'utente con queste caratteristiche:<br/>";
					echo("Username: $dati[0]<br/>");
					echo("Password: $dati[1]<br/>");
					}
					echo("<input type='button' value='Torna al MENU' onclick='passa_a(0);'><br/>");
					
					break;
			case 5:
					echo("ELIMINA UTENTI<br/>");
					$line=0;
					if (($handle = fopen("utenti.csv", "r"))) 
					{
						while ($riga = fgetcsv($handle, 1000, ";")) 
						{
								
								$line++;
								echo "$line: ";
								for($k=0;$k<count($riga);$k++)
								   echo($riga[$k]." - ");
								echo("<br/><hr>");
						}
						fclose($handle);
					}		
					else
						echo "non riesco ad aprire il file, mannaggia!";				
					echo("Inserisci il numero della riga che vuoi eliminare: <input type='number' name='quantity' min='1' max='$line' name='eli' id='eli'><br/>");
					echo("<input type='hidden' name='app' id='app'>");
					echo("<input type='hidden' value='$line' name='num' id='num'>");
					echo("<input type='button' value='Elimina' onclick='passa_aa(6);'><br/>");
					echo("<input type='button' value='Torna al MENU' onclick='passa_a(0);'><br/>");
					
					break;
			case 6:
					echo "HO ELIMINATO L'UTENTE!<br/>";
					
						$campo=$_POST["app"]-1;
						$a=0;
						$handle2 = fopen('appo.csv', "w");
						if (($handle = fopen("utenti.csv", "r"))) 
								{
								while ($riga = fgets($handle)) 
								{
									if($a!=$campo)
										fwrite($handle2,$riga);
									$a=$a+1;
								}
								fclose($handle);
								}		
							else
								echo "non riesco ad aprire il file, mannaggia!";
						fclose($handle2);
						unlink("utenti.csv");
						rename("appo.csv","utenti.csv");
				
				
				
					
					echo("<input type='button' value='Elimna un altro utente' onclick='passa_a(5);'><br/>");
					echo("<input type='button' value='Torna al MENU' onclick='passa_a(0);'><br/>");
					break;
			case 7:
					echo("MODIFICA UTENTI<br/>");
					$line=0;
					if (($handle = fopen("utenti.csv", "r"))) 
					{
						while ($riga = fgetcsv($handle, 1000, ";")) 
						{
								
								$line++;
								echo "$line: ";
								for($k=0;$k<count($riga);$k++)
								   echo($riga[$k]." - ");
								echo("<br/><hr>");
						}
						fclose($handle);
					}		
					else
						echo "non riesco ad aprire il file, mannaggia!";				
					echo("Inserisci il numero della riga che vuoi modificare: <input type='number' name='quantity' min='1' max='$line' name='eli' id='eli'><br/>");
					echo("Nuova password: <input type='text' value='' name='password' id='password'><br/>");
					echo("<input type='hidden' name='app' id='app'>");
					echo("<input type='hidden' value='$line' name='num' id='num'>");
					echo("<input type='button' value='Modifica' onclick='passa_aa(8);'><br/>");
					echo("<input type='button' value='Torna al MENU' onclick='passa_a(0);'><br/>");
					break;
			case 8:
					
					
						$campo=$_POST["app"]-1;
						$npass=$_POST["password"];
						//echo "pass:$npass";
						$a=0;
						$handle2 = fopen('appo.csv', "w");
						if (($handle = fopen("utenti.csv", "r"))) 
						{
							while ($riga = fgets($handle)) 
							{
								if($a!=$campo)
									fwrite($handle2,$riga);
								else
								{
									$riga[strlen($riga)]=';';
									$nuova=explode(";",$riga);
									$nuova[1]=$npass;
									fwrite($handle2,$nuova[0].';'.$nuova[1].';'.$nuova[2]);
								}
								$a=$a+1;
							}
							fclose($handle);
							}		
						else
							echo "non riesco ad aprire il file, mannaggia!";
					fclose($handle2);
					unlink("utenti.csv");
					rename("appo.csv","utenti.csv");
				
				
				
					echo "HO MODIFICATO L'UTENTE $nuova[0]!<br/>";
					echo("<input type='button' value='Modifica un altro utente' onclick='passa_a(7);'><br/>");
					echo("<input type='button' value='Torna al MENU' onclick='passa_a(0);'><br/>");
					break;
		}
		echo("</form>");
		echo("</body>");
?>

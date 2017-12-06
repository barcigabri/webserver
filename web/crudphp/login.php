<html>
	<head>
		<title>Login</title>
		<script>
			function login()
			{
				<?
					$controllo=0;
					if(isset($_POST["user"])&&isset($_POST["pass"]))
					{
						$username=$_POST["user"];
						//echo("alert('Mi hai passato [".$username."]');");
						$password=$_POST["pass"];
						//echo("alert('Mi hai passato [".$password."]');");
					
						if (($handle = fopen("utenti.csv", "r"))) 
						{
							
							while (($riga = fgetcsv($handle, 1000, ";","\n"))&&($controllo!=1)) 	
							{	
								
								
								//echo ("alert('$riga[2]');");
								//echo("alert('PROVA [".$riga[2]."]');");
									if($riga[0]==$username&&$riga[1]==$password)
									{
										$controllo=1;
										$admin=$riga[2];
										
										if($admin=='A')
											echo "window.open('gestione.php','_self');";
											//echo ("alert('$riga[2]');");
										else
											echo "window.open('pubblica.html','_self');";
											//echo ("alert('$riga[2]');");
									}
									
							}
							fclose($handle);
							if($controllo==0)
							{
								echo 'alert("Username o password errati!");';
								echo "window.open('/crudphp','_self');";
							}
						}
						else
							echo "non riesco ad aprire il file, mannaggia!";
					}
					else
						echo "window.open('/crudphp','_self');";
						//echo 'alert("provalog");';
				?>

			}
		</script>
	</head>
	<body onload='login();'>
	</body>
</html>
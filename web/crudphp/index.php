<!DOCTYPE html>
<html>
	<head>
		<title>PAGINA DI ACCESSO</title>
		<script>
			function controllo()
			{
				var esito=false;
				if(document.getElementById("testo").value!=""&&document.getElementById("pass").value!="")
					esito=true;
				return esito;
			}
		</script>
	</head>
	<body>
		<form id="forma" method="post" action="login.php" onsubmit="return controllo();">
			username <input type="text" name="user" id="user" />
			password <input type="password" name="pass" id="pass" />
			<input type="submit" value="Invia i dati" />
		</form>
	</body>
</html>
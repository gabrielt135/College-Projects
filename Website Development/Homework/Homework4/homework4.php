<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Thank you!</title>
		<meta charset = "utf-8"/>
		<meta name = "author" content = "Gabriel Taveras"/>
		<link href = "homework4.css" type = "text/css" rel = "stylesheet"/>
	</head>
	
	<body>
		<?php
		$user = $_GET["username"];
		$email = $_GET["email"];
		$subject = $_GET["subject"];
		$reason = $_GET["Reason"];

		?>
		
		<p class = "object">
			Thank you, <?=$user?> for submitting your problem. we will get to your <?=$reason?> problem as quick as possible.
	
			<br/>
			
			Subject: <?=$subject?><br/>
			Email: <?=$email?>
		</p>
		
		<p class = "aboot">
			For this webpage (and the one before used to send the data) was made using forms, actions and the $_GET query in order to send the data to another .php file. <br/>
			<br/>
			And yes before anyone asks; yes the webpages are supposed to be this unappealing and bland.
		</p>
	</body>
</html>
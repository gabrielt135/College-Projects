<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Tournament Sign-up Form</title>
		<meta charset = "UTF-8"/>
	</head>
	
	<body>
	<?php
		$choice = array("contestant","Spectator");
	?>
		<form action = "Sign-up_Submit.php" method = "post">
			<fieldset>
			<legend>Sign-up form</legend>
				Fist Name: <input name = "FIrst_Name" size = "10"/> Last Name: <input name = "Last_Name" size = "10"/>
				<br/>
				Age: <input name = "Age" size = "6"/>
				<br/>
				<label><input type = "radio" name = "choice" value = "<?=$choice[0]?>"/>Contestant</label>
				<label><input type = "radio" name = "choice" value = "<?=$choice[1]?>" checked = "checked"/>Spectator<label>
				<br/>
				
			</fieldset>
		</form>
	
	</body>
</html>

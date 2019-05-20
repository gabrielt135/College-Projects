<!-- Author: Gabriel Taveras -->
<!DOCTYPE html>
<html>
	<head>
		<title>Verification Submit</title>
		<link href = "game.css" type = "text/css" rel = "stylesheet"/>
	</head>
	<body>
		<div class="content">
	<img src="banner.jpg" class = "ban" alt="Game" />
			<div class = "rev">
			<img src="banner.jpg" class = "ban1" alt="Game" />
			</div>
			<br/>
	<ul>
	<li><a href="game.html">Home</a></li>
  <li><a href="Sign-up.html">Register</a></li>
  <li><a href="GamePage.html">Games</a></li>
  <li><a href="Verification.html">Entry</a></li>
  <li><a href="AboutPage.php">About</a></li>
</ul>
		<?php
			$ID = $_GET["ID"];
			
			$attendees = file("Attendees.txt",FILE_IGNORE_NEW_LINES);
			$attendees_count = count($attendees);
			
			$same = NULL;
			$otherIDs = "";
			for($i = 0; $i < $attendees_count; $i++)
			{
				$buffer = explode(",",$attendees[$i]);
				$otherIDs = $buffer[0];
				if ($otherIDs == $ID){
					$same = $attendees[$i];
				}
			}
			
			if($same == NULL){
			?>
				<p>You do not exist in our database</p>
			<?php
			}
			else{	
			$exsame = explode(",",$same);
			$IDsame = $exsame[0];
			$Namesame = $exsame[1];
			$Aliassame = $exsame[2];
			$Agesame = $exsame[3];
			$emailsame = $exsame[4];
			?>
			<p>
			This is you correct? <br/>
			ID: <?=$IDsame?> <br/>
			Name: <?=$Namesame?> <br/>
			Age: <?=$Agesame?> <br/>
			Alias: <?=$Aliassame?> <br/>
			Email: <?=$emailsame?> <br/>
			</p>
		<?php
			}
		?>
	</body>
</html>
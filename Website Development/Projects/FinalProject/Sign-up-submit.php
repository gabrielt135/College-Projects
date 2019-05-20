<!-- Author: Gabriel Taveras -->
<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Tournament Sign-up Submit</title>
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
			$FN = $_POST["First_Name"];
			$LN = $_POST["Last_Name"];
			$AL = $_POST["Alias"];
			$A = $_POST["Age"];
			$CH = $_POST["choice"];
			$GM = $_POST["game"];
			$EM = $_POST["email"];
			
			$attendees = file("Attendees.txt",FILE_IGNORE_NEW_LINES);
			
			$attendees_count = count($attendees);
			if ($attendees_count == NULL){
				$attendees_count = 0;
			}
			
			if ($GM == "Fortnite"){
				$GM = "FTNT";
			}
			else if ($GM == "Mortal Kombat 11"){
				$GM = "MK11";
			}
			else if ($GM == "Super Smash Bros. Ultimate"){
				$GM = "SSBU";
			}
			else if ($GM == "Marvel vs. Capcom Infinte"){
				$GM = "MVCI";
			}
			else if($GM == "Dissidia NT"){
				$GM = "DSNT";
			}
			else if($GM == "Soul Calibur VI"){
				$GM = "SCVI";
			}
			else{
				$GM = "";
			}
			
			$ID = $CH.$GM.$attendees_count; //Identification
			
			$check = $FN." ".$LN;
			
			$append = $ID.",".$FN." ".$LN.",".$AL.",".$A.",".$EM."\n"; //Information about attendee
			
			//checks if the information already exists through Identification
			$bool = FALSE;
			for ($i = 0; $i < $attendees_count; $i++){
				$buffer = explode(",",$attendees[$i]);
				if($buffer[1] == $check){
					$bool = TRUE;
				}	
			}
			
			//Appends file with information and if there is a contestant then the file is outputted to the specific game
			//otherwise outputs that it already exists
			if ($bool == FALSE){
				file_put_contents("Attendees.txt",$append,FILE_APPEND);
				if($CH == "C"){
					file_put_contents("contestants.txt",$append,FILE_APPEND);
				}
		?>
				<p>
				You have been entered into our database. <br/>
				Your ID string is <?=$ID?> 
				</p>
		<?php		
			}
			else{
		?>
				<p>Identification already exists</p>
		<?php
			}
		?>
	</body>
</html>
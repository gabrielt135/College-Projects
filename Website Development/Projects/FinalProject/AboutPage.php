<!DOCTYPE html>
<html>
	<head>
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
		<div class="About">
			<h1> About:</h1>
			<p>
				With world wide connection, gamers are able to play whenever. In this annual tournament, players from all around are gathering to witness the amazing head to head battle and have a chance to win the title of champion. Our goal is to provide a safe and friendly environment in which players can interact and play thrilling games. The collection of games provided in the tournaments are the most epic ones around, involving a little bit of every type of action people seek.
			</p>
			<p>
				By signing up you will unleash a world of gaming like never before. With high quality, innovative gaming experience, entering in a tournament has become better. We give all of our gamers a chance to either play or watch in order to reassure them that our facilities are the best. The creators of the tournament had only one goal in mind: CONNECTION WORLD WIDE!
			</p>
		
			
			<?php
		$contestants = file("contestants.txt",FILE_IGNORE_NEW_LINES);
		$contestants_count = count($contestants);
		
		$names = array();
		$aliases = array();
		
		for($i=0;$i < $contestants_count; $i++){
			$buffer = explode(",",$contestants[$i]);
			$names[] = $buffer[1];
			$aliases[] = $buffer[2];
		}
		
	?>
		<p>List of contestants:</p> <br/>
	<?php
		for($j = 0; $j < $contestants_count;$j++){
	?>
		<p>
		<?=$names[$j]?> <br/>
		<?=$aliases[$j]?><br/>
		<br/>
	<?php
		}
	?>
		</div>
	</body>


</html>
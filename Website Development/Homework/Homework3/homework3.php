<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Ultimate Weapons: FFVIII to FFX</title>
		<meta charset = "UTF-8"/>
		<meta name = "author" content = "Gabriel Taveras"/>
		<link href = "homework3_style.css" type = "text/css" rel = "stylesheet"/>
	</head>
	
	<body>
		<h1 title = "Why only VIII to X? Because Final Fantasy VII's weapons are ugly and everything before VII was sprite based">Ultimate Weapons from Final Fantasy VIII to Final Fantasy X</h1>
		
		<?php
			$mo = array("Lion Heart; Squall Leonhart", "Shooting Star; Rinoa Heartlily", "Ehrgeiz; Zell Dincht", "Save the Queen; Quistis Trepe", "Strange Vision; Selphie Tilmitt", "Exeter; Irving Kinneas", "Ultima Weapon; Zidane Tribal", "Whale Whisker; Garnet Til Alexandros", "Angel Flute; Eiko Carol", "Excalibur II; Adelbert Steiner", "Mace of Zeus; Vivi Ornitier", "Dragon's Hair; Freya Crescent", "Caladbolg; Tidus", "Nirvana, Yuna", "Masamune; Auron", "World Champion; Wakka", "Onion Knight; Lulu", "Godhand; Rikku");
			
			$trh = array("Final Fantasy VIII", "Final Fantasy IX", "Final Fantasy X");
		?>
	
		<table>
			<?php
				$i = 0;
				for ($row = 1; $row <= 3; $row++)
				{
			?>
					<th colspan = "6"> <?=$trh[$row -1]?> </th>
					<tr>
			<?php
					for ($col = 1; $col <= 6; $col++)
					{			
			?>
						<td>
						<img src = "./images/image<?="$row$col"?>.png" alt = "<?=$mo[$i]?>" title = "<?=$mo[$i]?>"/>
						</td>
			<?php
						$i++;
					}
			?>
					</tr>
			<?php
				}
			?>	
		
		</table>
	
		<p>
			This page was made with the use of php and php styles such as: <br/>
			- for loops to create the table. <br/>
			- complex expressions to post the images and give the images mouse-hover descriptions, and "alt" titles. <br/>
			- and arrays for the descriptions and table headers.
		</p>
	
	</body>
</html>
<!--
	This page's code is to display the matches for the logged in user
-->
<?php include("top.html"); ?>

		<?php
			
			$user = $_GET["name"];//Query request
			
			//function to compare the personalities of the user and
			//the potential match and return a value
			function personality($user_person, $comp_person)
			{			
				//splits the personality strings of both 
				$split_user = str_split($user_person);
				$split_comp = str_split($comp_person); 
				
				//variable that returns the number of 
				//matching personality...parameters(if that is the right word?)
				$match = 0;
				
				//for loop to find the number of matches within the personality string
				//if it does then the match variable is incremented by 1
				//the 4 is hard-coded because the personality must be 4 characters long
				for($i = 0; $i < 4; $i++)
				{
					if($split_user[$i] == $split_comp[$i])
					{
						$match++;
					}
				}
				
				return $match;
			}
			
			$singles = file("singles.txt",FILE_IGNORE_NEW_LINES);//Array of users and their data
			$singles_count = count($singles);//Number of registered users
			
			//Split arrays of user attributes 'from singles.txt'
			$fname = array();
			$fgender = array();
			$fage = array();
			$fperson = array();
			$fos = array();
			$fmin = array();
			$fmax = array();
			
			//Empty String Variables of user's own attributes
			$uname = "";
			$ugender = "";
			$uage = "";
			$uperson = "";
			$uos = "";
			$umin = "";
			$umax = "";
			
			
			//Empty array of Matching user attributes
			$mname = array();
			$mgender = array();
			$mage = array();
			$mperson = array();
			$mos = array();
			
			//For loop to split the user attributes into their own arrays
			for($i = 0; $i < $singles_count; $i++)
			{
				$buffer = $singles[$i];
				$exbuffer = explode(",",$buffer);
			
				$fname[] = $exbuffer[0];
				$fgender[] = $exbuffer[1];
				$fage[] = $exbuffer[2];
				$fperson[] = $exbuffer[3];
				$fos[] = $exbuffer[4];
				$fmin[] = $exbuffer[5];
				$fmax[] = $exbuffer[6];
			}
		
			//for loop to grab the loged in user's attribute
			for($i = 0; $i < $singles_count; $i++)
			{
				if($user == $fname[$i])
				{
					$uname = $fname[$i];
					$ugender = $fgender[$i];
					$uage = $fage[$i];
					$uperson = $fperson[$i];
					$uos = $fos[$i];
					$umin = $fmin[$i];
					$umax = $fmax[$i];
				}
			}
			
			//for loop to filter out the matches for the user
			//and push them into an array for each attribute
			//except for the min/max age
			for($i = 0; $i < $singles_count; $i++)
			{
				$person_match = personality($uperson,$fperson[$i]);
				
				if($fname[$i] != $uname && $fgender[$i] != $ugender && $fage[$i] >= $umin && $fage[$i] <= $umax && $fos[$i] == $uos && $person_match >= 2)
				{
					$mname[] = $fname[$i];
					$mgender[] = $fgender[$i];
					$mage[] = $fage[$i];
					$mperson[] = $fperson[$i];
					$mos[] = $fos[$i];
				}
			}
		
			//variable to hold the number of matches
			$matches_count = count($mname); 
		?>
		
		<!-- Displaying the matches for the logged in user -->
		<p><strong>Matches for <?=$uname?></strong></p>
		
		<!-- Division for the blocks of matches found for the user -->
		<div class = "match">
			<?php
			
				//for loop to organize the found matches into blocks of information
				//with the name being next to the image, and the gender, age, type,
				// and OS being in an unordered list
				for($i = 0; $i < $matches_count; $i++)
				{
			?>
					<p>
						<img src = "user.jpg" alt = "user"/><?=$mname[$i]?>
						<ul>
							<strong>gender:</strong><li><?=$mgender[$i]?></li>
							<strong>age:</strong><li><?=$mage[$i]?></li>
							<strong>type:</strong><li><?=$mperson[$i]?></li>
							<strong>OS:</strong><li><?=$mos[$i]?></li>
						</ul>
					</p>
			<?php
				}	
			?>
		</div>

<?php include("bottom.html"); ?>
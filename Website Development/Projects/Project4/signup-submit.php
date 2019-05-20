<?php include("top.html"); ?>
<!--
	This page's code is to submit the information recieved through post from the signup.php page
	and append it to the singles.txt file. It also checks if a user is already registered in the sytem
-->

<?php
		//pulling information from passed variables using POST
		$name = $_POST["Name"];
		$gender = $_POST["Gender"];
		$age = $_POST["Age"];
		$person = $_POST["Person"];
		$os = $_POST["OS"];
		$min = $_POST["AgeMin"];
		$max = $_POST["AgeMax"];
		
		//preparing a variable to pass to the singles.txt file
		$append = $name.",".$gender.",".$age.",".$person.",".$os.",".$min.",".$max."\n";
		
		//array holding the strings of users
		$singles = file("singles.txt",FILE_IGNORE_NEW_LINES);
		
		//number of registered users
		$singles_count = count($singles);
		
		//array needed to check if ther is a user already registered
		$fnames = array();
		
		//for loop to split the string from the singles array
		//and pshes the NAME (exbuffer[0]) into the dnames array
		for($i = 0; $i < $singles_count; $i++)
		{
			$buffer = $singles[$i];
			$exbuffer = explode(",", $buffer);
			$fnames[] = $exbuffer[0];
		}
		
		//boolean value set to false
		$bool = 0;
		
		//for loop that checks if there is a name already registered
		//if there is then the bool is set to one and stops the loop
		for($i = 0; $i < $singles_count; $i++)
		{
			if($name == $fnames[$i])
			{
				$bool = 1;
				break;
			}
		}
		
		// if/else statement to display a message depending on the bool value
		// if it is 1 then the name is already registered else then it 
		// appendes the file with the new user information and displays
		// a message
		if($bool == 1)
		{
		?>
			<p>Name is already registered.</p>
		
		<?php
		}
		else
		{
			file_put_contents("singles.txt",$append,FILE_APPEND);
		?>
			<p>
			<strong>Thank You!</strong>
			<br/><br/>
			Welcome to NerdLuv, <?=$name?>!
			<br/><br/>
			Now <a href = "matches.php">Log in to see your matches!</a>
			</p>
		<?php
		}
?>

<?php include("bottom.html"); ?>
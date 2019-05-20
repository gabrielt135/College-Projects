<!-- 
	Gabriel Taveras
	CMPT 241: Web Programming
	
	This .php file is a php converted version of a html file that was used for Project 2 (movie review aggregate), The php conversion allows
	multiple movies, with the use of a query, to be inserted and have its ratings from multiple reviewers analyzed
-->
<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Rancid Tomatoes</title>
		<meta name = "author" content = "Gabriel Taveras"/>
		<meta charset="utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<?php //This php block is to initialize all the necessary variables for the page
		
			$movie = $_GET["film"]; //Query request
			$info = file("$movie/info.txt",FILE_IGNORE_NEW_LINES); // array to hold the title, release year, and rating
																   // the use of "FILE_IGNORE_NEW_LINES" is for safety so the array 
																   // is not filled with \n's or the outputted text will not have
																   // uninterpreted \n's
			
			/*										  //
			//  php section for the General Overview  //
			*/										  //
			 // array to hold the general overview file's text
			$overview = file("$movie/overview.txt",FILE_IGNORE_NEW_LINES);
			
			// initializing an array to hold all the headers (STARRING, SYNOPSIS, etc.) in the general overview
			$dt = array(); 
			
			// initializing an array to hold all the information for the headers in the general overview
			$dd = array(); 
			
			// A For loop to go through the "overview" array and split the information
			// in the indices to become a header and the information.
			for($i = 0; $i < count($overview); $i++) 
			{
				$cleaned_overview = explode(":",$overview[$i]); // split the information in the index of overview with a delimiter of ":"
				$dt[] = $cleaned_overview[0]; // appends the header into the array for "dt" block elements
				$dd[] = $cleaned_overview[1]; // appends the information into the array for corresponding "dd" block elements 
			}
			
			/*										  //
			// php section for the columns of Reviews //
			*/										  //
			$reviews = glob("$movie/review*.txt"); //array of paths to a series of reviews
			$review_count = count($reviews); //number of reviews for a movie
			$split1 = $review_count / 2; //counter for the first column of reviews
			$split1 = ceil($split1); // rounds up the split up to the nearest integer
									 // assuming the split is always x.5
									 
			//arrays to store the review, rating, reviewer, and company
			$review_text = array(); 
			$review_rating = array();
			$reviewer = array();
			$company = array();
			
			// foreach loop to extract the review, rating, reviewer, and company from the text files
			// and append them to their own arrays
			foreach($reviews as $review_block){
				$text = file($review_block,FILE_IGNORE_NEW_LINES);
				$review_text[] = $text[0];
				$review_rating[] = $text[1];
				$reviewer[] = $text[2];
				$company[] = $text[3];
			}
			// end of php block
		?> 
		<div class = "bannerM">
			<img src="https://home.manhattan.edu/~tina.tian/CMPT241/project2/images/banner.png" alt="Rancid Tomatoes"/>
		</div>
		
		<h1><?="$info[0] ($info[1])"?></h1>
		
		<div id = "overContent">
			<div id = "genOverview">
				<div>
					<img src="<?="$movie"?>/overview.png" alt="general overview"/>
				</div>
					<dl id ="CastInfo">
						<?php // For loop to create the general overview's description list's terms <dt> and term descriptions <dd>
							  // based on the number of terms available
						for($i = 0; $i < count($dt); $i++)
						{
						?>	
							<dt><?=$dt[$i]?></dt> 
							<dd><?=$dd[$i]?></dd>
						<?php
						} // end of php block
						?>
					</dl>
			</div>
			<div id = "ReviewsList">
				<div id = "banner2">
					<?php  // php block for the banner where if the rating is >= 60
						   // then the rating image will be a fresh tomato else it will be a splatted rotten tomato
						if ($info[2] >= 60)
						{
					?>
							<img src="https://home.manhattan.edu/~tina.tian/CMPT241/project3/freshbig.png" alt="Fresh" />
					<?php
						}
						else
						{
					?>
							<img src="https://home.manhattan.edu/~tina.tian/CMPT241/project2/images/rottenbig.png" alt="Rotten" />
					<?php
						}// end of php block
					?>
					<span><?=$info[2]?>%</span>
				</div>
				<div class = "Columns">
					<?php
						// This for loop generates blocks of reviewers with the loop going from 0 to ceiling of the split variable
						for($i = 0; $i < $split1; $i++)
						{
					?>
							<p class = "Review">
					<?php
							// if/else block to check if the reviewer's rating is FRESH or not
							// then to put the appropriate image 
							if($review_rating[$i] == "FRESH")
							{
					?>
								<img src="https://home.manhattan.edu/~tina.tian/CMPT241/project2/images/fresh.gif" alt="Fresh" /> 
					<?php
							}
							else
							{
					?>
								<img src="https://home.manhattan.edu/~tina.tian/CMPT241/project2/images/rotten.gif" alt="Rotten" />
					<?php		
							}
					?>
								<!-- php shorthand expression for the review proper -->
								<q><?=$review_text[$i]?></q>
							</p>
							<p class = "Reviewer">
								<img src="https://home.manhattan.edu/~tina.tian/CMPT241/project2/images/critic.gif" alt="Critic" />
								<?=$reviewer[$i]?><br/> <!-- php shorthand expression for the reviewer -->
								
								<!-- php shorthand expression for the reviewer's company -->
								<span class = "company"><?=$company[$i]?></span> 
							</p>
					<?php
						}
					?>
				</div>
				<div class = "Columns">
					<?php
						// This for loop generates blocks of reviewers with the loop going from
						// the split variable to the review_count variable-1
						for($i = $split1; $i < $review_count; $i++)
						{
					?>
							<p class = "Review">
					<?php
							// if/else block to check if the reviewer's rating is FRESH or not
							// then to put the appropriate image 
							if($review_rating[$i] == "FRESH")
							{
					?>
								<img src="https://home.manhattan.edu/~tina.tian/CMPT241/project2/images/fresh.gif" alt="Fresh" /> 
					<?php
							}
							else
							{
					?>
								<img src="https://home.manhattan.edu/~tina.tian/CMPT241/project2/images/rotten.gif" alt="Rotten" />
					<?php		
							}
					?>
								<!-- php shorthand expression for the review proper -->
								<q><?=$review_text[$i]?></q>
							</p>
							<p class = "Reviewer">
								<img src="https://home.manhattan.edu/~tina.tian/CMPT241/project2/images/critic.gif" alt="Critic" />
								<?=$reviewer[$i]?><br/> <!-- php shorthand expression for the reviewer -->
								<span class = "company"><?=$company[$i]?></span> <!-- php shorthand expression for the reviewer's company -->
							</p>
					<?php
						}
					?>
				</div>
			</div>
			<div>
				 <!-- php short expressions for the number of reviews-->
				<p id = "NoOfReviews">(1-<?=$review_count?>) of <?=$review_count?></p>
			</div>
		</div>
		<div id = "valids">
			<a href="https://validator.w3.org/check/referer"><img src="https://home.manhattan.edu/~tina.tian/CMPT241/project2/images/w3c-html.png" alt="Valid HTML5" /></a> <br />
			<a href="https://jigsaw.w3.org/css-validator/check/referer"><img src="https://home.manhattan.edu/~tina.tian/CMPT241/project2/images/w3c-css.png" alt="Valid CSS" /></a>
		</div>
	</body>
</html>
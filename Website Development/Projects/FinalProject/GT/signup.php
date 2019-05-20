<?php include("top.html"); ?>
<!--
	This Page's Code is to display a new user signup field using text fields within a field set,
	radio buttons to specify gender and the peronsality field having a link to a online personality test.
	The form sends the information from the text fields to the signup-submit.php file using post in order
	to limit the information being shown in the url.
-->

		<form action = "signup-submit.php" method = "post">
			<fieldset>
				<legend>New User Signup:</legend>
			
				<span class = "column"><strong>Name:</strong></span>
				<input type = "text" name = "Name" size = "16"/>
				<br/>
						
				<span class = "column"><strong>Gender:</strong></span>
				<label><input type = "radio" name = "Gender" value = "M"/>Male</label>
				<label><input type = "radio" name = "Gender" value = "F" checked = "checked"/>Female<label>
				<br/>
					
				<span class = "column"><strong>Age:</strong></span>
				<input type = "text" name = "Age" size = "6"/>
				<br/>
					
				<span class = "column"><strong>Personality Type:</strong></span>
				<input type = "text" name = "Person" size = "6"/>
				<a href = "http://www.humanmetrics.com/cgi-win/JTypes2.asp">(Don't know your type?)</a>
				<br/>
					
				<span class = "column"><strong>Favorite OS:</strong></span>
				<select name = "OS">
					<option selected = "selected">Windows</option>
					<option>Mac OS X</option>
					<option>Linux</option>
				</select>
				<br/>
				
				<span class = "column"><strong>Seeking Age:</strong></span>
				<input type = "text" name = "AgeMin" placeholder = "Min" size = "6"/>
				to
				<input type = "text" name = "AgeMax" placeholder = "Max" size = "6"/>
				<br/>

				<input type = "submit" value = "Sign Up"/>
			</fieldset>
		</form>

<?php include("bottom.html"); ?>
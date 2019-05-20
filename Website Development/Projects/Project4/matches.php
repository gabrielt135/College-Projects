<!-- 
	This Page's code is to display a text field and a submit button within
	a fieldset in order to input a name and send it ro the specified url
	within the action
-->

<?php include("top.html"); ?>

		<form action = "matches-submit.php">
			<fieldset>
				<legend>Returning User:</legend>
				<span class = "column"><strong>Name:</strong></span>
				<input type= "text" name = "name" size = "16"/>
				<input type = "submit" value = "View My Matches"/>
			</fieldset>
		</form>

<?php include("bottom.html"); ?>
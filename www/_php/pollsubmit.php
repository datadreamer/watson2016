<?php

	$db = mysql_connect("localhost", "asiegel_web", "buttslol!") or die("Failed to connect to server.");
	mysql_select_db("asiegel_watson") or die("Failed to select database.");

	// check ip address to see if this person voted already
	$ip = $_SERVER['REMOTE_ADDR'];
	$result = mysql_query("SELECT * FROM poll WHERE ip='{$ip}'");
	if(mysql_num_rows($result) > 0){
		echo "<div class='pollinstructions'>I'm sorry but a vote with your IP address has already been recorded in the database.</div>";
	} else {

		$answer = $_POST['answer'];
		$age = $_POST['age'];
		$gender = $_POST['gender'];
		$party = $_POST['party'];
		$zipcode = $_POST['zipcode'];
		$reason = $_POST['reason'];

		// TODO: check CAPTCHA input

		$insert = "INSERT INTO poll (vote, gender, party, age, zipcode, reason, ip) values ('$answer', '$gender', '$party', '$age', '$zipcode', '$reason', '$ip')";
		if(mysql_query($insert)) {
			echo "<div class='pollinstructions'>Your vote has been recorded! Here are the current results:<br/><br/>";
			// TODO: echo results to user
			$result = mysql_query("SELECT * FROM poll WHERE vote='1'");
			echo mysql_num_rows($result) . " Yes";
			$result = mysql_query("SELECT * FROM poll WHERE vote='2'");
			echo mysql_num_rows($result) . " No";
			$result = mysql_query("SELECT * FROM poll WHERE vote='0'");
			echo mysql_num_rows($result) . " Undecided";
			echo "</div>";
		} else {
			echo mysql_error();
			echo "<div class='pollinstructions'>I'm sorry but there was an error recording your vote. Please try again later.</div>";
		}
	}

?>
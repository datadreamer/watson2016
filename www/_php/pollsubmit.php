<?php

$db = mysql_connect("localhost", "asiegel_web", "buttslol!") or die("Failed to connect to server.");
mysql_select_db("asiegel_watson") or die("Failed to select database.");

// check ip address to see if this person voted already
$ip = $_SERVER['REMOTE_ADDR'];
$result = mysql_query("SELECT * FROM poll WHERE ip='{$ip}'");
if(mysql_num_rows($result) > 0){
	echo "<div class='pollinstructions'>I'm sorry but a vote with your IP address has already been recorded in the database.";
	// echo results to user
		getResults();
	echo "</div>";
} else {

	$answer = mysql_escape_string($_POST['answer']);
	$age = mysql_escape_string($_POST['age']);
	$gender = mysql_escape_string($_POST['gender']);
	$party = mysql_escape_string($_POST['party']);
	$zipcode = mysql_escape_string($_POST['zipcode']);
	$reason = mysql_escape_string($_POST['reason']);

	// TODO: check CAPTCHA input

	$insert = "INSERT INTO poll (vote, gender, party, age, zipcode, reason, ip) values ('$answer', '$gender', '$party', '$age', '$zipcode', '$reason', '$ip')";
	if(mysql_query($insert)) {
		echo "<div class='pollinstructions'>Your vote has been recorded! Here are the current results:<br/><br/>";
		// echo results to user
		getResults();
		echo "</div>";
	} else {
		echo mysql_error();
		echo "<div class='pollinstructions'>I'm sorry but there was an error recording your vote. Please try again later.</div>";
	}
}

function getResults(){
	echo "<script type='text/javascript'>";
	echo "function getProcessingSketchId () { return 'bargraph'; }";
	$numyes = mysql_num_rows(mysql_query("SELECT * FROM poll WHERE vote='1'"));
	$numno = mysql_num_rows(mysql_query("SELECT * FROM poll WHERE vote='2'"));
	$numundecided = mysql_num_rows(mysql_query("SELECT * FROM poll WHERE vote='0'"));
	echo "var bargraphvalues = [['Yes', '{$numyes}'], ['No', '{$numno}'], ['Undecided', '{$numundecided}']];";
	echo "</script>";
	echo "<canvas id='bargraph' data-processing-sources='_js/bargraph.pde'></canvas>";
	echo "<script type='text/javascript'>";
	echo "var canvasRef = $('#bargraph');";
	echo "var p = Processing.loadSketchFromSources('bargraph', ['_js/bargraph.pde']);";
	echo "</script>";
}

?>

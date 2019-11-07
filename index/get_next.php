<?php

//get ID
//$referrer = $_GET["from"];
$prolificID = $_COOKIE["id"]

$servername = "localhost";
$username = "ubuntu";
$password = "ubuntuExperiment2019";
$dbname = "experiment";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Check whether participant exists
if (!($stmt = $conn->prepare("SELECT test_group, progress, jspsych_group, jspsych_progress, ibex_1_group FROM participants WHERE prolific_ID=?"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("s", $prolificID)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

$result = $conn->query($stmt);

// Update the progress, send them to the next page
if ($result->num_rows > 0) {
	
	//TODO: Verify that they came from the correct referrer
	
	$row = $result->fetch_assoc();
	$progress = $row["progress"] + 1;
	
	if (!($stmt = $conn->prepare("UPDATE participants set progress=? WHERE prolific_ID=?"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_param("is", $progress, $prolificID)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}	
	
	if (!$stmt->execute()) {
		//echo '<p style="text-align:center; font-family: Lucida, Console, monospace; font-size: medium;">Failed. Have you already done the experiment?</p>';
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	} else {
		
		if ($progress == 3){
			$next = "https://www.psycholinguistics.ml/finished.html";
		}
		else {
			switch (substr($testgroup, $progress, 1)){
			
			case "1":
				setcookie("ibex_1_group", $ibex_1_group, time()+144000, "/", "psycholinguistics.ml");		
				$next = "https://www.psycholinguistics.ml/ibex/experiment.html";
				break;
				
			case "2":
				$next = "https://www.psycholinguistics.ml/ibex_2/experiment.html";
				break;
				
			case "J":
				setcookie("jspsych_group", $jspsych_group, time()+144000, "/", "psycholinguistics.ml");
				setcookie("jspsych_progress", $jspsych_progress, time()+144000, "/", "psycholinguistics.ml");
				$next = "https://www.psycholinguistics.ml/jspsych.html";
				break;
			default:
				$next = "https://www.psycholinguistics.ml/index/server_error.html"		
			}
		}


		echo "Redirecting..." . $next;
		$conn->close();
		header("Location: ". $next, true, 302);
		exit();

}	

		echo "Redirecting..." . $next;
		$conn->close();
		header("Location: ". "https://www.psycholinguistics.ml", true, 302);
		exit();
		
	mysql_free_result($result);
}

?>
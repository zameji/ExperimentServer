<?php
$prolificID = $_POST['prolificID'];

setcookie("id", $prolificID, time()+144000, "/", "psycholinguistics.ml");

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
$query = "SELECT test_group, progress, jspsych_group, jspsych_progress, ibex_1_group FROM participants WHERE prolific_ID='".$prolificID."'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
	//Participant exists, find his continuation
	$row = $result->fetch_assoc();
	if ($row["test_group"] > ''){
		$test_group = $row["test_group"];
		$progress = $row["progress"];
    $progress = $progress - 1; //added because it was skipping a whole part (either its been updated too soon or its being +1'ed again somewhere)
		$jspsych_group = $row["jspsych_group"];
		$jspsych_progress = $row["jspsych_progress"];
    //$jspsych_progress = $jspsych_progress - 1; 
		$ibex_1_group = $row["ibex_1_group"];
		$result -> free();

	switch (substr($test_group, $progress, 1)) {
    //ibex 1
	case "1":
		setcookie("ibex_1_group", $ibex_1_group, time()+144000, "/", "psycholinguistics.ml");
		setrawcookie("next", 'https://www.psycholinguistics.ml/ibex_1/experiment.html', time()+144000, "/", "psycholinguistics.ml");
        $next = "https://www.psycholinguistics.ml/welcomeback.html";
        break;
    //ibex_2
	case "2":
		setrawcookie("next", 'https://www.psycholinguistics.ml/ibex_2/experiment.html', time()+144000, "/", "psycholinguistics.ml");
        $next = "https://www.psycholinguistics.ml/welcomeback.html";
        break;
	//jspsych
    case "J":
		setrawcookie("next", 'https://www.psycholinguistics.ml/index/jspsych.html', time()+144000, "/", "psycholinguistics.ml");
		setcookie("jspsych_group", $jspsych_group, time()+144000, "/", "psycholinguistics.ml");
		setcookie("jspsych_progress", $jspsych_progress, time()+144000, "/", "psycholinguistics.ml");
        $next = "https://www.psycholinguistics.ml/welcomeback.html";
        break;
    default:
        $next = "https://www.psycholinguistics.ml/index/server_error.html";
		break;
	}
} else {
		$next = "https://www.psycholinguistics.ml/questionnaire.html";
		}

	echo "Redirecting... <br /> If nothing happens, <a href='" . $next . "'> click here </a>";
	$conn->close();
	header("Location: ". $next, true, 302);
	exit();

}

else{
	//Insert into participants
	if (!($stmt = $conn->prepare("INSERT INTO participants (prolific_id) VALUES (?)"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->bind_param("s", $prolificID)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}


	if (!$stmt->execute()) {
		echo '<p style="text-align:center; font-family: Lucida, Console, monospace; font-size: medium;">Failed. Have you already done the experiment?</p>';
		//echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	} else {

		if (!($stmt2 = $conn->prepare("CALL addParticipant(?)"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}

		if (!$stmt2->bind_param("s", $prolificID)) {
			echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
		}

		if (!$stmt2->execute()) {
			echo '<p style="text-align:center; font-family: Lucida, Console, monospace; font-size: medium;">Failed. Have you already done the experiment?</p>';
			//echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		} else 	{

		echo "Redirecting... https://www.psycholinguistics.ml/questionnaire.html";
		$conn->close();
		header("Location: ". "https://www.psycholinguistics.ml/questionnaire.html", true, 302);
		exit();
		}
	}
}

?>

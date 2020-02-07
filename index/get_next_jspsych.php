<?php
//Get user ID, update their Jspsych progress
$prolificID = $_COOKIE["id"];

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
$stmt = "SELECT jspsych_group, jspsych_progress FROM participants where prolific_id='".$prolificID."'";

$result = $conn->query($stmt);

// Update the progress, send them to the next page
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$progress = $row["jspsych_progress"] + 1;
	$testgroup = $row["jspsych_group"];
} else {
	$conn->close();
	header('Content-Type: application/json');
	echo json_encode(['location'=>$next]);
	ob_end_flush();
	exit();
}

$result -> free();

$query = "UPDATE participants set
								jspsych_progress = ".$progress."
								where prolific_id='".$prolificID."'";

if (!$conn->query($query)) {
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
}


setcookie("jspsych_progress", $progress, time()+144000, "/", "psycholinguistics.ml");

if ($progress < 10){
switch (substr($testgroup, $progress, 1)){

	case "J":
		$next ="https://www.psycholinguistics.ml/jspsych/experiment.html";//circles
		break;
	case "K":
		$next ="https://www.psycholinguistics.ml/jspsych_1/index.html";//AXCPT
		break;
	case "L":
		$next ="https://www.psycholinguistics.ml/jspsych_2/reading_span_web_english.html"; //RST
		break;
	case "M":
		$next ="https://www.psycholinguistics.ml/jspsych_3/index.html";//Flanker
		break;
	case "N":
		$next ="https://www.psycholinguistics.ml/jspsych_4/index.html";//Ravens
		break;
	case "O":
		$next ="https://www.psycholinguistics.ml/jspsych_5/index.html";//Big5
		break;
	case "P":
		$next ="https://www.psycholinguistics.ml/jspsych_6/index.html";//Navon
		break;
	case "Q":
		$next ="https://www.psycholinguistics.ml/vocab/index_timed.html";// Vocabulary
		break;
	case "R":
		$next ="https://www.psycholinguistics.ml/vocab/index2_timed.html";//ART
		break;

	default:
		$next = "https://www.psycholinguistics.ml/index/server_error.html";
		break;
}
} else {$next = "https://www.psycholinguistics.ml/get_next.php";}

$conn -> commit();
$conn->close();
header("Location: ". $next, true, 302);
exit();
ob_end_flush();
?>

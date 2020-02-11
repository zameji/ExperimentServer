<?php
//Get user ID, update their Jspsych progress
$prolificID = $_COOKIE["id"];

//get where they are redirecting from
$comingFrom = $_GET["from"];

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
	$progress = $row["jspsych_progress"];
	$testgroup = $row["jspsych_group"];
} else {
	$conn->close();
	header('Content-Type: application/json');
	echo json_encode(['location'=>$next]);
	ob_end_flush();
	exit();
}

$result -> free();

$previous_progress = $jspsych_progress-1;
$prev_location = substr($jspsych_group, $previous_progress, 1);
$new_progress = $progress+1;

$query = "UPDATE participants set
								jspsych_progress = ".$new_progress."
								where prolific_id='".$prolificID."'";

if (!$conn->query($query)) {
    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
}


setcookie("jspsych_progress", $new_progress, time()+144000, "/", "psycholinguistics.ml");

if ($progress < 9){
switch (substr($testgroup, $progress, 1)){

	case "J":
    if($progress == 0) { //This would mean that the participant is on the first step, because $progress - 1 would be -1
		  $next ="https://www.psycholinguistics.ml/jspsych/experiment.html";//circles
    } elseif ($comingFrom == $prev_location) {
      $next ="https://www.psycholinguistics.ml/jspsych/experiment.html";
    } else {
      $next = "https://www.psycholinguistics.ml/index/no_back.html";
    }
		break;

	case "K":
    if($progress == 0) {
		  $next ="https://www.psycholinguistics.ml/jspsych_1/index.html";//AXCPT
    } elseif ($comingFrom == $prev_location) {
       $next ="https://www.psycholinguistics.ml/jspsych_1/index.html";//AXCPT
    } else {
      $next = "https://www.psycholinguistics.ml/index/no_back.html";
    }
		break;

	case "L":
    if($progress == 0) {
		  $next ="https://www.psycholinguistics.ml/jspsych_2/reading_span_web_english.html"; //RST
    } elseif ($comingFrom == $prev_location) {
      $next ="https://www.psycholinguistics.ml/jspsych_2/reading_span_web_english.html";
    } else {
      $next = "https://www.psycholinguistics.ml/index/no_back.html";
    }
		break;

	case "M":
    if($progress == 0) {
		  $next ="https://www.psycholinguistics.ml/jspsych_3/index.html";//Flanker
    } elseif ($comingFrom == $prev_location) {
      $next ="https://www.psycholinguistics.ml/jspsych_3/index.html";
    } else {
      $next = "https://www.psycholinguistics.ml/index/no_back.html";
    }
		break;

	case "N":
    if($progress == 0) {
		   $next ="https://www.psycholinguistics.ml/jspsych_4/index.html";//Ravens
    } elseif ($comingFrom == $prev_location) {
       $next ="https://www.psycholinguistics.ml/jspsych_4/index.html";
    } else {
       $next = "https://www.psycholinguistics.ml/index/no_back.html";
    }
		break;

	case "O":
    if($progress == 0) {
		  $next ="https://www.psycholinguistics.ml/jspsych_5/index.html";//Big5
    } elseif ($comingFrom == $prev_location) {
      $next ="https://www.psycholinguistics.ml/jspsych_5/index.html";//Big5
    } else {
      $next = "https://www.psycholinguistics.ml/index/no_back.html";
    }
		break;

	case "P":
    if($progress == 0) {
		  $next ="https://www.psycholinguistics.ml/jspsych_6/index.html";//Navon
    } elseif ($comingFrom == $prev_location) {
      $next ="https://www.psycholinguistics.ml/jspsych_6/index.html";//Navon
    } else {
      $next = "https://www.psycholinguistics.ml/index/no_back.html";
    }
		break;

	case "Q":
    if($progress == 0) {
		  $next ="https://www.psycholinguistics.ml/vocab/index_timed.html";// Vocabulary
    } elseif ($comingFrom == $prev_location) {
      $next ="https://www.psycholinguistics.ml/vocab/index_timed.html";
    } else {
      $next = "https://www.psycholinguistics.ml/index/no_back.html";
    }
		break;

	case "R":
    if($progress == 0) {
		  $next ="https://www.psycholinguistics.ml/vocab/index2_timed.html";//ART
    } elseif ($comingFrom == $prev_location) {
      $next ="https://www.psycholinguistics.ml/vocab/index2_timed.html";//ART
    } else {
      $next = "https://www.psycholinguistics.ml/index/no_back.html";
    }
		break;

	default:
		$next = "https://www.psycholinguistics.ml/index/server_error.html";
		break;
}
} else {$next = "https://www.psycholinguistics.ml/get_next.php?from=J";}

$conn -> commit();
$conn->close();
header("Location: ". $next, true, 302);
exit();
ob_end_flush();
?>

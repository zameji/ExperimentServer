<?php
//Get user ID, update their Jspsych progress
$prolificID = $_COOKIE["id"];
$ibex_J_done = $_COOKIE['ibex_J_done'];
$ibex_K_done = $_COOKIE['ibex_K_done'];
$ibex_L_done = $_COOKIE['ibex_L_done'];
$ibex_M_done = $_COOKIE['ibex_M_done'];
$ibex_N_done = $_COOKIE['ibex_N_done'];
$ibex_O_done = $_COOKIE['ibex_O_done'];
$ibex_P_done = $_COOKIE['ibex_P_done'];
$ibex_Q_done = $_COOKIE['ibex_Q_done'];
$ibex_J_done = $_COOKIE['ibex_R_done'];

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

if ($progress < 9){
switch (substr($testgroup, $progress, 1)){

	case "J":
    if($ibex_J_done == true) {
      $next = "https://www.psycholinguistics.ml/index/server_error.html";
    } else {
      setcookie("ibex_J_done", true, time()+144000, "/", "psycholinguistics.ml");
		  $next ="https://www.psycholinguistics.ml/jspsych/experiment.html";//circles
    }
		break;

	case "K":
    if($ibex_K_done == true) {
      $next = "https://www.psycholinguistics.ml/index/server_error.html";
    } else {
      setcookie("ibex_K_done", true, time()+144000, "/", "psycholinguistics.ml");
		  $next ="https://www.psycholinguistics.ml/jspsych_1/index.html";//AXCPT
    }
		break;

	case "L":
    if($ibex_L_done == true) {
      $next = "https://www.psycholinguistics.ml/index/server_error.html";
    } else {
      setcookie("ibex_L_done", true, time()+144000, "/", "psycholinguistics.ml");
		  $next ="https://www.psycholinguistics.ml/jspsych_2/reading_span_web_english.html"; //RST
    }
    break;

	case "M":
    if($ibex_M_done == true) {
      $next = "https://www.psycholinguistics.ml/index/server_error.html";
    } else {
      setcookie("ibex_M_done", true, time()+144000, "/", "psycholinguistics.ml");
		  $next ="https://www.psycholinguistics.ml/jspsych_3/index.html";//Flanker
    }
		break;

	case "N":
    if($ibex_N_done == true) {
      $next = "https://www.psycholinguistics.ml/index/server_error.html";
    } else {
      setcookie("ibex_N_done", true, time()+144000, "/", "psycholinguistics.ml");
		  $next ="https://www.psycholinguistics.ml/jspsych_4/index.html";//Ravens
    }
		  break;

	case "O":
    if($ibex_O_done == true) {
      $next = "https://www.psycholinguistics.ml/index/server_error.html";
    } else {
      setcookie("ibex_O_done", true, time()+144000, "/", "psycholinguistics.ml");
		  $next ="https://www.psycholinguistics.ml/jspsych_5/index.html";//Big5
    }
		break;

	case "P":
    if($ibex_P_done == true) {
      $next = "https://www.psycholinguistics.ml/index/server_error.html";
    } else {
      setcookie("ibex_P_done", true, time()+144000, "/", "psycholinguistics.ml");
		  $next ="https://www.psycholinguistics.ml/jspsych_6/index.html";//Navon
    }
		break;

	case "Q":
    if($ibex_Q_done == true) {
      $next = "https://www.psycholinguistics.ml/index/server_error.html";
    } else {
      setcookie("ibex_Q_done", true, time()+144000, "/", "psycholinguistics.ml");
		  $next ="https://www.psycholinguistics.ml/vocab/index_timed.html";// Vocabulary
    }
		break;

	case "R":
    if($ibex_R_done == true) {
      $next = "https://www.psycholinguistics.ml/index/server_error.html";
    } else {
      setcookie("ibex_R_done", true, time()+144000, "/", "psycholinguistics.ml");
		  $next ="https://www.psycholinguistics.ml/vocab/index2_timed.html";//ART
    }
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

<?php
$post_data = json_decode(file_get_contents('php://input'), true); 
// the directory "data" must be writable by the server
$name = "data/".$post_data['filename'].".csv"; 
$data = $post_data['filedata'];
// write the file to disk
file_put_contents($name, $data);


//Get user ID, update their Jspsych progress
$prolificID = getcookie("id");


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
if (!($stmt = $conn->prepare("SELECT jspsych_group, jspsych_progress FROM participants WHERE prolific_ID=?"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("s", $prolificID)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

$result = $conn->query($stmt);

// Update the progress, send them to the next page
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$progress = $row["jspsych_progress"] + 1;
	$testgroup = $row["jspsych_group"];
} else {
	echo "Redirecting..." . $next;
	$conn->close();
	header("Location: ". "https://www.psycholinguistics.ml", true, 302);
	exit();
	
}

mysql_free_result($result);


if (!($stmt = $conn->prepare("UPDATE participants set (
								jspsych_progress) 
								VALUES (?) 
								where prolific_id=?"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("is",
							$jspsych_progress,
							$prolificID)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
    //echo '<p style="text-align:center; font-family: Lucida, Console, monospace; font-size: medium;">Failed. Have you already done the experiment?</p>';
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
} else {
	setcookie("jspsych_progress", $progress, time()+144000, "/", "psycholinguistics.ml");

	switch (substr($testgroup, 0, 1)){
		
		case "J":
			$next ="https://www.psycholinguistics.ml/jspsych/experiment.html";//circles-REPLACE LATER WITH VOCAB
			break;
		case "K":
			$next ="https://www.psycholinguistics.ml/jspsych_1/static/index.html";//AXCPT
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

		default:
			$next = "https://www.psycholinguistics.ml/index/server_error.html"		
	}

    echo "Redirecting..." . $next;
	$conn->close();
	header("Location: ". $next, true, 302);
	exit();

}

?>

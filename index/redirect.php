<?php
$prolificID = $_COOKIE['id'];

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
		$jspsych_group = $row["jspsych_group"];
		$jspsych_progress = $row["jspsych_progress"];
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

} else {
	die ("This should not happen. Please, contact the developers and let them know.");
}

?>
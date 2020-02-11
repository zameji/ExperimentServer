<?php
$prolificID = $_COOKIE['id'];

$comingFrom = $GET["from"];

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

// Update the progress, send them to the next page
if ($result->num_rows > 0) {

	//TODO: Verify that they came from the correct referrer

	$row = $result->fetch_assoc();
	$testgroup = $row["test_group"];
	$progress = $row["progress"];
  $new_progress = $progress+1;
  $previous_progress = $progress-1;
  $ibex_1_group = $row["ibex_1_group"];
	$jspsych_group = $row["jspsych_group"];
	$jspsych_progress = $row["jspsych_progress"];
	$result -> free();
  $prev_location = substr($testgroup, $previous_progress, 1);

//	echo "next: ".$testgroup . "-" . $progress;
	$query = "UPDATE participants set progress=".$new_progress." WHERE prolific_ID='".$prolificID."'";

	if (!$conn->query($query)) {
		//echo '<p style="text-align:center; font-family: Lucida, Console, monospace; font-size: medium;">Failed. Have you already done the experiment?</p>';
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	} else {

		if ($progress == 2){
      if ($comingFrom == $prev_location){
        $next = "https://www.psycholinguistics.ml/vocab/index3_timed.html";
      } else {
        $next = "https://www.psycholinguistics.ml/vocab/no_back.html";
      }
		}
		elseif ($progress < 2){
			switch (substr($testgroup, $progress, 1)){
			case "1":
        if($progress == 0) { //This would mean that the participant is on the first step, because $progress - 1 would be -1
          setcookie("ibex_1_group", $ibex_1_group, time()+144000, "/", "psycholinguistics.ml");
				  $next = "https://www.psycholinguistics.ml/ibex_1/experiment.html";
        } elseif ($comingFrom == $prev_location) { //check if coming from (either 1 or J) matches the previous step in the progress
				  setcookie("ibex_1_group", $ibex_1_group, time()+144000, "/", "psycholinguistics.ml");
				  $next = "https://www.psycholinguistics.ml/ibex_1/experiment.html";
        } else {
          $next = "https://www.psycholinguistics.ml/vocab/no_back.html";
        }
				break;

			//case "2":
			//	$next = "https://www.psycholinguistics.ml/ibex_2/experiment.html";
			//	break;

			case "J":
        if($progress == 0) {
          setcookie("jspsych_group", $jspsych_group, time()+144000, "/", "psycholinguistics.ml");
				  setcookie("jspsych_progress", $jspsych_progress, time()+144000, "/", "psycholinguistics.ml");
          $next = "https://www.psycholinguistics.ml/jspsych.html";
        } elseif ($comingFrom == $prev_location) {
          setcookie("jspsych_group", $jspsych_group, time()+144000, "/", "psycholinguistics.ml");
				  setcookie("jspsych_progress", $jspsych_progress, time()+144000, "/", "psycholinguistics.ml");
          $next = "https://www.psycholinguistics.ml/jspsych.html";
        } else {
          $next = "https://www.psycholinguistics.ml/vocab/no_back.html";
        }
				break;

			default:
				$next = "https://www.psycholinguistics.ml/index/server_error.html";
				break;
			}
		}
    else {
      $next = "https://www.psycholinguistics.ml/index/server_error.html";
    }

    echo "Coming from:".$comingFrom."     ";
    echo "Previous location:".$prev_location."     ";
    echo "next". $next ."     ";
		// echo "Redirecting..." . $next;
		// $conn -> commit();
		// $conn->close();
		// header("Location: ". $next, true, 302);
		// exit();

	}

}

echo "Coming from:".$comingFrom."     ";
echo "Previous location:".$prev_location."     ";
echo "next". $next ."     ";
echo "Lower part of if statement";
    //
		// echo "Redirecting..." . $next;
		// $result -> free();
		// $conn->close();
		// header("Location: ". "https://www.psycholinguistics.ml", true, 302);
		// exit();
    //


?>

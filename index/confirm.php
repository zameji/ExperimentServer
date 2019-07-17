 <?php

//pull form fields into php variables
$ID = $_POST['prolificID'];
$time_finished = date("Y-m-d H:i:s");

// Create connection
$servername = "localhost";
$username = "ubuntu";
$password = "ubuntuExperiment2019";
$dbname = "experiment";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (!($stmt = $conn->prepare("UPDATE results SET finished=1, time_finished=? WHERE prolific_id=?;"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("ss", $time_finished,$ID)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
    echo '<p style="text-align:center; font-family: Lucida, Console, monospace; font-size: medium;">Failed. Have you finished the experiment?</p>';
	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
} else {
	$conn->close();
	header("Location: " ."https://www.psycholinguistics.ml/placeholder.html", true, 301);
	exit();
	
}
?>
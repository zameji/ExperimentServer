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

//Query
$query = "SELECT J, K, L, M, N, O, P, Q, R FROM participants WHERE prolific_ID='".$prolificID."'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
} else {
	$conn->close();
	header('Content-Type: application/json');
	echo json_encode(['location'=>$next]);
	ob_end_flush();
	exit();
}

$conn -> commit();

if ($row[J] == 0){
  $next = "https://www.psycholinguistics.ml/jspsych/experiment.html";
  $query = "UPDATE participants SET repeats = CONCAT(repeats, 'J') where prolific_id ='".$prolificID."'";
  $result = $conn->query($query);
} elseif ($row[K] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_1/index.html";
  $query = "UPDATE participants SET repeats = CONCAT(repeats, 'K') where prolific_id ='".$prolificID."'";
  $result = $conn->query($query);
} elseif ($row[L] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_2/reading_span_web_english.html";
  $query = "UPDATE participants SET repeats = CONCAT(repeats, 'L') where prolific_id ='".$prolificID."'";
  $result = $conn->query($query);
} elseif ($row[M] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_3/index.html";
  $query = "UPDATE participants SET repeats = CONCAT(repeats, 'M') where prolific_id ='".$prolificID."'";
  $result = $conn->query($query);
} elseif ($row[N] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_4/index.html";
  $query = "UPDATE participants SET repeats = CONCAT(repeats, 'N') where prolific_id ='".$prolificID."'";
  $result = $conn->query($query);
} elseif ($row[O] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_5/index.html";
  $query = "UPDATE participants SET repeats = CONCAT(repeats, 'O') where prolific_id ='".$prolificID."'";
  $result = $conn->query($query);
} elseif ($row[P] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_6/index.html";
  $query = "UPDATE participants SET repeats = CONCAT(repeats, 'P') where prolific_id ='".$prolificID."'";
  $result = $conn->query($query);
} elseif ($row[Q] == 0) {
  $next ="https://www.psycholinguistics.ml/vocab/index_timed.html";
  $query = "UPDATE participants SET repeats = CONCAT(repeats, 'Q') where prolific_id ='".$prolificID."'";
  $result = $conn->query($query);
} elseif ($row[R] == 0) {
  $next ="https://www.psycholinguistics.ml/vocab/index2_timed.html";
  $query = "UPDATE participants SET repeats = CONCAT(repeats, 'R') where prolific_id ='".$prolificID."'";
  $result = $conn->query($query);
}else {
  $next = "https://www.psycholinguistics.ml/get_next.php";
  $query = "UPDATE participants SET jspsych = jspsych + 1 WHERE prolific_ID='".$prolificID."'";
  $result = $conn->query($query);
}

$conn->close();

  header("Location: ". $next, true, 302);
  exit();

?>

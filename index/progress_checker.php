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



echo 'TEST ';
echo $result[J];

$conn -> commit();
$conn->close();

if ($row[J] == 0){
  $next = "https://www.psycholinguistics.ml/jspsych/experiment.html";
} elseif ($row[K] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_1/index.html";
} elseif ($row[L] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_2/reading_span_web_english.html";
} elseif ($row[M] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_3/index.html";
} elseif ($row[N] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_4/index.html";
} elseif ($row[O] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_5/index.html";
} elseif ($row[P] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_6/index.html";
} elseif ($row[Q] == 0) {
  $next ="https://www.psycholinguistics.ml/vocab/index_timed.html";
} elseif ($row[R] == 0) {
  $next ="https://www.psycholinguistics.ml/vocab/index2_timed.html";
}else {$next = "https://www.psycholinguistics.ml/get_next.php?from=J";}

echo $next;
echo 'STEP2';

  //header("Location: ". $next, true, 302);
  //exit();

?>

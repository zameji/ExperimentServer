<?php
echo 'STEP1';
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

echo $query;
$result = $conn->query($query);

$array = $result->fetch_all();

$conn -> commit();
$conn->close();

if ($result[J] == 0){
  $next = "https://www.psycholinguistics.ml/jspsych/experiment.html";
} elseif ($result[K] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_1/index.html";
} elseif ($result[L] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_2/reading_span_web_english.html";
} elseif ($result[M] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_3/index.html";
} elseif ($result[N] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_4/index.html";
} elseif ($result[O] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_5/index.html";
} elseif ($result[P] == 0) {
  $next ="https://www.psycholinguistics.ml/jspsych_6/index.html";
} elseif ($result[Q] == 0) {
  $next ="https://www.psycholinguistics.ml/vocab/index_timed.html";
} elseif ($result[R] == 0) {
  $next ="https://www.psycholinguistics.ml/vocab/index2_timed.html";
}else {$next = "https://www.psycholinguistics.ml/get_next.php?from=J";}

echo $next;
echo 'STEP2';

  //header("Location: ". $next, true, 302);
  //exit();

?>

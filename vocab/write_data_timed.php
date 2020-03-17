<?php
ob_start();
$post_data = json_decode(file_get_contents('php://input'), true);
// the directory "data" must be writable by the server

$name = "data/".$post_data['filename']."_".date('m-z-G-i').".csv";
$data = $post_data['filedata'];

file_put_contents($name, $data);

// $name = "data/".$post_data['filename'].".csv";
// $data = $post_data['filedata'];
// // write the file to disk
//
// if (!file_exists($name)){
// 	file_put_contents($name, $data);
// } else {
// 	$name = 'data/r'.substr($name, 5, strlen($name)-9,).'_'.date('z-G-i').".csv";
// 	file_put_contents($name, $data);
// }
//
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
$query = "UPDATE participants SET Q = Q + 1 WHERE prolific_ID='".$prolificID."'";

$result = $conn->query($query);

header('Content-Type: application/json');
echo json_encode(['location'=>'https://www.psycholinguistics.ml/get_next_jspsych.php?from=Q']);
ob_end_flush();
exit();
?>

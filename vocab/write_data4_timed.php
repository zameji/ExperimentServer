<?php
ob_start();
$post_data = json_decode(file_get_contents('php://input'), true); 
// the directory "data" must be writable by the server
$name = "data_4/".$post_data['filename'].".csv"; 
$data = $post_data['filedata'];
// write the file to disk
if (!file_exists($name)){
	file_put_contents($name, $data);
} else {
	$name = 'data_4/r'.substr($name, 7, strlen($name)-11,).'_'.date('z-G-i').".csv";
	file_put_contents($name, $data);
}

header('Content-Type: application/json');
echo json_encode(['location'=>'https://www.psycholinguistics.ml/get_next_jspsych.php']);
ob_end_flush();
exit();
?>
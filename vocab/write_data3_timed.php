<?php
ob_start();
$post_data = json_decode(file_get_contents('php://input'), true); 
// the directory "data" must be writable by the server
$name = "data_3/".$post_data['filename'].".csv"; 
$data = $post_data['filedata'];
// write the file to disk
file_put_contents($name, $data);

header('Content-Type: application/json');
echo json_encode(['location'=>'https://www.psycholinguistics.ml/vocab/index4_timed.html']);
ob_end_flush();
exit();
?>
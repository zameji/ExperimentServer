<?php
ob_start();

$id = $_COOKIE['id'];

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
$stmt = "SELECT jspsych_group, jspsych_progress FROM participants where prolific_id='".$id."'";

$result = $conn->query($stmt);

// Update the progress or send them to first page if ID unknown
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $progress = $row["jspsych_progress"] + 1;
    $testgroup = $row["jspsych_group"];
} else {
    $conn->close();
    header("Location: ". "https://www.psycholinguistics.ml/", true, 302);
    ob_end_flush();
    exit();
}

$colloc_1= $_POST['colloc_1'];
$colloc_2= $_POST['colloc_2'];
$colloc_3= $_POST['colloc_3'];
$colloc_4= $_POST['colloc_4'];
$colloc_5= $_POST['colloc_5'];
$colloc_6= $_POST['colloc_6'];
$colloc_7= $_POST['colloc_7'];
$colloc_8= $_POST['colloc_8'];
$colloc_9= $_POST['colloc_9'];
$colloc_10= $_POST['colloc_10'];
$colloc_11= $_POST['colloc_11'];
$colloc_12= $_POST['colloc_12'];
$colloc_13= $_POST['colloc_13'];
$colloc_14= $_POST['colloc_14'];
$colloc_15= $_POST['colloc_15'];
$colloc_16= $_POST['colloc_16'];
$colloc_17= $_POST['colloc_17'];
$colloc_18= $_POST['colloc_18'];
$colloc_19= $_POST['colloc_19'];
$colloc_20= $_POST['colloc_20'];
$colloc_21= $_POST['colloc_21'];
$colloc_22= $_POST['colloc_22'];
$colloc_23= $_POST['colloc_23'];
$colloc_24= $_POST['colloc_24'];
$colloc_25= $_POST['colloc_25'];
$colloc_26= $_POST['colloc_26'];
$colloc_27= $_POST['colloc_27'];
$colloc_28= $_POST['colloc_28'];
$colloc_29= $_POST['colloc_29'];
$colloc_30= $_POST['colloc_30'];
$colloc_31= $_POST['colloc_31'];
$colloc_32= $_POST['colloc_32'];
$colloc_33= $_POST['colloc_33'];
$colloc_34= $_POST['colloc_34'];
$colloc_35= $_POST['colloc_35'];
$colloc_36= $_POST['colloc_36'];
$colloc_37= $_POST['colloc_37'];
$colloc_38= $_POST['colloc_38'];
$colloc_39= $_POST['colloc_39'];
$colloc_40= $_POST['colloc_40'];

$query = "UPDATE colloc SET colloc_1='" .  $colloc_1 . "', colloc_2='" .  $colloc_2 . "', colloc_3='" .  $colloc_3 . "', colloc_4='" .  $colloc_4 . "', colloc_5='" .  $colloc_5 . "', colloc_6='" .  $colloc_6 . "', colloc_7='" .  $colloc_7 . "', colloc_8='" .  $colloc_8 . "', colloc_9='" .  $colloc_9 . "', colloc_10='" .  $colloc_10 . "', colloc_11='" .  $colloc_11 . "', colloc_12='" .  $colloc_12 . "', colloc_13='" .  $colloc_13 . "', colloc_14='" .  $colloc_14 . "', colloc_15='" .  $colloc_15 . "', colloc_16='" .  $colloc_16 . "', colloc_17='" .  $colloc_17 . "', colloc_18='" .  $colloc_18 . "', colloc_19='" .  $colloc_19 . "', colloc_20='" .  $colloc_20 . "', colloc_21='" .  $colloc_21 . "', colloc_22='" .  $colloc_22 . "', colloc_23='" .  $colloc_23 . "', colloc_24='" .  $colloc_24 . "', colloc_25='" .  $colloc_25 . "', colloc_26='" .  $colloc_26 . "', colloc_27='" .  $colloc_27 . "', colloc_28='" .  $colloc_28 . "', colloc_29='" .  $colloc_29 . "', colloc_30='" .  $colloc_30 . "', colloc_31='" .  $colloc_31 . "', colloc_32='" .  $colloc_32 . "', colloc_33='" .  $colloc_33 . "', colloc_34='" .  $colloc_34 . "', colloc_35='" .  $colloc_35 . "', colloc_36='" .  $colloc_36 . "', colloc_37='" .  $colloc_37 . "', colloc_38='" .  $colloc_38 . "', colloc_39='" .  $colloc_39 . "', colloc_40='" .  $colloc_40 . "' where prolific_id='" . $id . "';";

if (!$conn->query($query)) {
    die("Execute failed");
}

$next ="https://www.psycholinguistics.ml/vocab/index4.html";

$conn -> commit();
$conn->close();
header("Location: ". $next, true, 302);
exit();
ob_end_flush();
?>

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

$vocab_1= $_POST['vocab_1'];
$vocab_2= $_POST['vocab_2'];
$vocab_3= $_POST['vocab_3'];
$vocab_4= $_POST['vocab_4'];
$vocab_5= $_POST['vocab_5'];
$vocab_6= $_POST['vocab_6'];
$vocab_7= $_POST['vocab_7'];
$vocab_8= $_POST['vocab_8'];
$vocab_9= $_POST['vocab_9'];
$vocab_10= $_POST['vocab_10'];
$vocab_11= $_POST['vocab_11'];
$vocab_12= $_POST['vocab_12'];
$vocab_13= $_POST['vocab_13'];
$vocab_14= $_POST['vocab_14'];
$vocab_15= $_POST['vocab_15'];
$vocab_16= $_POST['vocab_16'];
$vocab_17= $_POST['vocab_17'];
$vocab_18= $_POST['vocab_18'];
$vocab_19= $_POST['vocab_19'];
$vocab_20= $_POST['vocab_20'];
$vocab_21= $_POST['vocab_21'];
$vocab_22= $_POST['vocab_22'];
$vocab_23= $_POST['vocab_23'];
$vocab_24= $_POST['vocab_24'];
$vocab_25= $_POST['vocab_25'];
$vocab_26= $_POST['vocab_26'];
$vocab_27= $_POST['vocab_27'];
$vocab_28= $_POST['vocab_28'];
$vocab_29= $_POST['vocab_29'];
$vocab_30= $_POST['vocab_30'];
$vocab_31= $_POST['vocab_31'];
$vocab_32= $_POST['vocab_32'];
$vocab_33= $_POST['vocab_33'];
$vocab_34= $_POST['vocab_34'];
$vocab_35= $_POST['vocab_35'];
$vocab_36= $_POST['vocab_36'];
$vocab_37= $_POST['vocab_37'];
$vocab_38= $_POST['vocab_38'];
$vocab_39= $_POST['vocab_39'];
$vocab_40= $_POST['vocab_40'];

$query = "UPDATE vocab SET vocab_1='" .  $vocab_1 . "', vocab_2='" .  $vocab_2 . "', vocab_3='" .  $vocab_3 . "', vocab_4='" .  $vocab_4 . "', vocab_5='" .  $vocab_5 . "', vocab_6='" .  $vocab_6 . "', vocab_7='" .  $vocab_7 . "', vocab_8='" .  $vocab_8 . "', vocab_9='" .  $vocab_9 . "', vocab_10='" .  $vocab_10 . "', vocab_11='" .  $vocab_11 . "', vocab_12='" .  $vocab_12 . "', vocab_13='" .  $vocab_13 . "', vocab_14='" .  $vocab_14 . "', vocab_15='" .  $vocab_15 . "', vocab_16='" .  $vocab_16 . "', vocab_17='" .  $vocab_17 . "', vocab_18='" .  $vocab_18 . "', vocab_19='" .  $vocab_19 . "', vocab_20='" .  $vocab_20 . "', vocab_21='" .  $vocab_21 . "', vocab_22='" .  $vocab_22 . "', vocab_23='" .  $vocab_23 . "', vocab_24='" .  $vocab_24 . "', vocab_25='" .  $vocab_25 . "', vocab_26='" .  $vocab_26 . "', vocab_27='" .  $vocab_27 . "', vocab_28='" .  $vocab_28 . "', vocab_29='" .  $vocab_29 . "', vocab_30='" .  $vocab_30 . "', vocab_31='" .  $vocab_31 . "', vocab_32='" .  $vocab_32 . "', vocab_33='" .  $vocab_33 . "', vocab_34='" .  $vocab_34 . "', vocab_35='" .  $vocab_35 . "', vocab_36='" .  $vocab_36 . "', vocab_37='" .  $vocab_37 . "', vocab_38='" .  $vocab_38 . "', vocab_39='" .  $vocab_39 . "', vocab_40='" .  $vocab_40 . "' where prolific_id='" . $id . "';";

if (!$conn->query($query)) {
    die("Execute failed");
}

$next ="https://www.psycholinguistics.ml/vocab/index2.html";

$conn -> commit();
$conn->close();
header("Location: ". $next, true, 302);
exit();
ob_end_flush();
?>

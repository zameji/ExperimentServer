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

$colloc_q1= $_POST['colloc_Q1'];
$colloc_q2= $_POST['colloc_Q2'];
$colloc_q3= $_POST['colloc_Q3'];
$colloc_q4= $_POST['colloc_Q4'];
$colloc_q5= $_POST['colloc_Q5'];
$colloc_q6= $_POST['colloc_Q6'];
$colloc_q7= $_POST['colloc_Q7'];
$colloc_q8= $_POST['colloc_Q8'];
$colloc_q9= $_POST['colloc_Q9'];
$colloc_q10= $_POST['colloc_Q10'];
$colloc_q11= $_POST['colloc_Q11'];
$colloc_q12= $_POST['colloc_Q12'];
$colloc_q13= $_POST['colloc_Q13'];
$colloc_q14= $_POST['colloc_Q14'];
$colloc_q15= $_POST['colloc_Q15'];
$colloc_q16= $_POST['colloc_Q16'];
$colloc_q17= $_POST['colloc_Q17'];
$colloc_q18= $_POST['colloc_Q18'];
$colloc_q19= $_POST['colloc_Q19'];
$colloc_q20= $_POST['colloc_Q20'];
$colloc_q21= $_POST['colloc_Q21'];
$colloc_q22= $_POST['colloc_Q22'];
$colloc_q23= $_POST['colloc_Q23'];
$colloc_q24= $_POST['colloc_Q24'];
$colloc_q25= $_POST['colloc_Q25'];
$colloc_q26= $_POST['colloc_Q26'];
$colloc_q27= $_POST['colloc_Q27'];
$colloc_q28= $_POST['colloc_Q28'];
$colloc_q29= $_POST['colloc_Q29'];
$colloc_q30= $_POST['colloc_Q30'];
$colloc_q31= $_POST['colloc_Q31'];
$colloc_q32= $_POST['colloc_Q32'];
$colloc_q33= $_POST['colloc_Q33'];
$colloc_q34= $_POST['colloc_Q34'];
$colloc_q35= $_POST['colloc_Q35'];
$colloc_q36= $_POST['colloc_Q36'];
$colloc_q37= $_POST['colloc_Q37'];
$colloc_q38= $_POST['colloc_Q38'];
$colloc_q39= $_POST['colloc_Q39'];
$colloc_q40= $_POST['colloc_Q40'];

$query = "UPDATE colloc SET colloc_q1='" .  $colloc_q1 . "', colloc_q2='" .  $colloc_q2 . "', colloc_q3='" .  $colloc_q3 . "', colloc_q4='" .  $colloc_q4 . "', colloc_q5='" .  $colloc_q5 . "', colloc_q6='" .  $colloc_q6 . "', colloc_q7='" .  $colloc_q7 . "', colloc_q8='" .  $colloc_q8 . "', colloc_q9='" .  $colloc_q9 . "', colloc_q10='" .  $colloc_q10 . "', colloc_q11='" .  $colloc_q11 . "', colloc_q12='" .  $colloc_q12 . "', colloc_q13='" .  $colloc_q13 . "', colloc_q14='" .  $colloc_q14 . "', colloc_q15='" .  $colloc_q15 . "', colloc_q16='" .  $colloc_q16 . "', colloc_q17='" .  $colloc_q17 . "', colloc_q18='" .  $colloc_q18 . "', colloc_q19='" .  $colloc_q19 . "', colloc_q20='" .  $colloc_q20 . "', colloc_q21='" .  $colloc_q21 . "', colloc_q22='" .  $colloc_q22 . "', colloc_q23='" .  $colloc_q23 . "', colloc_q24='" .  $colloc_q24 . "', colloc_q25='" .  $colloc_q25 . "', colloc_q26='" .  $colloc_q26 . "', colloc_q27='" .  $colloc_q27 . "', colloc_q28='" .  $colloc_q28 . "', colloc_q29='" .  $colloc_q29 . "', colloc_q30='" .  $colloc_q30 . "', colloc_q31='" .  $colloc_q31 . "', colloc_q32='" .  $colloc_q32 . "', colloc_q33='" .  $colloc_q33 . "', colloc_q34='" .  $colloc_q34 . "', colloc_q35='" .  $colloc_q35 . "', colloc_q36='" .  $colloc_q36 . "', colloc_q37='" .  $colloc_q37 . "', colloc_q38='" .  $colloc_q38 . "', colloc_q39='" .  $colloc_q39 . "', colloc_q40='" .  $colloc_q40 . "' where prolific_id='" . $id . "';";

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

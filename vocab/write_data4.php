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

$vocabB_q1= $_POST['vocabB_Q1'];
$vocabB_q2= $_POST['vocabB_Q2'];
$vocabB_q3= $_POST['vocabB_Q3'];
$vocabB_q4= $_POST['vocabB_Q4'];
$vocabB_q5= $_POST['vocabB_Q5'];
$vocabB_q6= $_POST['vocabB_Q6'];
$vocabB_q7= $_POST['vocabB_Q7'];
$vocabB_q8= $_POST['vocabB_Q8'];
$vocabB_q9= $_POST['vocabB_Q9'];
$vocabB_q10= $_POST['vocabB_Q10'];
$vocabB_q11= $_POST['vocabB_Q11'];
$vocabB_q12= $_POST['vocabB_Q12'];
$vocabB_q13= $_POST['vocabB_Q13'];
$vocabB_q14= $_POST['vocabB_Q14'];
$vocabB_q15= $_POST['vocabB_Q15'];
$vocabB_q16= $_POST['vocabB_Q16'];
$vocabB_q17= $_POST['vocabB_Q17'];
$vocabB_q18= $_POST['vocabB_Q18'];
$vocabB_q19= $_POST['vocabB_Q19'];
$vocabB_q20= $_POST['vocabB_Q20'];
$vocabB_q21= $_POST['vocabB_Q21'];
$vocabB_q22= $_POST['vocabB_Q22'];
$vocabB_q23= $_POST['vocabB_Q23'];
$vocabB_q24= $_POST['vocabB_Q24'];
$vocabB_q25= $_POST['vocabB_Q25'];
$vocabB_q26= $_POST['vocabB_Q26'];
$vocabB_q27= $_POST['vocabB_Q27'];
$vocabB_q28= $_POST['vocabB_Q28'];
$vocabB_q29= $_POST['vocabB_Q29'];
$vocabB_q30= $_POST['vocabB_Q30'];
$vocabB_q31= $_POST['vocabB_Q31'];
$vocabB_q32= $_POST['vocabB_Q32'];
$vocabB_q33= $_POST['vocabB_Q33'];
$vocabB_q34= $_POST['vocabB_Q34'];
$vocabB_q35= $_POST['vocabB_Q35'];
$vocabB_q36= $_POST['vocabB_Q36'];
$vocabB_q37= $_POST['vocabB_Q37'];
$vocabB_q38= $_POST['vocabB_Q38'];
$vocabB_q39= $_POST['vocabB_Q39'];
$vocabB_q40= $_POST['vocabB_Q40'];
$vocabB_q41= $_POST['vocabB_Q41'];
$vocabB_q42= $_POST['vocabB_Q42'];
$vocabB_q43= $_POST['vocabB_Q43'];
$vocabB_q44= $_POST['vocabB_Q44'];
$vocabB_q45= $_POST['vocabB_Q45'];
$vocabB_q46= $_POST['vocabB_Q46'];
$vocabB_q47= $_POST['vocabB_Q47'];
$vocabB_q48= $_POST['vocabB_Q48'];
$vocabB_q49= $_POST['vocabB_Q49'];
$vocabB_q50= $_POST['vocabB_Q50'];
$vocabB_q51= $_POST['vocabB_Q51'];
$vocabB_q52= $_POST['vocabB_Q52'];
$vocabB_q53= $_POST['vocabB_Q53'];
$vocabB_q54= $_POST['vocabB_Q54'];
$vocabB_q55= $_POST['vocabB_Q55'];
$vocabB_q56= $_POST['vocabB_Q56'];
$vocabB_q57= $_POST['vocabB_Q57'];
$vocabB_q58= $_POST['vocabB_Q58'];
$vocabB_q59= $_POST['vocabB_Q59'];
$vocabB_q60= $_POST['vocabB_Q60'];

$query = "UPDATE vocabB SET vocabB_q1='" .  $vocabB_q1 . "', vocabB_q2='" .  $vocabB_q2 . "', vocabB_q3='" .  $vocabB_q3 . "', vocabB_q4='" .  $vocabB_q4 . "', vocabB_q5='" .  $vocabB_q5 . "', vocabB_q6='" .  $vocabB_q6 . "', vocabB_q7='" .  $vocabB_q7 . "', vocabB_q8='" .  $vocabB_q8 . "', vocabB_q9='" .  $vocabB_q9 . "', vocabB_q10='" .  $vocabB_q10 . "', vocabB_q11='" .  $vocabB_q11 . "', vocabB_q12='" .  $vocabB_q12 . "', vocabB_q13='" .  $vocabB_q13 . "', vocabB_q14='" .  $vocabB_q14 . "', vocabB_q15='" .  $vocabB_q15 . "', vocabB_q16='" .  $vocabB_q16 . "', vocabB_q17='" .  $vocabB_q17 . "', vocabB_q18='" .  $vocabB_q18 . "', vocabB_q19='" .  $vocabB_q19 . "', vocabB_q20='" .  $vocabB_q20 . "', vocabB_q21='" .  $vocabB_q21 . "', vocabB_q22='" .  $vocabB_q22 . "', vocabB_q23='" .  $vocabB_q23 . "', vocabB_q24='" .  $vocabB_q24 . "', vocabB_q25='" .  $vocabB_q25 . "', vocabB_q26='" .  $vocabB_q26 . "', vocabB_q27='" .  $vocabB_q27 . "', vocabB_q28='" .  $vocabB_q28 . "', vocabB_q29='" .  $vocabB_q29 . "', vocabB_q30='" .  $vocabB_q30 . "', vocabB_q31='" .  $vocabB_q31 . "', vocabB_q32='" .  $vocabB_q32 . "', vocabB_q33='" .  $vocabB_q33 . "', vocabB_q34='" .  $vocabB_q34 . "', vocabB_q35='" .  $vocabB_q35 . "', vocabB_q36='" .  $vocabB_q36 . "', vocabB_q37='" .  $vocabB_q37 . "', vocabB_q38='" .  $vocabB_q38 . "', vocabB_q39='" .  $vocabB_q39 . "', vocabB_q40='" .  $vocabB_q40 . "', vocabB_q41='" .  $vocabB_q41 . "', vocabB_q42='" .  $vocabB_q42 . "', vocabB_q43='" .  $vocabB_q43 . "', vocabB_q44='" .  $vocabB_q44 . "', vocabB_q45='" .  $vocabB_q45 . "', vocabB_q46='" .  $vocabB_q46 . "', vocabB_q47='" .  $vocabB_q47 . "', vocabB_q48='" .  $vocabB_q48 . "', vocabB_q49='" .  $vocabB_q49 . "', vocabB_q50='" .  $vocabB_q50 . "', vocabB_q51='" .  $vocabB_q51 . "', vocabB_q52='" .  $vocabB_q52 . "', vocabB_q53='" .  $vocabB_q53 . "', vocabB_q54='" .  $vocabB_q54 . "', vocabB_q55='" .  $vocabB_q55 . "', vocabB_q56='" .  $vocabB_q56 . "', vocabB_q57='" .  $vocabB_q57 . "', vocabB_q58='" .  $vocabB_q58 . "', vocabB_q59='" .  $vocabB_q59 . "', vocabB_q60='" .  $vocabB_q60 . "' where prolific_id='" . $id . "';";

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

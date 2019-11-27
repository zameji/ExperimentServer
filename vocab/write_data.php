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

$vocab_q1= $_POST['vocab_Q1'];
$vocab_q2= $_POST['vocab_Q2'];
$vocab_q3= $_POST['vocab_Q3'];
$vocab_q4= $_POST['vocab_Q4'];
$vocab_q5= $_POST['vocab_Q5'];
$vocab_q6= $_POST['vocab_Q6'];
$vocab_q7= $_POST['vocab_Q7'];
$vocab_q8= $_POST['vocab_Q8'];
$vocab_q9= $_POST['vocab_Q9'];
$vocab_q10= $_POST['vocab_Q10'];
$vocab_q11= $_POST['vocab_Q11'];
$vocab_q12= $_POST['vocab_Q12'];
$vocab_q13= $_POST['vocab_Q13'];
$vocab_q14= $_POST['vocab_Q14'];
$vocab_q15= $_POST['vocab_Q15'];
$vocab_q16= $_POST['vocab_Q16'];
$vocab_q17= $_POST['vocab_Q17'];
$vocab_q18= $_POST['vocab_Q18'];
$vocab_q19= $_POST['vocab_Q19'];
$vocab_q20= $_POST['vocab_Q20'];
$vocab_q21= $_POST['vocab_Q21'];
$vocab_q22= $_POST['vocab_Q22'];
$vocab_q23= $_POST['vocab_Q23'];
$vocab_q24= $_POST['vocab_Q24'];
$vocab_q25= $_POST['vocab_Q25'];
$vocab_q26= $_POST['vocab_Q26'];
$vocab_q27= $_POST['vocab_Q27'];
$vocab_q28= $_POST['vocab_Q28'];
$vocab_q29= $_POST['vocab_Q29'];
$vocab_q30= $_POST['vocab_Q30'];
$vocab_q31= $_POST['vocab_Q31'];
$vocab_q32= $_POST['vocab_Q32'];
$vocab_q33= $_POST['vocab_Q33'];
$vocab_q34= $_POST['vocab_Q34'];
$vocab_q35= $_POST['vocab_Q35'];
$vocab_q36= $_POST['vocab_Q36'];
$vocab_q37= $_POST['vocab_Q37'];
$vocab_q38= $_POST['vocab_Q38'];
$vocab_q39= $_POST['vocab_Q39'];
$vocab_q40= $_POST['vocab_Q40'];

$query = "UPDATE vocab SET vocab_q1='" .  $vocab_q1 . "', vocab_q2='" .  $vocab_q2 . "', vocab_q3='" .  $vocab_q3 . "', vocab_q4='" .  $vocab_q4 . "', vocab_q5='" .  $vocab_q5 . "', vocab_q6='" .  $vocab_q6 . "', vocab_q7='" .  $vocab_q7 . "', vocab_q8='" .  $vocab_q8 . "', vocab_q9='" .  $vocab_q9 . "', vocab_q10='" .  $vocab_q10 . "', vocab_q11='" .  $vocab_q11 . "', vocab_q12='" .  $vocab_q12 . "', vocab_q13='" .  $vocab_q13 . "', vocab_q14='" .  $vocab_q14 . "', vocab_q15='" .  $vocab_q15 . "', vocab_q16='" .  $vocab_q16 . "', vocab_q17='" .  $vocab_q17 . "', vocab_q18='" .  $vocab_q18 . "', vocab_q19='" .  $vocab_q19 . "', vocab_q20='" .  $vocab_q20 . "', vocab_q21='" .  $vocab_q21 . "', vocab_q22='" .  $vocab_q22 . "', vocab_q23='" .  $vocab_q23 . "', vocab_q24='" .  $vocab_q24 . "', vocab_q25='" .  $vocab_q25 . "', vocab_q26='" .  $vocab_q26 . "', vocab_q27='" .  $vocab_q27 . "', vocab_q28='" .  $vocab_q28 . "', vocab_q29='" .  $vocab_q29 . "', vocab_q30='" .  $vocab_q30 . "', vocab_q31='" .  $vocab_q31 . "', vocab_q32='" .  $vocab_q32 . "', vocab_q33='" .  $vocab_q33 . "', vocab_q34='" .  $vocab_q34 . "', vocab_q35='" .  $vocab_q35 . "', vocab_q36='" .  $vocab_q36 . "', vocab_q37='" .  $vocab_q37 . "', vocab_q38='" .  $vocab_q38 . "', vocab_q39='" .  $vocab_q39 . "', vocab_q40='" .  $vocab_q40 . "' where prolific_id='" . $id . "';";

//if (!$conn->query($query)) {
//    die("Execute failed");
//}

setcookie("jspsych_progress", $progress, time()+144000, "/", "psycholinguistics.ml");

if ($progress < 7){
switch (substr($testgroup, $progress, 1)){

    case "J":
        $next ="https://www.psycholinguistics.ml/jspsych/experiment.html";//circles-REPLACE LATER WITH VOCAB
        break;
    case "K":
        $next ="https://www.psycholinguistics.ml/jspsych_1/index.html";//AXCPT
        break;
    case "L":
        $next ="https://www.psycholinguistics.ml/jspsych_2/reading_span_web_english.html"; //RST
        break;
    case "M":
        $next ="https://www.psycholinguistics.ml/jspsych_3/index.html";//Flanker
        break;
    case "N":
        $next ="https://www.psycholinguistics.ml/jspsych_4/index.html";//Ravens
        break;
    case "O":
        $next ="https://www.psycholinguistics.ml/jspsych_5/index.html";//Big5
        break;
    case "P":
        $next ="https://www.psycholinguistics.ml/jspsych_6/index.html";//Navon
        break;

    default:
        $next = "https://www.psycholinguistics.ml/index/server_error.html";
        break;
}
} else {$next = "https://www.psycholinguistics.ml/get_next.php";}

$conn -> commit();
$conn->close();
header("Location: ". $next, true, 302);
exit();
ob_end_flush();
?>


$conn -> commit();
$conn->close();
header("Location: ". $next, true, 302);
exit();
ob_end_flush();
?>

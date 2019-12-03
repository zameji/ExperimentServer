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

$big5_q1= $_POST['Big5_Q1'];
$big5_q2= $_POST['Big5_Q2'];
$big5_q3= $_POST['Big5_Q3'];
$big5_q4= $_POST['Big5_Q4'];
$big5_q5= $_POST['Big5_Q5'];
$big5_q6= $_POST['Big5_Q6'];
$big5_q7= $_POST['Big5_Q7'];
$big5_q8= $_POST['Big5_Q8'];
$big5_q9= $_POST['Big5_Q9'];
$big5_q10= $_POST['Big5_Q10'];
$big5_q11= $_POST['Big5_Q11'];
$big5_q12= $_POST['Big5_Q12'];
$big5_q13= $_POST['Big5_Q13'];
$big5_q14= $_POST['Big5_Q14'];
$big5_q15= $_POST['Big5_Q15'];
$big5_q16= $_POST['Big5_Q16'];
$big5_q17= $_POST['Big5_Q17'];
$big5_q18= $_POST['Big5_Q18'];
$big5_q19= $_POST['Big5_Q19'];
$big5_q20= $_POST['Big5_Q20'];
$big5_q21= $_POST['Big5_Q21'];
$big5_q22= $_POST['Big5_Q22'];
$big5_q23= $_POST['Big5_Q23'];
$big5_q24= $_POST['Big5_Q24'];
$big5_q25= $_POST['Big5_Q25'];
$big5_q26= $_POST['Big5_Q26'];
$big5_q27= $_POST['Big5_Q27'];
$big5_q28= $_POST['Big5_Q28'];
$big5_q29= $_POST['Big5_Q29'];
$big5_q30= $_POST['Big5_Q30'];
$big5_q31= $_POST['Big5_Q31'];
$big5_q32= $_POST['Big5_Q32'];
$big5_q33= $_POST['Big5_Q33'];
$big5_q34= $_POST['Big5_Q34'];
$big5_q35= $_POST['Big5_Q35'];
$big5_q36= $_POST['Big5_Q36'];
$big5_q37= $_POST['Big5_Q37'];
$big5_q38= $_POST['Big5_Q38'];
$big5_q39= $_POST['Big5_Q39'];
$big5_q40= $_POST['Big5_Q40'];
$big5_q41= $_POST['Big5_Q41'];
$big5_q42= $_POST['Big5_Q42'];
$big5_q43= $_POST['Big5_Q43'];
$big5_q44= $_POST['Big5_Q44'];
$big5_q45= $_POST['Big5_Q45'];
$big5_q46= $_POST['Big5_Q46'];
$big5_q47= $_POST['Big5_Q47'];
$big5_q48= $_POST['Big5_Q48'];
$big5_q49= $_POST['Big5_Q49'];
$big5_q50= $_POST['Big5_Q50'];
$big5_q51= $_POST['Big5_Q51'];
$big5_q52= $_POST['Big5_Q52'];
$big5_q53= $_POST['Big5_Q53'];
$big5_q54= $_POST['Big5_Q54'];
$big5_q55= $_POST['Big5_Q55'];
$big5_q56= $_POST['Big5_Q56'];
$big5_q57= $_POST['Big5_Q57'];
$big5_q58= $_POST['Big5_Q58'];
$big5_q59= $_POST['Big5_Q59'];
$big5_q60= $_POST['Big5_Q60'];

$query = "UPDATE big5 SET big5_q1='" .  $big5_q1 . "', big5_q2='" .  $big5_q2 . "', big5_q3='" .  $big5_q3 . "', big5_q4='" .  $big5_q4 . "', big5_q5='" .  $big5_q5 . "', big5_q6='" .  $big5_q6 . "', big5_q7='" .  $big5_q7 . "', big5_q8='" .  $big5_q8 . "', big5_q9='" .  $big5_q9 . "', big5_q10='" .  $big5_q10 . "', big5_q11='" .  $big5_q11 . "', big5_q12='" .  $big5_q12 . "', big5_q13='" .  $big5_q13 . "', big5_q14='" .  $big5_q14 . "', big5_q15='" .  $big5_q15 . "', big5_q16='" .  $big5_q16 . "', big5_q17='" .  $big5_q17 . "', big5_q18='" .  $big5_q18 . "', big5_q19='" .  $big5_q19 . "', big5_q20='" .  $big5_q20 . "', big5_q21='" .  $big5_q21 . "', big5_q22='" .  $big5_q22 . "', big5_q23='" .  $big5_q23 . "', big5_q24='" .  $big5_q24 . "', big5_q25='" .  $big5_q25 . "', big5_q26='" .  $big5_q26 . "', big5_q27='" .  $big5_q27 . "', big5_q28='" .  $big5_q28 . "', big5_q29='" .  $big5_q29 . "', big5_q30='" .  $big5_q30 . "', big5_q31='" .  $big5_q31 . "', big5_q32='" .  $big5_q32 . "', big5_q33='" .  $big5_q33 . "', big5_q34='" .  $big5_q34 . "', big5_q35='" .  $big5_q35 . "', big5_q36='" .  $big5_q36 . "', big5_q37='" .  $big5_q37 . "', big5_q38='" .  $big5_q38 . "', big5_q39='" .  $big5_q39 . "', big5_q40='" .  $big5_q40 . "', big5_q41='" .  $big5_q41 . "', big5_q42='" .  $big5_q42 . "', big5_q43='" .  $big5_q43 . "', big5_q44='" .  $big5_q44 . "', big5_q45='" .  $big5_q45 . "', big5_q46='" .  $big5_q46 . "', big5_q47='" .  $big5_q47 . "', big5_q48='" .  $big5_q48 . "', big5_q49='" .  $big5_q49 . "', big5_q50='" .  $big5_q50 . "', big5_q51='" .  $big5_q51 . "', big5_q52='" .  $big5_q52 . "', big5_q53='" .  $big5_q53 . "', big5_q54='" .  $big5_q54 . "', big5_q55='" .  $big5_q55 . "', big5_q56='" .  $big5_q56 . "', big5_q57='" .  $big5_q57 . "', big5_q58='" .  $big5_q58 . "', big5_q59='" .  $big5_q59 . "', big5_q60='" .  $big5_q60 . "' where prolific_id='" . $id . "';";

if (!$conn->query($query)) {
    die("Execute failed");
} 

$conn -> commit();
$conn->close();
header("Location: ". "https://www.psycholinguistics.ml/get_next_jspsych.php", true, 302);
ob_end_flush();
exit();
?>

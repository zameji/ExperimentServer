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

$ART_q1= $_POST['ART_Q1'];
$ART_q2= $_POST['ART_Q2'];
$ART_q3= $_POST['ART_Q3'];
$ART_q4= $_POST['ART_Q4'];
$ART_q5= $_POST['ART_Q5'];
$ART_q6= $_POST['ART_Q6'];
$ART_q7= $_POST['ART_Q7'];
$ART_q8= $_POST['ART_Q8'];
$ART_q9= $_POST['ART_Q9'];
$ART_q10= $_POST['ART_Q10'];
$ART_q11= $_POST['ART_Q11'];
$ART_q12= $_POST['ART_Q12'];
$ART_q13= $_POST['ART_Q13'];
$ART_q14= $_POST['ART_Q14'];
$ART_q15= $_POST['ART_Q15'];
$ART_q16= $_POST['ART_Q16'];
$ART_q17= $_POST['ART_Q17'];
$ART_q18= $_POST['ART_Q18'];
$ART_q19= $_POST['ART_Q19'];
$ART_q20= $_POST['ART_Q20'];
$ART_q21= $_POST['ART_Q21'];
$ART_q22= $_POST['ART_Q22'];
$ART_q23= $_POST['ART_Q23'];
$ART_q24= $_POST['ART_Q24'];
$ART_q25= $_POST['ART_Q25'];
$ART_q26= $_POST['ART_Q26'];
$ART_q27= $_POST['ART_Q27'];
$ART_q28= $_POST['ART_Q28'];
$ART_q29= $_POST['ART_Q29'];
$ART_q30= $_POST['ART_Q30'];
$ART_q31= $_POST['ART_Q31'];
$ART_q32= $_POST['ART_Q32'];
$ART_q33= $_POST['ART_Q33'];
$ART_q34= $_POST['ART_Q34'];
$ART_q35= $_POST['ART_Q35'];
$ART_q36= $_POST['ART_Q36'];
$ART_q37= $_POST['ART_Q37'];
$ART_q38= $_POST['ART_Q38'];
$ART_q39= $_POST['ART_Q39'];
$ART_q40= $_POST['ART_Q40'];
$ART_q41= $_POST['ART_Q41'];
$ART_q42= $_POST['ART_Q42'];
$ART_q43= $_POST['ART_Q43'];
$ART_q44= $_POST['ART_Q44'];
$ART_q45= $_POST['ART_Q45'];
$ART_q46= $_POST['ART_Q46'];
$ART_q47= $_POST['ART_Q47'];
$ART_q48= $_POST['ART_Q48'];
$ART_q49= $_POST['ART_Q49'];
$ART_q50= $_POST['ART_Q50'];
$ART_q51= $_POST['ART_Q51'];
$ART_q52= $_POST['ART_Q52'];
$ART_q53= $_POST['ART_Q53'];
$ART_q54= $_POST['ART_Q54'];
$ART_q55= $_POST['ART_Q55'];
$ART_q56= $_POST['ART_Q56'];
$ART_q57= $_POST['ART_Q57'];
$ART_q58= $_POST['ART_Q58'];
$ART_q59= $_POST['ART_Q59'];
$ART_q60= $_POST['ART_Q60'];
$ART_q61= $_POST['ART_Q61'];
$ART_q62= $_POST['ART_Q62'];
$ART_q63= $_POST['ART_Q63'];
$ART_q64= $_POST['ART_Q64'];
$ART_q65= $_POST['ART_Q65'];
$ART_q66= $_POST['ART_Q66'];
$ART_q67= $_POST['ART_Q67'];
$ART_q68= $_POST['ART_Q68'];
$ART_q69= $_POST['ART_Q69'];
$ART_q70= $_POST['ART_Q70'];
$ART_q71= $_POST['ART_Q71'];
$ART_q72= $_POST['ART_Q72'];
$ART_q73= $_POST['ART_Q73'];
$ART_q74= $_POST['ART_Q74'];
$ART_q75= $_POST['ART_Q75'];
$ART_q76= $_POST['ART_Q76'];
$ART_q77= $_POST['ART_Q77'];
$ART_q78= $_POST['ART_Q78'];
$ART_q79= $_POST['ART_Q79'];
$ART_q80= $_POST['ART_Q80'];
$ART_q81= $_POST['ART_Q81'];
$ART_q82= $_POST['ART_Q82'];
$ART_q83= $_POST['ART_Q83'];
$ART_q84= $_POST['ART_Q84'];
$ART_q85= $_POST['ART_Q85'];
$ART_q86= $_POST['ART_Q86'];
$ART_q87= $_POST['ART_Q87'];
$ART_q88= $_POST['ART_Q88'];
$ART_q89= $_POST['ART_Q89'];
$ART_q90= $_POST['ART_Q90'];
$ART_q91= $_POST['ART_Q91'];
$ART_q92= $_POST['ART_Q92'];
$ART_q93= $_POST['ART_Q93'];
$ART_q94= $_POST['ART_Q94'];
$ART_q95= $_POST['ART_Q95'];
$ART_q96= $_POST['ART_Q96'];
$ART_q97= $_POST['ART_Q97'];
$ART_q98= $_POST['ART_Q98'];
$ART_q99= $_POST['ART_Q99'];
$ART_q100= $_POST['ART_Q100'];
$ART_q101= $_POST['ART_Q101'];
$ART_q102= $_POST['ART_Q102'];
$ART_q103= $_POST['ART_Q103'];
$ART_q104= $_POST['ART_Q104'];
$ART_q105= $_POST['ART_Q105'];
$ART_q106= $_POST['ART_Q106'];
$ART_q107= $_POST['ART_Q107'];
$ART_q108= $_POST['ART_Q108'];
$ART_q109= $_POST['ART_Q109'];
$ART_q110= $_POST['ART_Q110'];
$ART_q111= $_POST['ART_Q111'];
$ART_q112= $_POST['ART_Q112'];
$ART_q113= $_POST['ART_Q113'];
$ART_q114= $_POST['ART_Q114'];
$ART_q115= $_POST['ART_Q115'];
$ART_q116= $_POST['ART_Q116'];
$ART_q117= $_POST['ART_Q117'];
$ART_q118= $_POST['ART_Q118'];
$ART_q119= $_POST['ART_Q119'];
$ART_q120= $_POST['ART_Q120'];
$ART_q121= $_POST['ART_Q121'];
$ART_q122= $_POST['ART_Q122'];
$ART_q123= $_POST['ART_Q123'];
$ART_q124= $_POST['ART_Q124'];
$ART_q125= $_POST['ART_Q125'];
$ART_q126= $_POST['ART_Q126'];
$ART_q127= $_POST['ART_Q127'];
$ART_q128= $_POST['ART_Q128'];
$ART_q129= $_POST['ART_Q129'];
$ART_q130= $_POST['ART_Q130'];
$ART_q131= $_POST['ART_Q131'];
$ART_q132= $_POST['ART_Q132'];
$ART_q133= $_POST['ART_Q133'];
$ART_q134= $_POST['ART_Q134'];
$ART_q135= $_POST['ART_Q135'];
$ART_q136= $_POST['ART_Q136'];
$ART_q137= $_POST['ART_Q137'];
$ART_q138= $_POST['ART_Q138'];
$ART_q139= $_POST['ART_Q139'];
$ART_q140= $_POST['ART_Q140'];

$query = "UPDATE ART SET ART_q1='" .  $ART_q1 . "', ART_q2='" .  $ART_q2 . "', ART_q3='" .  $ART_q3 . "', ART_q4='" .  $ART_q4 . "', ART_q5='" .  $ART_q5 . "', ART_q6='" .  $ART_q6 . "', ART_q7='" .  $ART_q7 . "', ART_q8='" .  $ART_q8 . "', ART_q9='" .  $ART_q9 . "', ART_q10='" .  $ART_q10 . "', ART_q11='" .  $ART_q11 . "', ART_q12='" .  $ART_q12 . "', ART_q13='" .  $ART_q13 . "', ART_q14='" .  $ART_q14 . "', ART_q15='" .  $ART_q15 . "', ART_q16='" .  $ART_q16 . "', ART_q17='" .  $ART_q17 . "', ART_q18='" .  $ART_q18 . "', ART_q19='" .  $ART_q19 . "', ART_q20='" .  $ART_q20 . "', ART_q21='" .  $ART_q21 . "', ART_q22='" .  $ART_q22 . "', ART_q23='" .  $ART_q23 . "', ART_q24='" .  $ART_q24 . "', ART_q25='" .  $ART_q25 . "', ART_q26='" .  $ART_q26 . "', ART_q27='" .  $ART_q27 . "', ART_q28='" .  $ART_q28 . "', ART_q29='" .  $ART_q29 . "', ART_q30='" .  $ART_q30 . "', ART_q31='" .  $ART_q31 . "', ART_q32='" .  $ART_q32 . "', ART_q33='" .  $ART_q33 . "', ART_q34='" .  $ART_q34 . "', ART_q35='" .  $ART_q35 . "', ART_q36='" .  $ART_q36 . "', ART_q37='" .  $ART_q37 . "', ART_q38='" .  $ART_q38 . "', ART_q39='" .  $ART_q39 . "', ART_q40='" .  $ART_q40 . "', ART_q41='" .  $ART_q41 . "', ART_q42='" .  $ART_q42 . "', ART_q43='" .  $ART_q43 . "', ART_q44='" .  $ART_q44 . "', ART_q45='" .  $ART_q45 . "', ART_q46='" .  $ART_q46 . "', ART_q47='" .  $ART_q47 . "', ART_q48='" .  $ART_q48 . "', ART_q49='" .  $ART_q49 . "', ART_q50='" .  $ART_q50 . "', ART_q51='" .  $ART_q51 . "', ART_q52='" .  $ART_q52 . "', ART_q53='" .  $ART_q53 . "', ART_q54='" .  $ART_q54 . "', ART_q55='" .  $ART_q55 . "', ART_q56='" .  $ART_q56 . "', ART_q57='" .  $ART_q57 . "', ART_q58='" .  $ART_q58 . "', ART_q59='" .  $ART_q59 . "', ART_q60='" .  $ART_q60 . "', ART_q61='" .  $ART_q61 . "', ART_q62='" .  $ART_q62 . "', ART_q63='" .  $ART_q63 . "', ART_q64='" .  $ART_q64 . "', ART_q65='" .  $ART_q65 . "', ART_q66='" .  $ART_q66 . "', ART_q67='" .  $ART_q67 . "', ART_q68='" .  $ART_q68 . "', ART_q69='" .  $ART_q69 . "', ART_q70='" .  $ART_q70 . "', ART_q71='" .  $ART_q71 . "', ART_q72='" .  $ART_q72 . "', ART_q73='" .  $ART_q73 . "', ART_q74='" .  $ART_q74 . "', ART_q75='" .  $ART_q75 . "', ART_q76='" .  $ART_q76 . "', ART_q77='" .  $ART_q77 . "', ART_q78='" .  $ART_q78 . "', ART_q79='" .  $ART_q79 . "', ART_q80='" .  $ART_q80 . "', ART_q81='" .  $ART_q81 . "', ART_q82='" .  $ART_q82 . "', ART_q83='" .  $ART_q83 . "', ART_q84='" .  $ART_q84 . "', ART_q85='" .  $ART_q85 . "', ART_q86='" .  $ART_q86 . "', ART_q87='" .  $ART_q87 . "', ART_q88='" .  $ART_q88 . "', ART_q89='" .  $ART_q89 . "', ART_q90='" .  $ART_q90 . "', ART_q91='" .  $ART_q91 . "', ART_q92='" .  $ART_q92 . "', ART_q93='" .  $ART_q93 . "', ART_q94='" .  $ART_q94 . "', ART_q95='" .  $ART_q95 . "', ART_q96='" .  $ART_q96 . "', ART_q97='" .  $ART_q97 . "', ART_q98='" .  $ART_q98 . "', ART_q99='" .  $ART_q99 . "', ART_q100='" .  $ART_q100 . "', ART_q101='" .  $ART_q101 . "', ART_q102='" .  $ART_q102 . "', ART_q103='" .  $ART_q103 . "', ART_q104='" .  $ART_q104 . "', ART_q105='" .  $ART_q105 . "', ART_q106='" .  $ART_q106 . "', ART_q107='" .  $ART_q107 . "', ART_q108='" .  $ART_q108 . "', ART_q109='" .  $ART_q109 . "', ART_q110='" .  $ART_q110 . "', ART_q111='" .  $ART_q111 . "', ART_q112='" .  $ART_q112 . "', ART_q113='" .  $ART_q113 . "', ART_q114='" .  $ART_q114 . "', ART_q115='" .  $ART_q115 . "', ART_q116='" .  $ART_q116 . "', ART_q117='" .  $ART_q117 . "', ART_q118='" .  $ART_q118 . "', ART_q119='" .  $ART_q119 . "', ART_q120='" .  $ART_q120 . "', ART_q121='" .  $ART_q121 . "', ART_q122='" .  $ART_q122 . "', ART_q123='" .  $ART_q123 . "', ART_q124='" .  $ART_q124 . "', ART_q125='" .  $ART_q125 . "', ART_q126='" .  $ART_q126 . "', ART_q127='" .  $ART_q127 . "', ART_q128='" .  $ART_q128 . "', ART_q129='" .  $ART_q129 . "', ART_q130='" .  $ART_q130 . "', ART_q131='" .  $ART_q131 . "', ART_q132='" .  $ART_q132 . "', ART_q133='" .  $ART_q133 . "', ART_q134='" .  $ART_q134 . "', ART_q135='" .  $ART_q135 . "', ART_q136='" .  $ART_q136 . "', ART_q137='" .  $ART_q137 . "', ART_q138='" .  $ART_q138 . "', ART_q139='" .  $ART_q139 . "', ART_q140='" .  $ART_q140 . "' where prolific_id='" . $id . "';";

//if (!$conn->query($query)) {
//    die("Execute failed");
//}

$next ="https://www.psycholinguistics.ml/vocab/index3.html";

$conn -> commit();
$conn->close();
header("Location: ". $next, true, 302);
exit();
ob_end_flush();
?>

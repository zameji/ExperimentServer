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

$ART_q1= $_POST['ART_1'];
$ART_q2= $_POST['ART_2'];
$ART_q3= $_POST['ART_3'];
$ART_q4= $_POST['ART_4'];
$ART_q5= $_POST['ART_5'];
$ART_q6= $_POST['ART_6'];
$ART_q7= $_POST['ART_7'];
$ART_q8= $_POST['ART_8'];
$ART_q9= $_POST['ART_9'];
$ART_q10= $_POST['ART_10'];
$ART_q11= $_POST['ART_11'];
$ART_q12= $_POST['ART_12'];
$ART_q13= $_POST['ART_13'];
$ART_q14= $_POST['ART_14'];
$ART_q15= $_POST['ART_15'];
$ART_q16= $_POST['ART_16'];
$ART_q17= $_POST['ART_17'];
$ART_q18= $_POST['ART_18'];
$ART_q19= $_POST['ART_19'];
$ART_q20= $_POST['ART_20'];
$ART_q21= $_POST['ART_21'];
$ART_q22= $_POST['ART_22'];
$ART_q23= $_POST['ART_23'];
$ART_q24= $_POST['ART_24'];
$ART_q25= $_POST['ART_25'];
$ART_q26= $_POST['ART_26'];
$ART_q27= $_POST['ART_27'];
$ART_q28= $_POST['ART_28'];
$ART_q29= $_POST['ART_29'];
$ART_q30= $_POST['ART_30'];
$ART_q31= $_POST['ART_31'];
$ART_q32= $_POST['ART_32'];
$ART_q33= $_POST['ART_33'];
$ART_q34= $_POST['ART_34'];
$ART_q35= $_POST['ART_35'];
$ART_q36= $_POST['ART_36'];
$ART_q37= $_POST['ART_37'];
$ART_q38= $_POST['ART_38'];
$ART_q39= $_POST['ART_39'];
$ART_q40= $_POST['ART_40'];
$ART_q41= $_POST['ART_41'];
$ART_q42= $_POST['ART_42'];
$ART_q43= $_POST['ART_43'];
$ART_q44= $_POST['ART_44'];
$ART_q45= $_POST['ART_45'];
$ART_q46= $_POST['ART_46'];
$ART_q47= $_POST['ART_47'];
$ART_q48= $_POST['ART_48'];
$ART_q49= $_POST['ART_49'];
$ART_q50= $_POST['ART_50'];
$ART_q51= $_POST['ART_51'];
$ART_q52= $_POST['ART_52'];
$ART_q53= $_POST['ART_53'];
$ART_q54= $_POST['ART_54'];
$ART_q55= $_POST['ART_55'];
$ART_q56= $_POST['ART_56'];
$ART_q57= $_POST['ART_57'];
$ART_q58= $_POST['ART_58'];
$ART_q59= $_POST['ART_59'];
$ART_q60= $_POST['ART_60'];
$ART_q61= $_POST['ART_61'];
$ART_q62= $_POST['ART_62'];
$ART_q63= $_POST['ART_63'];
$ART_q64= $_POST['ART_64'];
$ART_q65= $_POST['ART_65'];
$ART_q66= $_POST['ART_66'];
$ART_q67= $_POST['ART_67'];
$ART_q68= $_POST['ART_68'];
$ART_q69= $_POST['ART_69'];
$ART_q70= $_POST['ART_70'];
$ART_q71= $_POST['ART_71'];
$ART_q72= $_POST['ART_72'];
$ART_q73= $_POST['ART_73'];
$ART_q74= $_POST['ART_74'];
$ART_q75= $_POST['ART_75'];
$ART_q76= $_POST['ART_76'];
$ART_q77= $_POST['ART_77'];
$ART_q78= $_POST['ART_78'];
$ART_q79= $_POST['ART_79'];
$ART_q80= $_POST['ART_80'];
$ART_q81= $_POST['ART_81'];
$ART_q82= $_POST['ART_82'];
$ART_q83= $_POST['ART_83'];
$ART_q84= $_POST['ART_84'];
$ART_q85= $_POST['ART_85'];
$ART_q86= $_POST['ART_86'];
$ART_q87= $_POST['ART_87'];
$ART_q88= $_POST['ART_88'];
$ART_q89= $_POST['ART_89'];
$ART_q90= $_POST['ART_90'];
$ART_q91= $_POST['ART_91'];
$ART_q92= $_POST['ART_92'];
$ART_q93= $_POST['ART_93'];
$ART_q94= $_POST['ART_94'];
$ART_q95= $_POST['ART_95'];
$ART_q96= $_POST['ART_96'];
$ART_q97= $_POST['ART_97'];
$ART_q98= $_POST['ART_98'];
$ART_q99= $_POST['ART_99'];
$ART_q100= $_POST['ART_100'];
$ART_q101= $_POST['ART_101'];
$ART_q102= $_POST['ART_102'];
$ART_q103= $_POST['ART_103'];
$ART_q104= $_POST['ART_104'];
$ART_q105= $_POST['ART_105'];
$ART_q106= $_POST['ART_106'];
$ART_q107= $_POST['ART_107'];
$ART_q108= $_POST['ART_108'];
$ART_q109= $_POST['ART_109'];
$ART_q110= $_POST['ART_110'];
$ART_q111= $_POST['ART_111'];
$ART_q112= $_POST['ART_112'];
$ART_q113= $_POST['ART_113'];
$ART_q114= $_POST['ART_114'];
$ART_q115= $_POST['ART_115'];
$ART_q116= $_POST['ART_116'];
$ART_q117= $_POST['ART_117'];
$ART_q118= $_POST['ART_118'];
$ART_q119= $_POST['ART_119'];
$ART_q120= $_POST['ART_120'];
$ART_q121= $_POST['ART_121'];
$ART_q122= $_POST['ART_122'];
$ART_q123= $_POST['ART_123'];
$ART_q124= $_POST['ART_124'];
$ART_q125= $_POST['ART_125'];
$ART_q126= $_POST['ART_126'];
$ART_q127= $_POST['ART_127'];
$ART_q128= $_POST['ART_128'];
$ART_q129= $_POST['ART_129'];
$ART_q130= $_POST['ART_130'];
$ART_q131= $_POST['ART_131'];
$ART_q132= $_POST['ART_132'];
$ART_q133= $_POST['ART_133'];
$ART_q134= $_POST['ART_134'];
$ART_q135= $_POST['ART_135'];
$ART_q136= $_POST['ART_136'];
$ART_q137= $_POST['ART_137'];
$ART_q138= $_POST['ART_138'];
$ART_q139= $_POST['ART_139'];
$ART_q140= $_POST['ART_140'];

$query = "UPDATE ART SET ART_1='" .  $ART_1 . "', ART_2='" .  $ART_2 . "', ART_3='" .  $ART_3 . "', ART_4='" .  $ART_4 . "', ART_5='" .  $ART_5 . "', ART_6='" .  $ART_6 . "', ART_7='" .  $ART_7 . "', ART_8='" .  $ART_8 . "', ART_9='" .  $ART_9 . "', ART_10='" .  $ART_10 . "', ART_11='" .  $ART_11 . "', ART_12='" .  $ART_12 . "', ART_13='" .  $ART_13 . "', ART_14='" .  $ART_14 . "', ART_15='" .  $ART_15 . "', ART_16='" .  $ART_16 . "', ART_17='" .  $ART_17 . "', ART_18='" .  $ART_18 . "', ART_19='" .  $ART_19 . "', ART_20='" .  $ART_20 . "', ART_21='" .  $ART_21 . "', ART_22='" .  $ART_22 . "', ART_23='" .  $ART_23 . "', ART_24='" .  $ART_24 . "', ART_25='" .  $ART_25 . "', ART_26='" .  $ART_26 . "', ART_27='" .  $ART_27 . "', ART_28='" .  $ART_28 . "', ART_29='" .  $ART_29 . "', ART_30='" .  $ART_30 . "', ART_31='" .  $ART_31 . "', ART_32='" .  $ART_32 . "', ART_33='" .  $ART_33 . "', ART_34='" .  $ART_34 . "', ART_35='" .  $ART_35 . "', ART_36='" .  $ART_36 . "', ART_37='" .  $ART_37 . "', ART_38='" .  $ART_38 . "', ART_39='" .  $ART_39 . "', ART_40='" .  $ART_40 . "', ART_41='" .  $ART_41 . "', ART_42='" .  $ART_42 . "', ART_43='" .  $ART_43 . "', ART_44='" .  $ART_44 . "', ART_45='" .  $ART_45 . "', ART_46='" .  $ART_46 . "', ART_47='" .  $ART_47 . "', ART_48='" .  $ART_48 . "', ART_49='" .  $ART_49 . "', ART_50='" .  $ART_50 . "', ART_51='" .  $ART_51 . "', ART_52='" .  $ART_52 . "', ART_53='" .  $ART_53 . "', ART_54='" .  $ART_54 . "', ART_55='" .  $ART_55 . "', ART_56='" .  $ART_56 . "', ART_57='" .  $ART_57 . "', ART_58='" .  $ART_58 . "', ART_59='" .  $ART_59 . "', ART_60='" .  $ART_60 . "', ART_61='" .  $ART_61 . "', ART_62='" .  $ART_62 . "', ART_63='" .  $ART_63 . "', ART_64='" .  $ART_64 . "', ART_65='" .  $ART_65 . "', ART_66='" .  $ART_66 . "', ART_67='" .  $ART_67 . "', ART_68='" .  $ART_68 . "', ART_69='" .  $ART_69 . "', ART_70='" .  $ART_70 . "', ART_71='" .  $ART_71 . "', ART_72='" .  $ART_72 . "', ART_73='" .  $ART_73 . "', ART_74='" .  $ART_74 . "', ART_75='" .  $ART_75 . "', ART_76='" .  $ART_76 . "', ART_77='" .  $ART_77 . "', ART_78='" .  $ART_78 . "', ART_79='" .  $ART_79 . "', ART_80='" .  $ART_80 . "', ART_81='" .  $ART_81 . "', ART_82='" .  $ART_82 . "', ART_83='" .  $ART_83 . "', ART_84='" .  $ART_84 . "', ART_85='" .  $ART_85 . "', ART_86='" .  $ART_86 . "', ART_87='" .  $ART_87 . "', ART_88='" .  $ART_88 . "', ART_89='" .  $ART_89 . "', ART_90='" .  $ART_90 . "', ART_91='" .  $ART_91 . "', ART_92='" .  $ART_92 . "', ART_93='" .  $ART_93 . "', ART_94='" .  $ART_94 . "', ART_95='" .  $ART_95 . "', ART_96='" .  $ART_96 . "', ART_97='" .  $ART_97 . "', ART_98='" .  $ART_98 . "', ART_99='" .  $ART_99 . "', ART_100='" .  $ART_100 . "', ART_101='" .  $ART_101 . "', ART_102='" .  $ART_102 . "', ART_103='" .  $ART_103 . "', ART_104='" .  $ART_104 . "', ART_105='" .  $ART_105 . "', ART_106='" .  $ART_106 . "', ART_107='" .  $ART_107 . "', ART_108='" .  $ART_108 . "', ART_109='" .  $ART_109 . "', ART_110='" .  $ART_110 . "', ART_111='" .  $ART_111 . "', ART_112='" .  $ART_112 . "', ART_113='" .  $ART_113 . "', ART_114='" .  $ART_114 . "', ART_115='" .  $ART_115 . "', ART_116='" .  $ART_116 . "', ART_117='" .  $ART_117 . "', ART_118='" .  $ART_118 . "', ART_119='" .  $ART_119 . "', ART_120='" .  $ART_120 . "', ART_121='" .  $ART_121 . "', ART_122='" .  $ART_122 . "', ART_123='" .  $ART_123 . "', ART_124='" .  $ART_124 . "', ART_125='" .  $ART_125 . "', ART_126='" .  $ART_126 . "', ART_127='" .  $ART_127 . "', ART_128='" .  $ART_128 . "', ART_129='" .  $ART_129 . "', ART_130='" .  $ART_130 . "', ART_131='" .  $ART_131 . "', ART_132='" .  $ART_132 . "', ART_133='" .  $ART_133 . "', ART_134='" .  $ART_134 . "', ART_135='" .  $ART_135 . "', ART_136='" .  $ART_136 . "', ART_137='" .  $ART_137 . "', ART_138='" .  $ART_138 . "', ART_139='" .  $ART_139 . "', ART_140='" .  $ART_140 . "' where prolific_id='" . $id . "';";

if (!$conn->query($query)) {
    die("Execute failed");
}

$next ="https://www.psycholinguistics.ml/vocab/index3.html";

$conn -> commit();
$conn->close();
header("Location: ". $next, true, 302);
exit();
ob_end_flush();
?>

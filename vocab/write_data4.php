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


$vocab2_1= $_POST['vocab2_1'];
$vocab2_2= $_POST['vocab2_2'];
$vocab2_3= $_POST['vocab2_3'];
$vocab2_4= $_POST['vocab2_4'];
$vocab2_5= $_POST['vocab2_5'];
$vocab2_6= $_POST['vocab2_6'];
$vocab2_7= $_POST['vocab2_7'];
$vocab2_8= $_POST['vocab2_8'];
$vocab2_9= $_POST['vocab2_9'];
$vocab2_10= $_POST['vocab2_10'];
$vocab2_11= $_POST['vocab2_11'];
$vocab2_12= $_POST['vocab2_12'];
$vocab2_13= $_POST['vocab2_13'];
$vocab2_14= $_POST['vocab2_14'];
$vocab2_15= $_POST['vocab2_15'];
$vocab2_16= $_POST['vocab2_16'];
$vocab2_17= $_POST['vocab2_17'];
$vocab2_18= $_POST['vocab2_18'];
$vocab2_19= $_POST['vocab2_19'];
$vocab2_20= $_POST['vocab2_20'];
$vocab2_21= $_POST['vocab2_21'];
$vocab2_22= $_POST['vocab2_22'];
$vocab2_23= $_POST['vocab2_23'];
$vocab2_24= $_POST['vocab2_24'];
$vocab2_25= $_POST['vocab2_25'];
$vocab2_26= $_POST['vocab2_26'];
$vocab2_27= $_POST['vocab2_27'];
$vocab2_28= $_POST['vocab2_28'];
$vocab2_29= $_POST['vocab2_29'];
$vocab2_30= $_POST['vocab2_30'];
$vocab2_31= $_POST['vocab2_31'];
$vocab2_32= $_POST['vocab2_32'];
$vocab2_33= $_POST['vocab2_33'];
$vocab2_34= $_POST['vocab2_34'];
$vocab2_35= $_POST['vocab2_35'];
$vocab2_36= $_POST['vocab2_36'];
$vocab2_37= $_POST['vocab2_37'];
$vocab2_38= $_POST['vocab2_38'];
$vocab2_39= $_POST['vocab2_39'];
$vocab2_40= $_POST['vocab2_40'];
$vocab2_41= $_POST['vocab2_41'];
$vocab2_42= $_POST['vocab2_42'];
$vocab2_43= $_POST['vocab2_43'];
$vocab2_44= $_POST['vocab2_44'];
$vocab2_45= $_POST['vocab2_45'];
$vocab2_46= $_POST['vocab2_46'];
$vocab2_47= $_POST['vocab2_47'];
$vocab2_48= $_POST['vocab2_48'];
$vocab2_49= $_POST['vocab2_49'];
$vocab2_50= $_POST['vocab2_50'];
$vocab2_51= $_POST['vocab2_51'];
$vocab2_52= $_POST['vocab2_52'];
$vocab2_53= $_POST['vocab2_53'];
$vocab2_54= $_POST['vocab2_54'];
$vocab2_55= $_POST['vocab2_55'];
$vocab2_56= $_POST['vocab2_56'];
$vocab2_57= $_POST['vocab2_57'];
$vocab2_58= $_POST['vocab2_58'];
$vocab2_59= $_POST['vocab2_59'];
$vocab2_60= $_POST['vocab2_60'];

$query = "UPDATE vocabB SET vocab2_1='" .  $vocab2_1 . "', vocab2_2='" .  $vocab2_2 . "', vocab2_3='" .  $vocab2_3 . "', vocab2_4='" .  $vocab2_4 . "', vocab2_5='" .  $vocab2_5 . "', vocab2_6='" .  $vocab2_6 . "', vocab2_7='" .  $vocab2_7 . "', vocab2_8='" .  $vocab2_8 . "', vocab2_9='" .  $vocab2_9 . "', vocab2_10='" .  $vocab2_10 . "', vocab2_11='" .  $vocab2_11 . "', vocab2_12='" .  $vocab2_12 . "', vocab2_13='" .  $vocab2_13 . "', vocab2_14='" .  $vocab2_14 . "', vocab2_15='" .  $vocab2_15 . "', vocab2_16='" .  $vocab2_16 . "', vocab2_17='" .  $vocab2_17 . "', vocab2_18='" .  $vocab2_18 . "', vocab2_19='" .  $vocab2_19 . "', vocab2_20='" .  $vocab2_20 . "', vocab2_21='" .  $vocab2_21 . "', vocab2_22='" .  $vocab2_22 . "', vocab2_23='" .  $vocab2_23 . "', vocab2_24='" .  $vocab2_24 . "', vocab2_25='" .  $vocab2_25 . "', vocab2_26='" .  $vocab2_26 . "', vocab2_27='" .  $vocab2_27 . "', vocab2_28='" .  $vocab2_28 . "', vocab2_29='" .  $vocab2_29 . "', vocab2_30='" .  $vocab2_30 . "', vocab2_31='" .  $vocab2_31 . "', vocab2_32='" .  $vocab2_32 . "', vocab2_33='" .  $vocab2_33 . "', vocab2_34='" .  $vocab2_34 . "', vocab2_35='" .  $vocab2_35 . "', vocab2_36='" .  $vocab2_36 . "', vocab2_37='" .  $vocab2_37 . "', vocab2_38='" .  $vocab2_38 . "', vocab2_39='" .  $vocab2_39 . "', vocab2_40='" .  $vocab2_40 . "', vocab2_41='" .  $vocab2_41 . "', vocab2_42='" .  $vocab2_42 . "', vocab2_43='" .  $vocab2_43 . "', vocab2_44='" .  $vocab2_44 . "', vocab2_45='" .  $vocab2_45 . "', vocab2_46='" .  $vocab2_46 . "', vocab2_47='" .  $vocab2_47 . "', vocab2_48='" .  $vocab2_48 . "', vocab2_49='" .  $vocab2_49 . "', vocab2_50='" .  $vocab2_50 . "', vocab2_51='" .  $vocab2_51 . "', vocab2_52='" .  $vocab2_52 . "', vocab2_53='" .  $vocab2_53 . "', vocab2_54='" .  $vocab2_54 . "', vocab2_55='" .  $vocab2_55 . "', vocab2_56='" .  $vocab2_56 . "', vocab2_57='" .  $vocab2_57 . "', vocab2_58='" .  $vocab2_58 . "', vocab2_59='" .  $vocab2_59 . "', vocab2_60='" .  $vocab2_60 . "' where prolific_id='" . $id . "';";

if (!$conn->query($query)) {
    die("Execute failed");
}

$conn -> commit();
$conn->close();
header("Location: ". 'https://www.psycholinguistics.ml/get_next_jspsych.php', true, 302);
exit();
ob_end_flush();
?>

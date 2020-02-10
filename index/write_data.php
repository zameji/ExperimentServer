 <?php
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//pull form fields into php variables
$prolificID = $_COOKIE["id"];
$ip = getRealIpAddr();
$time_started = date("Y-m-d H:i:s");

$testgroup = $_POST['group'];
$progress = 0;
$jspsych_group = $_POST['jspsych_group'];
$jspsych_progress = 0;
$ibex_1_group = $_POST['ibex_1_group'];

$nativelang= $_POST['nativelang'];
$bilingual = $_POST['bilingual'];
$origin = $_POST['origin'];
$age= $_POST['age'];
$sex = $_POST['sex'];
$edu= $_POST['edu'];

$handness= $_POST['handness'];
$reading= $_POST['read'];
$reading_amt = '0';
$reading_enj = '0';

setcookie("ibex_1_done", false, time()+144000, "/", "psycholinguistics.ml");
setcookie("jspsych_done", false, time()+144000, "/", "psycholinguistics.ml");

setcookie("jspsych_J_done", false, time()+144000, "/", "psycholinguistics.ml");
setcookie("jspsych_K_done", false, time()+144000, "/", "psycholinguistics.ml");
setcookie("jspsych_L_done", false, time()+144000, "/", "psycholinguistics.ml");
setcookie("jspsych_M_done", false, time()+144000, "/", "psycholinguistics.ml");
setcookie("jspsych_N_done", false, time()+144000, "/", "psycholinguistics.ml");
setcookie("jspsych_O_done", false, time()+144000, "/", "psycholinguistics.ml");
setcookie("jspsych_P_done", false, time()+144000, "/", "psycholinguistics.ml");
setcookie("jspsych_Q_done", false, time()+144000, "/", "psycholinguistics.ml");
setcookie("jspsych_R_done", false, time()+144000, "/", "psycholinguistics.ml");

// redirect non-fitting candidates
if (
  ($reading == 'yes') or
	($origin == 'other') or
  ($nativelang == 'Other') or
  ($bilingual == 'fullbilingual' or $bilingual == 'earlybilingual') or
  ($age < 18)
	){
	$next = "https://www.psycholinguistics.ml/thank_you.html";
	} else {

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

$query = "UPDATE participants
		SET ip='".$ip."',
		time_started='".$time_started."',
		test_group='".$testgroup."',
		progress='".$progress."',
		jspsych_group='".$jspsych_group."',
		jspsych_progress='".$jspsych_progress."',
		ibex_1_group='".$ibex_1_group."',
		nativelang='".$nativelang."',
		bilingual='".$bilingual."',
		origin='".$origin."',
		age='".$age."',
		sex='".$sex."',
		education='".$edu."',
		handness='".$handness."',
		reading_disability='".$reading."',
		reading_amount='".$reading_amt."',
		reading_enjoyment='".$reading_enj."'
		WHERE prolific_id='".$prolificID."'";

    if (!$conn->query($query)) {
        die("Execute failed");
    }

    $next ="https://www.psycholinguistics.ml/index/info.html";

	$conn->commit();
	$conn->close();

	}

	header("Location: ". $next, true, 302);
	exit();


?>

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
$prolificID = $_POST['prolificID'];
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


// redirect non-fitting candidates
if ($reading == 'yes' or $origin=='other'){
	$next = "https://www.psycholinguistics.ml/thank_you.html";
};

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


if (!($stmt = $conn->prepare("UPDATE participants set (
								ip,
								time_started,
								test_group,
								progress,
								jspsych_group,
								jspsych_progress,
								ibex_1_group,
								nativelang,
								bilingual,
								origin,
								age,
								sex,
								education,
								handness,
								reading_disability) VALUES (?,
															?,
															?,
															?,
															?,
															?,
															?,
															?,
															?,
															?,
															?,
															?,
															?,
															?,
															?
											) where prolific_id=?"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("sssisisssssssss",
										$ip,
										$time_started,
										$testgroup,
										$progress,
										$jspsych_group,
										$jspsych_progress,
										$ibex_1_group,
										$nativelang,
										$bilingual,
										$origin,
										$age,
										$sex,
										$edu,
										$handness,
										$reading,
										$prolificID)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
    //echo '<p style="text-align:center; font-family: Lucida, Console, monospace; font-size: medium;">Failed. Have you already done the experiment?</p>';
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
} else {

	switch (substr($testgroup, 0, 1)){
		
		case "1":
			setcookie("ibex_1_group", $ibex_1_group, time()+144000, "/", "psycholinguistics.ml");		
			$next = "https://www.psycholinguistics.ml/ibex/experiment.html";
			break;
			
		case "2":
			$next = "https://www.psycholinguistics.ml/ibex_2/experiment.html";
			break;
			
		case "J":
			setcookie("jspsych_group", $jspsych_group, time()+144000, "/", "psycholinguistics.ml");
			setcookie("jspsych_progress", $jspsych_progress, time()+144000, "/", "psycholinguistics.ml");
			$next = "https://www.psycholinguistics.ml/jspsych.html";
			break;
		default:
			$next = "https://www.psycholinguistics.ml/index/server_error.html";
			break;	
	}

    echo "Redirecting..." . $next;
	$conn->close();
	header("Location: ". $next, true, 302);
	exit();

}
?>

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
echo "got 1";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (!($stmt = $conn->prepare("UPDATE participants set ip=?,  time_started=?,  test_group=?,  progress=?,  jspsych_group=?,  jspsych_progress=?,  ibex_1_group=?,  nativelang=?,  bilingual=?,  origin=?,  age=?,  sex=?,  education=?,  handness=?,  reading_disability=? where prolific_id=?"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
//echo "A";
//echo $ip . "\n" . $time_started . "\n" . $testgroup . "\n" . $progress . "\n" . $jspsych_group . "\n" . $jspsych_progress . "\n" . $ibex_1_group . "\n" . $nativelang . "\n" . $bilingual . "\n" . $origin . "\n" . $age . "\n" . $sex . "\n" . $edu . "\n" . $handness . "\n" . $reading . "\n" . $prolificID;

if (!$stmt->bind_param("s", $ip))  echo "Binding ip failed: (" . $stmt->errno . ") " . $stmt->error;}
if (!$stmt->bind_param("s", $time_started))  echo "Binding time_started failed: (" . $stmt->errno . ") " . $stmt->error;}
if (!$stmt->bind_param("s", $testgroup))  echo "Binding testgroup failed: (" . $stmt->errno . ") " . $stmt->error;}
if (!$stmt->bind_param("i", $progress))  echo "Binding progress failed: (" . $stmt->errno . ") " . $stmt->error;}
if (!$stmt->bind_param("s", $jspsych_group))  echo "Binding jspsych_group failed: (" . $stmt->errno . ") " . $stmt->error;}

if (!$stmt->bind_param("i", $jspsych_progress))  echo "Binding jspsych_progress failed: (" . $stmt->errno . ") " . $stmt->error;}
if (!$stmt->bind_param("s", $ibex_1_group))  echo "Binding ibex_1_group failed: (" . $stmt->errno . ") " . $stmt->error;}
if (!$stmt->bind_param("s", $nativelang))  echo "Binding nativelang failed: (" . $stmt->errno . ") " . $stmt->error;}
if (!$stmt->bind_param("s", $bilingual))  echo "Binding bilingual failed: (" . $stmt->errno . ") " . $stmt->error;}
if (!$stmt->bind_param("s", $origin))  echo "Binding origin failed: (" . $stmt->errno . ") " . $stmt->error;}

if (!$stmt->bind_param("s", $age))  echo "Binding age failed: (" . $stmt->errno . ") " . $stmt->error;}
if (!$stmt->bind_param("s", $sex))  echo "Binding sex failed: (" . $stmt->errno . ") " . $stmt->error;}
if (!$stmt->bind_param("s", $edu))  echo "Binding edu failed: (" . $stmt->errno . ") " . $stmt->error;}
if (!$stmt->bind_param("s", $handness))  echo "Binding handness failed: (" . $stmt->errno . ") " . $stmt->error;}
if (!$stmt->bind_param("s", $prolificID))  echo "Binding prolificID failed: (" . $stmt->errno . ") " . $stmt->error;}

if (!$stmt->execute()) {
    //echo '<p style="text-align:center; font-family: Lucida, Console, monospace; font-size: medium;">Failed. Have you already done the experiment?</p>';
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
} else {
	echo "got here";
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

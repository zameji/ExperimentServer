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
$nativelang= $_POST['nativelang'];
$bilingual = $_POST['bilingual'];
$origin = $_POST['origin'];
$write_something= $_POST['write_something'];
$age= $_POST['age'];
$sex = $_POST['sex'];
$edu= $_POST['edu'];
$typing = $_POST['typing'];
$typingspeed = $_POST['typingspeed'];
$handness= $_POST['handness'];
$reading= $_POST['read'];
$testgroup = $_POST['group'];
$internalID = $_POST['internalID'];
$next = $_POST['next'];
$ip = getRealIpAddr();

// redirect non-fitting candidates
if ($reading == 'yes' or $origin=='other' or $handness=='left'){
	$next = "https://www.psycholinguistics.ml/thank_you.html";
};

$time_started = date("Y-m-d H:i:s");

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


if (!($stmt = $conn->prepare("INSERT INTO results (prolific_id, 
								internal_id,
								ip,
								time_started,
								test_group,
								nativelang, 
								bilingual, 
								origin, 
								write_something, 
								age, 
								sex, 
								edu, 
								typing, 
								typingspeed, 
								handness, 
								reading) VALUES (?,
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
											?, 
											?
											)"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->bind_param("sssssssssissssss", $prolificID,
										$internalID,
										$ip,
										$time_started,
										$testgroup,
										$nativelang, 
										$bilingual, 
										$origin, 
										$write_something, 
										$age, 
										$sex, 
										$edu, 
										$typing, 
										$typingspeed, 
										$handness, 
										$reading)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}


if (!$stmt->execute()) {
    echo '<p style="text-align:center; font-family: Lucida, Console, monospace; font-size: medium;">Failed. Have you already done the experiment?</p>';
    //echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
} else {
    echo "Redirecting..." . $next;
	$conn->close();
	header("Location: ". $next, true, 301);
	exit();
	
}
?>

import sys

# We first build the opening part of the PHP:
#   - the opening tag
#   - start buffering the output (not really necessary here)
#   - connection to the MySQL database
#   - check that connection to MySQL is OK
#   - check that participant exists, get his JSPsych progress

php = """<?php
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

"""

# Then we pull the data from the POST request

for i in range(140):
    i += 1
    string = "$ART_q" + str(i) + "= $_POST['ART_Q" + str(i) + "'];\n"
    php += string

php += "\n"

# Now we form the query to be executed
query = "$query = \"UPDATE ART SET"
for i in range(140):
    i += 1
    query+= " ART_q" + str(i) + "='\" .  $ART_q" + str(i) + " . \"',"

# remove the last comma
query = query[0:-1]

query += ' where prolific_id=\'" . $id . "\';";\n'
php += query


# Finally:
#   - execute the query
#   - commit to the database
#   - close the DB connection
#   - redirect to the next JSPsych element/next experiment element
#   - close the PHP script

php += """
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
"""

# Finally, we write the PHP code to the PHP file
with open("write_data2.php", "w+") as f:

    f.write(php)

# Unless the flag -m is raised, print the script to the console
if "-m" not in sys.argv:
    print(php)

print("Done.")
sys.exit(0)

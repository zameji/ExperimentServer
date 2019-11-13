"""
$id = $_COOKIE['id'];
$q1a1 = $_POST['q1a1'];

$query = "update vocab set q1a1='" . $q1a1 .
  "', q1a2='no' where prolific_id=id";"""

with open("ou.php", "w+") as f:
  f.write(string_with_php)

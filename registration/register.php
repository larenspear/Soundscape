<?php
$server = "spring-2021.cs.utexas.edu";
$user = "cs329e_bulko_lcspear";
$password = "Ponder\$Rhine5magnum";
$dbname = "cs329e_bulko_lcspear";

$mysqli = new mysqli ($server,$user,$password,$dbname);

if($mysqli->connect_errno) {
    die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
}

$name = $_POST['name'];
$pw = $_POST['pass'];

$cmd = "SELECT password FROM USERS WHERE username = '$name'";

$result = $mysqli->query($cmd);
$result = mysqli_fetch_array($result);
if(count($result) == 0){
    $mysqli->query("INSERT INTO USERS (username,password) VALUES ('$name','$pw');");
}

echo "DONE";

?>

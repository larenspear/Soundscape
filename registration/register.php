<?php
$server = "spring-2021.cs.utexas.edu";
$user = "cs329e_bulko_lcspear";
$pass = "Ponder\$Rhine5magnum";
$dbname = "cs329e_bulko_lcspear";

$mysqli = new mysqli ($server,$user,$pass,$dbname);

if($mysqli->connect_errno) {
    die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$cmd = "SELECT password FROM USERS WHERE username = '$username'";

$result = $mysqli->query($cmd);
$result = mysqli_fetch_array($result);
if(count($result) == 0){
    $mysqli->query("INSERT INTO USERS (username,password,email) VALUES ('$username','$password','$email');");
}

header("Location: register.html");

?>

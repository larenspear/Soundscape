<?php
$server = "spring-2021.cs.utexas.edu";
$user = "cs329e_bulko_lcspear";
$pass = "Ponder\$Rhine5magnum";
$dbname = "cs329e_bulko_lcspear";

$mysqli = new mysqli ($server,$user,$pass,$dbname);

if($mysqli->connect_errno) {
    die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
}

$username = mysqli_real_escape_string($mysqli,$_POST['username']);
$password = mysqli_real_escape_string($mysqli,$_POST['password']);
$email = mysqli_real_escape_string($mysqli,$_POST['email']);

$cmd = "SELECT id FROM USERS WHERE username = '$username';";
$cmd2 = "SELECT id FROM USERS WHERE email = '$email';";

$user_result = $mysqli->query($cmd);
$email_result = $mysqli->query($cmd2);

if(mysqli_num_rows($user_result) > 0){
    echo "<script> alert('Username is already in use'); document.location='register.html' </script>";
} else if (mysqli_num_rows($email_result) > 0){
    echo "<script> alert('Email is already registered'); document.location='register.html' </script>";
} else {
    $mysqli->query("INSERT INTO USERS (username,password,email) VALUES ('$username','$password','$email');");
    echo "<script> alert('Registration successful! Please log in to confirm'); document.location='feed.php' </script>";

}

?>

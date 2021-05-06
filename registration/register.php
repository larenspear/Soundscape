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

$insert_query = "INSERT INTO USERS (username,password,email) VALUES ('$username','$password','$email');";

if(mysqli_num_rows($user_result) > 0){
    // echo "<script> document.location='registration.php' </script>";
    header("Location: registration.php");
    console_log("Username is already in use!");
} else if (mysqli_num_rows($email_result) > 0){
    // echo "<script> document.location='registration.php' </script>";
    header("Location: registration.php");
    console_log("Email is already registered!");
} else {
    $mysqli->query($insert_query);
    // echo "<script> document.location='registration.php' </script>";
    header("Location: registration.php");
    console_log("Registration successful! Please log in to confirm");
}


function console_log($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('" . $output . "');</script>";
}

?>

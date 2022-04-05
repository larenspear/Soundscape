<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

echo $server;
echo $username;
echo $password;
echo $db;
echo $url;

$mysqli = new mysqli($server, $username, $password, $db);

if($mysqli->connect_errno) {
    die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
}

// GET THE EXISTING DATA FROM DATABASE
$command = "SELECT * FROM USERS ORDER BY username";
$result = $mysqli->query($command);
// Verify the result
if (!$result) {
    die("Query failed: ($mysqli->error <br>");
} else {
    //console_log("Initial query succeeded!");
}

// Store the existing data in a dictionary (username => email)
$db_array = array();
while ($row = $result->fetch_row()) {
    $db_array[ $row[1] ] = $row[3] ;
}


// Login variables
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

// Escape User Input to help prevent SQL Injection
$username = $mysqli->real_escape_string($username);
$password = $mysqli->real_escape_string($password);
$email = $mysqli->real_escape_string($email);

// Compare new data with the existing ones
$username_exist = FALSE;
$email_exist = FALSE;
foreach($db_array as $key=>$value) {
    if ($key == $username){
        $username_exist = TRUE;
    }
    if ($value == $email){
        $email_exist = TRUE;
    }
}

$insert_query = "INSERT INTO USERS (username,password,email) VALUES ('$username','$password','$email');";

if ($username_exist){
    echo '<script> if (confirm("Username is already in use!")) {document.location="registration.php";} else {document.location="registration.php"} </script>';
    console_log("Username is already in use!");
}else if ($email_exist) {
    echo '<script> if (confirm("Email is already registered!")) {document.location="registration.php";} else {document.location="registration.php"} </script>';
    console_log("Email is already registered!");
}else{
    $mysqli->query($insert_query);
    echo '<script> if (confirm("Registration successful! \nPlease log in to confirm")) {document.location="registration.php";} else {document.location="registration.php"} </script>';
    console_log('Registration successful! \nPlease log in to confirm');
}


function console_log($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('" . $output . "');</script>";
}

?>

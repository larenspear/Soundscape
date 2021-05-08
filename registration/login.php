<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$server = "spring-2021.cs.utexas.edu";
$user = "cs329e_bulko_lcspear";
$pass = 'Ponder$Rhine5magnum';
$dbname = "cs329e_bulko_lcspear";

$mysqli = new mysqli ($server,$user,$pass,$dbname);

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
    console_log("Initial query succeeded!");
}

// Store the existing data in a dictionaries (email => [userId, password])
$db_array = array();
while ($row = $result->fetch_row()) {
    $db_array[ $row[3] ] = array( $row[1], $row[2] ) ;
}


// Login variables
$email = $_POST["email"];
$password = $_POST["password"];

// Escape User Input to help prevent SQL Injection
$email = $mysqli->real_escape_string($email);
$password = $mysqli->real_escape_string($password);

// Compare new data with the existing ones
$email_exist = FALSE;
$password_correct = FALSE;
$userLogin = '';

foreach($db_array as $key=>$value) {
    if ($key == $email){
        $email_exist = TRUE;
        if ($value[1] == $password){
            $password_correct = TRUE;
            $userLogin = $value[0];
        }
    }
}


if ($email_exist && $password_correct){
    setcookie("user_id", $userLogin, time() + 30000, "/");
    header("Location: ../feed.php");
}else{
    echo '<script> if (confirm("Wrong email or password!")) {document.location="registration.php";} else {document.location="registration.php"} </script>';
}


// $db = getDB();
// $email = mysqli_real_escape_string($db,$_POST['email']);
// $password = mysqli_real_escape_string($db,$_POST['password']);

// print $email;
// $return = getUser($db, $email);

// $result = $return->fetch_assoc();

// if($result != null && $password = $result["password"]) {
//     setcookie("user_id", $result["id"], time() + 30000, "/");

// } else if ($result->rowCount() > 0) {
//     $wrong_password = true;
// } else {
//     $not_registered = true;
// }
    
// if(isset($not_registered)){
//     echo '<script> if (confirm("User is not registered!")) {document.location="registration.php";} else {document.location="registration.php"} </script>';
//     //header("Location: registration.php");
//     console_log("User is not registered!");
// } else if (isset($wrong_password)) {
//     echo '<script> if (confirm("Wrong password!")) {document.location="registration.php";} else {document.location="registration.php"} </script>';
//     //header("Location: registration.php");
//     console_log("Wrong password!");
// } else {
//     header("Location: ../feed.php");
// }


function console_log($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('" . $output . "');</script>";
}

?>

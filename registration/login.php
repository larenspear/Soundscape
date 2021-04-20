<?php
$server = "spring-2021.cs.utexas.edu";
$user = "cs329e_bulko_lcspear";
$password = "Ponder\$Rhine5magnum";
$dbname = "cs329e_bulko_lcspear";

$mysqli = new mysqli ($server,$user,$password,$dbname);

if($mysqli->connect_errno) {
    die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
}

$name = $_POST['username'];
$pw = $_POST['password'];

$cmd = "SELECT password FROM USERS WHERE username = '$name'";

$result = $mysqli->query($cmd);
$result = mysqli_fetch_array($result);
if(count($result) == 0){
    $not_registered = true;
} else if($result[0] == $pw) {
    setcookie($user,'loggedin',time() + 300, "/");
} else {
    $wrong_password = true;
}
    
if(isset($not_registered)){
    echo "User is not registered";
} else if (isset($wrong_password)) {
    echo "Wrong password";
} else {
    echo "Logged in";
}

?>

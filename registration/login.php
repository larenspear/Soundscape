<?php
$server = "spring-2021.cs.utexas.edu";
$user = "cs329e_bulko_lcspear";
$password = "Ponder\$Rhine5magnum";
$dbname = "cs329e_bulko_lcspear";

$mysqli = new mysqli ($server,$user,$password,$dbname);

if($mysqli->connect_errno) {
    die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
}

$email = mysqli_real_escape_string($mysqli,$_POST['email']);
$pw = mysqli_real_escape_string($mysqli,$_POST['password']);

$cmd = "SELECT password FROM USERS WHERE email = '$email'";

$id = mysqli_fetch_array($mysqli->query("SELECT id FROM USERS WHERE email = '$email'"));

$id = $id['id'];

$result = $mysqli->query($cmd);
$result = mysqli_fetch_array($result);
if(count($result) == 0){
    $not_registered = true;
} else if($result[0] == $pw) {
    setcookie("user",$id,time() + (60 * 10), "/");
} else {
    $wrong_password = true;
}
    
if(isset($not_registered)){
    // echo "<script> document.location='registration.php' </script>";
    header("Location: registration.php");
    console_log("User is not registered!");
} else if (isset($wrong_password)) {
    // echo "<script> document.location='registration.php' </script>";
    header("Location: registration.php");
    console_log("Wrong password!");
} else {
    header("Location: ../feed.php");
}


function console_log($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('" . $output . "');</script>";
}

?>

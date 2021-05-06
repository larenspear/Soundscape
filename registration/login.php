<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
print "ashford";

include('../queries/registration_queries.php');

$db = getDB();
print $_POST['username'];
$username = mysqli_real_escape_string($db,$_POST['username']);
$password = mysqli_real_escape_string($db,$_POST['password']);

print $username;
$return = getUser($db, $username);

$result = $return->fetch_assoc();

if($result != null && $password = $result["password"]) {
    setcookie("user_id", $result["id"], time() + 30000, "/");

} else if ($result->rowCount() > 0) {
    $wrong_password = true;
} else {
    $not_registered = true;
}
    
if(isset($not_registered)){
    echo "<script> alert('User is not registered'); document.location='register.html' </script>";
} else if (isset($wrong_password)) {
    echo "<script> alert('Wrong password'); document.location='register.html' </script>";
} else {
    header("Location: ../feed.php");
}

?>

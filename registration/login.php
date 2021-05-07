<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
print "ashford";

include('../queries/registration_queries.php');

$db = getDB();
print $_POST['email'];
$email = mysqli_real_escape_string($db,$_POST['email']);
$password = mysqli_real_escape_string($db,$_POST['password']);

print $email;
$return = getUser($db, $email);

$result = $return->fetch_assoc();

if($result != null && $password = $result["password"]) {
    setcookie("user_id", $result["id"], time() + 30000, "/");

} else if ($result->rowCount() > 0) {
    $wrong_password = true;
} else {
    $not_registered = true;
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

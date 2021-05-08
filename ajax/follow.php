<?php
include('../queries/feed_queries.php');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if (isset($_GET["follow_username"])) {
    $follow_username = $_GET['follow_username'];
    if(isset($_COOKIE["user_id"])) {
        $user_id = $_COOKIE["user_id"];
    } else {
        $user_id = 12;
    }
    $response = followUser($user_id, $follow_username);
    echo $response;
    
}
    




function console_log($output, $with_script_tags = true)
{
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
    ');';
  if ($with_script_tags) {
    $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}

//print_r($_COOKIE);

?>


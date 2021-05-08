<?php
include('../queries/feed_queries.php');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if (isset($_GET["user_id"])) {
    $review_id = $_GET['review_id'];
    $user_id = $_GET['user_id'];
    $isLiked = toggleReviewLike($user_id, $review_id);
    echo $isLiked;
} else if(isset($_GET["review_id"])) {
    $review_id = $_GET["review_id"];
    $return = getReviewLikes($review_id);
    $result = $return->fetch_assoc();
    $likeCount = $result["likeCount"];

    $jsonData  = array("likeCount" => "$likeCount", "reviewId" => "$review_id");

    /*
    console_log("ash");
    $review_id = $_GET['review_id'];
    $return = getReviewLikes($review_id);
    console_log($return);
    $result = $return->fetch_assoc();
    $likeCount = $result["likeCount"];

    $jsonString = json_encode(array('likeCount' => $likeCount));
    console_log($jsonString);
    */
    echo json_encode($jsonData);
    
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


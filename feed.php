<!DOCTYPE html>
<html lang="en">

<head>
  <title> Soundscape Feed </title>
  <meta charset="UTF-8">
  <meta name="description" content="Soundscape Feed">
  <meta name="author" content="CS329E Group 13">
  <link href="./css/feed.css" rel="stylesheet">
  <script src="./jquery-3.6.0.min.js"></script>

  <link rel="icon" type="image/png" href="./data/logo1.png" />
  <script src="./Spotify/spotify.js" defer></script>
</head>

<body onload="get_access_token()">
  <div id="progressbar"></div>
  <div id="scrollPath"></div>

  <section id="pictureBorder">
  <header>
    <div class="banner">

      <!-- banner left -->
      <div id="bannerLeft">
        <a href="./home.php"><img id="logo" src="./data/logo1.png" width="120" alt="SoundscapeLogo"></a>

      </div>

      <!-- banner right -->
      <div id="bannerRight">
        <div id="buttonWrap">
          <button id="login_btn" class="sliding-button" onclick="location.href='./registration/registration.php'"> Sign In </button>
          <button id="explore_btn" class="special-button" onclick="location.href='feed.php'"> EXPLORE </button>
        <div>
        <?php
          if(!isset($_COOKIE['user_id'])){
            echo "<script type='text/javascript'>document.getElementById('explore_btn').setAttribute('onclick', 'location.href=\'./registration/registration.php\'')</script>";
          } else {
            echo "<script type='text/javascript'>document.getElementById('login_btn').innerHTML = 'Log Out'</script>";
          }
        ?>
      </div>

    </div>
  </header>

    <section id="main">

    <div id="biggerLogoWrapper">
      <img id="biggerLogo" src="./data/soundscapeTextPurple.png" alt="SoundscapeBiggerLogo">
    </div>

      <div id="mainContent">

        <div class="contentSection" id="mainContent-1">

          <div class="widget_wrap" id="feed_settings">
            <div class="widget_container">
              <h3> Featured Spotify Playlists </h3>
                <ul id="featured_playlists">

                </ul>
            </div>
          </div>

          <div class="widget_wrap" id="top_reviews">
            <div class="widget_container">
              <h3> Get Random Playlists </h3>
                <ul id="random_playlists">

                </ul>
            </div>
          </div>

        </div>

        <div class="contentSection" id="mainContent-2">
          <?php
          ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
          include 'queries/feed_queries.php';
          $db = getDB();
          if(isset($_COOKIE['user_id'])) {
            $user_id = $_COOKIE["user_id"];
          }
          
          // console_log('Cookies Test:');
          // console_log($_COOKIE['user_id']);

          $result = getPostsQuery($db);
          
          while($row = $result->fetch_assoc()) {
            $type = $row['post_type'];
            print "<div class='contentContainerWrap'>";
            createPostUser($row);
            createPostContent($db, $row);
            print "</div>";
          }
          print "<div class='contentContainerWrap'>";
          createFollowPost();
          print "</div>";
          

          function createPostUser($row) {
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            $post_datetime = $row["post_datetime"];
            $username = $row["username"];
            console_log($username);

            print <<<USER_CONTAINER
            <div class="userContainer">
            <a href="profile.php?username=$username">
            <img class="profile-pic" src='./data/temp_img.jpg' alt="profile picture">
            </a>
            <a href="profile.php?username=$username">
              <h1>$firstname $lastname</h1>
            </a>
            <div class="post-time">$post_datetime</div>
            </div>
USER_CONTAINER;
          }
          
          function createPostContent($db, $row) {
            print "<div class='contentContainer'>";
            switch ($row["post_type"]) {
              case "review":
                createReviewPost(getReviewPost($db, $row["id"]));
                break;
              case "FOLLOW_POST":
                
                break;
              case "SHAREALBUM_POSTS":
                createShareAlbumPost(getShareAlbumPost($db, $row["id"]));
                break;
              case "create_playlist":

                break;
            }
            print "</div>";
          }
          function createFollowPost() {
            /*
            console_log("head");
            $result = $return->fetch_assoc();
            console_log($result);
            $reviewContent = $result["content"];
            $albumTitle = $result["title"];
            $artistName = $result["name"];
            $imagePath = $result["profilepic"];
            */
            $follower_first = "Abi";
            $follower_last= "Iovino";
            $followed_first = "Laren";
            $followed_last = "Spear";

            print <<<CONTENT
            <div class="userContainer">
            <a href="profilepage.html">
            <img class="profile-pic" src='./data/temp_img.jpg' alt="profile picture">
            </a>
            <a href="profilepage.html">
              <h1>$follower_first $follower_last</h1>
            </a>
            <div class="post-time">2 days ago </div>
            </div>
            <div class='contentContainer'>
            <div class="reviewContainer">
              <div class="reviewContainer2"><div class="reviewContent"><h3><a href="">$follower_first $follower_last</a> just followed <a href="">$followed_first $followed_last </a>on Soundscape!</h3></div></div>
            </div></div>
CONTENT;
          }

          function createReviewPost($return) {
            $result = $return->fetch_assoc();
            $review_id = $result["review_id"];
            $reviewContent = $result["content"];
            $albumTitle = $result["title"];
            $artistName = $result["name"];
            $imagePath = $result["profilepic"];

            print <<<CONTENT
            <div class="reviewContainer">
              <img src="./data/albumart/$imagePath" alt="Can't find image" class="reviewImg">
              <table class="interactMenu">
                <tr>
                  <td>
                    <img class="likeIcon" src="./data/like.png" style="width: 70px;">
                  </td>
                  <td id="$review_id" class="likeNum"></td>
                  <td>
                    <img class="likeIcon" src="./data/comment.png" style="width: 70px;">
                  </td>
                  <td class="commentNum">0</td>
                  <td>
                    <img class="likeIcon" src="./data/view.png" style="width: 70px;">
                  </td>
                  <td class="viewNum">0</td>
                </tr>
              </table>
              <div class="reviewContainer2"><div class="reviewContent"><h3>Review of <a href="">$albumTitle</a> by <a href="">$artistName</a>:</h3> $reviewContent</div></div>
            </div>
CONTENT;
          }

          function createShareAlbumPost($return) {
            $result = $return->fetch_assoc();
            $imagePath = $result["profilepic"];
            print <<<CONTENT
              <div class="reviewContainer">
                <img src="./data/albumart/$imagePath" class="reviewImg">
                <table class="interactMenu">
                  <tr>
                    <td>
                      <img class="likeIcon" src="./data/like.png" style="width: 70px;">
                    </td>
                    <td class="likeNumShare">0</td>
                    <td>
                      <img class="likeIcon" src="./data/comment.png" style="width: 70px;">
                    </td>
                    <td class="commentNumShare">0</td>
                    <td>
                      <img class="likeIcon" src="./Soundscape/data/view.png" style="width: 70px;">
                    </td>
                    <td class="viewNumShare">0</td>
                  </tr>
                </table>
              </div>
CONTENT;
            
          }

          ?>
        
        </div>

        <div class="contentSection" id="mainContent-3">

          <div class="widget_wrap" id="feed_settings">
            <div class="widget_container">
              <h3> New Spotify Album Releases </h3>
                <ul id="new_releases">
                  
                </ul>
            </div>
          </div>

          <div class="widget_wrap" id="top_reviews">
            <div class="widget_container">
              <h3> Get Random Playlists </h3>
                <ul id="random_playlists2">

                </ul>
            </div>
          </div>

        </div>

      </div>
    </section>
    <script>
    $(document).ready(function() {
      $user_id = '<?php echo $_COOKIE["user_id"] ?>';

      $(".likeNum").each(function() {
        //$currentLikeElement = $(this);
       // $currentLikeElement.html("1");
        $review_id = $(this).attr("id");
        console.log($review_id);
        $.get({
          url: 'ajax/feed_response.php?review_id=' + $review_id,
          type: "get",
          datatype: "json",
          cache: false,
          data: {
            'review_id': $review_id,
          },
          success: function(data, status, xhr) {
            console.log(data);
            $jsonData = JSON.parse(data);
            $likeCount = $jsonData.likeCount;
            $returnReviewId = $jsonData.reviewId;

            $currentLikeElement = $("#" + $returnReviewId);
            $currentLikeElement.html($likeCount);
          },
          error: function (request, status, error) {
            console.log(error);
          }
        });

      });
      
      $('.likeNum').click(function() {
        console.log("clicked");
        $review_id = $(this).attr("id");
        $.get({
          url: 'ajax/feed_response.php',
          type: "get",
          datatype: "json",
          cache: false,
          data: {
            'review_id': $review_id,
            'user_id': $user_id 
          },
          success: function(data, status, xhr) {
            console.log(data);
          },
          error: function (request, status, error) {
            console.log(error);
          }
        });        
       



      });

      

    });
    </script>
    <script type="text/javascript">
      let progress = document.getElementById('progressbar');
      let totalHeight = document.body.scrollHeight - window.innerHeight;
      window.onscroll = function () {
        let progressHeight = (window.pageYOffset / totalHeight) * 100;
        progress.style.height = progressHeight + "%";
      }
    </script>


</body>

</html>


<?php





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



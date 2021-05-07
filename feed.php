<!DOCTYPE html>
<html lang="en">

<head>
  <title> Soundscape Feed </title>
  <meta charset="UTF-8">
  <meta name="description" content="Soundscape Feed">
  <meta name="author" content="CS329E Group 13">
  <link href="./css/feed.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="./data/logo1.png" />
  <!-- <script src="./Spotify/spotify.js" defer></script> -->
</head>

<body>
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
              <h3> Popular Albums </h3>
              <div class="settings_list">
                <ul>
                  <li> <a href="./incomplete.html"> The Land of the Fat by The Prodigy </a> </li>
                  <li> <a href="./incomplete.html"> Grease: The Soundtrack by Grease </a> </li>
                  <li> <a href="./incomplete.html"> PRODUCT by SOPHIE </a> </li>
                  <li> <a href="./incomplete.html"> Music Has the Right To Children by Boards of Canada </a> </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="widget_wrap" id="feed_settings">
            <div class="widget_container">
              <h3> Popular Songs </h3>
              <div class="settings_list">
                <ul>
                  <li> <a href="./incomplete.html"> This Must Be the Place by Talking Heads </a> </li>
                  <li> <a href="./incomplete.html"> Summer Breeze by Type O Negative </a> </li>
                  <li> <a href="./incomplete.html"> Mother by Danzig </a> </li>
                  <li> <a href="./incomplete.html"> T69 Collapse by Aphex Twin </a> </li>
                </ul>
              </div>
            </div>
        </div>
              </div>

        <div class="contentSection" id="mainContent-2">
          <?php
          ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
          include 'queries/feed_queries.php';
          console_log("yes");
          $db = getDB();
          console_log("yes1");
          if(isset($_COOKIE['user_id'])) {
            $user_id = $_COOKIE["user_id"];
          }
          
          console_log("yes2");
          $result = getPostsQuery($db);
          
          while($row = $result->fetch_assoc()) {
            $type = $row['post_type'];
            print "<div class='contentContainerWrap'>";
            console_log($row);
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
            


            print <<<USER_CONTAINER
            <div class="userContainer">
            <a href="profilepage.html">
            <img class="profile-pic" src='./data/temp_img.jpg' alt="profile picture">
            </a>
            <a href="profilepage.html">
              <h1>$firstname $lastname</h1>
            </a>
            <div class="post-time">$post_datetime </div>
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
            <div class="post-time">30 minutes ago </div>
            </div>
            <div class='contentContainer'>
            <div class="reviewContainer">
              <div class="reviewContainer2"><div class="reviewContent"><h3><a href="">$follower_first $follower_last</a> just followed <a href="">$followed_first $followed_last </a>on Soundscape!</h3></div></div>
            </div></div>
CONTENT;
          }

          function createReviewPost($return) {
            console_log("head");
            $result = $return->fetch_assoc();
            console_log($result);
            $reviewContent = $result["content"];
            $albumTitle = $result["title"];
            $artistName = $result["name"];
            $imagePath = $result["profilepic"];
            console_log("https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/albumart/$imagePath");

            print <<<CONTENT
            <div class="reviewContainer">
              <img src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/albumart/$imagePath" alt="Can't find image" class="reviewImg">
              <table class="interactMenu">
                <tr>
                  <td>
                    <img class="likeIcon" src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/like.png" style="width: 70px;">
                  </td>
                  <td class="likeNum">0</td>
                  <td>
                    <img class="likeIcon" src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/comment.png" style="width: 70px;">
                  </td>
                  <td class="likeNum">0</td>
                  <td>
                    <img class="likeIcon" src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/view.png" style="width: 70px;">
                  </td>
                  <td class="likeNum">0</td>
                </tr>
              </table>
              <div class="reviewContainer2"><div class="reviewContent"><h3>Review of <a href="">$albumTitle</a> by <a href="">$artistName</a>:</h3> $reviewContent</div></div>
            </div>
CONTENT;
          }

          function createShareAlbumPost($return) {
            $result = $return->fetch_assoc();
            $imagePath = $result["profilepic"];
            console_log("https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/albumart/$imagePath");

            print <<<CONTENT
              <div class="reviewContainer">
                <img src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/albumart/$imagePath" class="reviewImg">
                <table class="interactMenu">
                  <tr>
                    <td>
                      <img class="likeIcon" src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/like.png" style="width: 70px;">
                    </td>
                    <td class="likeNum">0</td>
                    <td>
                      <img class="likeIcon" src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/comment.png" style="width: 70px;">
                    </td>
                    <td class="likeNum">0</td>
                    <td>
                      <img class="likeIcon" src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/view.png" style="width: 70px;">
                    </td>
                    <td class="likeNum">0</td>
                  </tr>
                </table>
              </div>
CONTENT;
            
          }

          ?>
        
        </div>

        <div class="contentSection" id="mainContent-3">
          <div class="widget_wrap" id="top_reviews">
            <div class="widget_container">
              <h3> Top Users </h3>
              <div class="settings_list">
                <ol>
                  <li> <a href="./incomplete.html"> &nbsp; Abi Ionivo </a> </li>
                  <li> <a href="./incomplete.html"> &nbsp; Laren Spear </a> </li>
                  <li> <a href="./incomplete.html"> &nbsp; Ashford Hastings </a> </li>
                  <li> <a href="./incomplete.html"> &nbsp; Review IV </a> </li>
                  <li> <a href="./incomplete.html"> &nbsp; Bob Duncan </a> </li>
                  <li> <a href="./incomplete.html"> &nbsp; David Lee Roth </a> </li>
                </ol>
              </div>
            </div>
          </div>

          <div class="widget_wrap" id="my_playlists">
            <div class="widget_container">
              <h3> Popular Reviews </h3>
              <div class="settings_list">
                <ul>
                  <li> <a href="./incomplete.html"> Torch of the Mythics by Abi Ionivo </a> </li>
                  <li> <a href="./incomplete.html"> The Fat of the Land by Ashford Hastings </a> </li>
                  <li> <a href="./incomplete.html"> PRODUCT by Abi Ionivo </a> </li>
                  <li> <a href="./incomplete.html"> No Shame by Laren Spear </a> </li>
                  <li> <a href="./incomplete.html"> Music Has the Right To Children by Laren Spear </a> </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
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

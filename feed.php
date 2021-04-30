<!DOCTYPE html>
<html lang="en">

<head>
  <title> Soundscape Feed </title>
  <meta charset="UTF-8">
  <meta name="description" content="Soundscape Feed">
  <meta name="author" content="CS329E Group 13">
  <link href="./css/feed.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="./data/logo1.png" />
</head>


<body>
  <section id="pictureBorder">
    <header>
      <div class="banner">

        <!-- banner left -->
        <div id="bannerLeft">
          <a href="./home.php"><img id="logo" src="./data/logo1.png" width="120px" alt="SoundscapeLogo"></a>
        </div>

        <!-- banner right -->
        <div id="bannerRight">
          <p>
            <a id="register" href="./registration/registration.php">
              &nbsp;&nbsp; &nbsp; Login / Register
            </a>
            <?php
              if(!isset($_COOKIE['user'])){
                echo "<script type='text/javascript'>document.getElementById('explore2').setAttribute('href', './registration/registration.php')</script>";
              } else {
                echo "<script type='text/javascript'>document.getElementById('register').innerHTML = 'Log Out'</script>";
              }
            ?>
          </p>
          <p id="explore">
            <a href="./feed.php">
              EXPLORE
            </a>
          </p>
        </div>

      </div>
    </header>

    <section id="main">

      <div class="contentContainer" id="biggerLogoWrapper">
        <img id="biggerLogo" class="center" src="./data/soundscapeTextPurple.png" alt="SoundscapeBiggerLogo">
      </div>

      <div id="mainContent">

        <div class="contentSection" id="mainContent-1">
          <div class="widget_wrap" id="feed_settings">
            <div class="widget_container">
              <h3> Feed Settings </h3>
              <div class="settings_list">
                <ul>
                  <li> <a href="./incomplete.php"> Setting 1 </a> </li>
                  <li> <a href="./incomplete.php"> Setting 2 </a> </li>
                  <li> <a href="./incomplete.php"> Setting 3 </a> </li>
                  <li> <a href="./incomplete.php"> Setting 4 </a> </li>
                  <li> <a href="./incomplete.php"> Setting 5 </a> </li>
                  <li> <a href="./incomplete.php"> Setting 6 </a> </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="widget_wrap" id="event_calendar">
            <div class="widget_container">
              <h3> Event Calendar </h3>
              <div>
                <img id="temp_calendar" src="./data/monthofmayhem.jpg">
              </div>
              coming soon!
            </div>
          </div>

        </div>

        <div class="contentSection" id="mainContent-2">
          <?php
          include 'queries.php';
          $db = getDB();
          //$user_id = $_SESSION["user_id"];
          $user_id = 1;
          
          $result = getPostsQuery($db);
          
          while($row = $result->fetch_assoc()) {
            $type = $row['post_type'];
            print "<div class='contentContainerWrap'>";
            console_log($row);
            createPostUser($row);
            createPostContent($db, $row);
            print "</div>";
          }

          

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
              case "follow":
                
                break;
              case "SHAREALBUM_POSTS":
               createShareAlbumPost($row);
                break;
              case "create_playlist":

                break;
            }
            print "</div>";
          }
          
          function createReviewPost($return) {
            console_log("head");
            $result = $return->fetch_assoc();
            //console_log($result);
            $reviewContent = $result["content"];
            $imagePath = $result["profilepic"];
            console_log("https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/albumart/$imagePath");

            print <<<CONTENT
            <div class="reviewContainer">
              <img src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/albumart/$imagePath" alt="Can't find image" class="reviewImg">
              <table class="interactMenu">
                <tr>
                  <td>
                    <img class="likeIcon" src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/like.jpg" style="width: 70px;">
                  </td>
                  <td class="likeNum">0</td>
                  <td>
                    <img class="likeIcon" src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/like.jpg" style="width: 70px;">
                  </td>
                  <td class="likeNum">0</td>
                  <td>
                    <img class="likeIcon" src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/like.jpg" style="width: 70px;">
                  </td>
                  <td class="likeNum">0</td>
                </tr>
              </table>
              <div class="review-content">$reviewContent</div>
            </div>
CONTENT;
          }

          function createShareAlbumPost($result) {
            $imagePath = $result["profilepic"];

            print <<<CONTENT
              <div class="reviewContainer">
                <img src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/albumart/$imagePath" class="reviewImg">
                <table class="interactMenu">
                  <tr>
                    <td>
                      <img class="likeIcon" src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/like.jpg" style="width: 70px;">
                    </td>
                    <td class="likeNum">0</td>
                    <td>
                      <img class="likeIcon" src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/like.jpg" style="width: 70px;">
                    </td>
                    <td class="likeNum">0</td>
                    <td>
                      <img class="likeIcon" src="https://spring-2021.cs.utexas.edu/cs329e-bulko/ashfordh/Soundscape5/Soundscape/data/like.jpg" style="width: 70px;">
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
              <h3> Top Reviews </h3>
              <div class="settings_list">
                <ol>
                  <li> <a href="./incomplete.php"> &nbsp; Review I </a> </li>
                  <li> <a href="./incomplete.php"> &nbsp; Review II </a> </li>
                  <li> <a href="./incomplete.php"> &nbsp; Review III </a> </li>
                  <li> <a href="./incomplete.php"> &nbsp; Review IV </a> </li>
                  <li> <a href="./incomplete.php"> &nbsp; Review V </a> </li>
                  <li> <a href="./incomplete.php"> &nbsp; Review VI </a> </li>
                </ol>
              </div>
            </div>
          </div>

          <div class="widget_wrap" id="my_playlists">
            <div class="widget_container">
              <h3> My Playlists </h3>
              <div class="settings_list">
                <ul>
                  <li> <a href="./incomplete.php"> Playlist 1 </a> </li>
                  <li> <a href="./incomplete.php"> Playlist 2 </a> </li>
                  <li> <a href="./incomplete.php"> Playlist 3 </a> </li>
                  <li> <a href="./incomplete.php"> Playlist 4 </a> </li>
                  <li> <a href="./incomplete.php"> Playlist 5 </a> </li>
                  <li> <a href="./incomplete.php"> Playlist 6 </a> </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
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

print_r($_COOKIE);

?>

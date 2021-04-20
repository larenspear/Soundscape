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
          <a href="./home.html"><img id="logo" src="./data/logo1.png" width="120px" alt="SoundscapeLogo"></a>
        </div>

        <!-- banner right -->
        <div id="bannerRight">
          <p>
            <a href="./registration/register.html">
              &nbsp;&nbsp; &nbsp; Login / Register
            </a>
          </p>
          <p id="explore">
            <a href="./feed.html">
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
                  <li> <a href="./incomplete.html"> Setting 1 </a> </li>
                  <li> <a href="./incomplete.html"> Setting 2 </a> </li>
                  <li> <a href="./incomplete.html"> Setting 3 </a> </li>
                  <li> <a href="./incomplete.html"> Setting 4 </a> </li>
                  <li> <a href="./incomplete.html"> Setting 5 </a> </li>
                  <li> <a href="./incomplete.html"> Setting 6 </a> </li>
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

          $readjson = file_get_contents('posts.json');
          $posts = json_decode($readjson, true);
          console_log($posts);
          foreach ($posts as $key => $value) {
            $post = $value["post"];
            print "<div class='contentContainerWrap'>";
            createPostUser($value["user"]);
            createPostContent($value["post"]);
            print "</div>";
          }

          function createPostUser($user) {
            $name = $user["name"];
            $profile_pic_path = $user["profile_pic_path"];


            print <<<USER_CONTAINER
            <div class="userContainer">
              <a href="$profile_pic_path">
                <h1>$name</h1>
              </a>
              <a href="./profilepage.html?name=$name">
                <img class="profile-pic" src='./data/temp_img.jpg' alt="profile picture">
              </a>
            </div>
USER_CONTAINER;
          }

          function createPostContent($post) {
            $content = $post["content"];

            print "<div class='contentContainer'>";
            switch ($post["type"]) {
              case "album_review":
                $album = $content["album"];
                $artist = $content["artist"];
                $score = $content["score"];
                $review = $content["review"];

                print <<<CONTENT
                <h3>Reviewed $album by $artist</h3>
                <p>$review</p>
CONTENT;

                break;
              case "follow":
                $followee = $content["followee"];

                print <<<CONTENT
                <h3>Just followed $followee on Soundscape!</h3>
CONTENT;

                break;
              case "share":
                $type = $content["type"];
                $shared_media = ($type == "album") ? $content["album"] : $content["song"];
                $artist = $content["artist"];


                print <<<CONTENT
                <h3>Shared the $type $shared_media by $artist!</h3>
CONTENT;
                break;
              case "create_playlist":
                $title = $content["title"];
                $description = $content["description"];

                print <<<CONTENT
                <h3>Created a new playlist called "$title"!</h3>
                <p>$description</p>
CONTENT;

                break;
            }
            print "</div>";
          }
          ?>
        
        </div>

        <div class="contentSection" id="mainContent-3">
          <div class="widget_wrap" id="top_reviews">
            <div class="widget_container">
              <h3> Top Reviews </h3>
              <div class="settings_list">
                <ol>
                  <li> <a href="./incomplete.html"> &nbsp; Review I </a> </li>
                  <li> <a href="./incomplete.html"> &nbsp; Review II </a> </li>
                  <li> <a href="./incomplete.html"> &nbsp; Review III </a> </li>
                  <li> <a href="./incomplete.html"> &nbsp; Review IV </a> </li>
                  <li> <a href="./incomplete.html"> &nbsp; Review V </a> </li>
                  <li> <a href="./incomplete.html"> &nbsp; Review VI </a> </li>
                </ol>
              </div>
            </div>
          </div>

          <div class="widget_wrap" id="my_playlists">
            <div class="widget_container">
              <h3> My Playlists </h3>
              <div class="settings_list">
                <ul>
                  <li> <a href="./incomplete.html"> Playlist 1 </a> </li>
                  <li> <a href="./incomplete.html"> Playlist 2 </a> </li>
                  <li> <a href="./incomplete.html"> Playlist 3 </a> </li>
                  <li> <a href="./incomplete.html"> Playlist 4 </a> </li>
                  <li> <a href="./incomplete.html"> Playlist 5 </a> </li>
                  <li> <a href="./incomplete.html"> Playlist 6 </a> </li>
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



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title> Post A review </title>
  <meta charset="UTF-8">
  <meta title="description" content="Profile Page">
  <meta title="author" content="CS329E Group 13">
  <link href="./css/postReview.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="./data/logo1.png" />
   <script
  src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
  integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
  crossorigin="anonymous"></script>
  <!--<script src="review_valid.js" async></script> -->
  <script>$( document ).ready(function() {setTimeout(function(){ $('#loading').hide();$('.display').show(); }, 2100); });
</script>
</head>

<body>

  <div id="loading">
    <img id="loading-image" src="https://media.giphy.com/media/UGrpkMXipFWQ06IHIM/giphy.gif" alt="Loading..." />
  </div>
 
  <section class ="display"  id="pictureBorder">

    <header>
      <div class="banner">

        <!-- banner left -->
        <div id="bannerLeft">
          <a href="./home.php"><img id="logo" src="./data/logo1.png" width="100" alt="SoundscapeLogo"></a>
        </div>
        <div id="backbutton">
          <a href="./profilepage.html"><img src="./data/back_button.png" width="100" alt="backbutton"></a>
        </div>
      </div>
    </header>

    <section id="main">

    <div id="formContainer">
    <h2>New Post</h2>
    <p><span class="error" style="color:red;" >* required field</span></p>
    <form method="post" action="postReview.php" style="color:#AD8DFB; font-weight:bold;">

    <table>
        <tr>
        <td><label>Album: <input type="text" name="album" id="album" required></label></td><td><span style="color:red;">*<br></span><br></td>
        </tr>

        <tr>
        <td><label>Artist: <input type="text" name="artist" id="artist" required></label></td><td><span style="color:red;">*<br></span></td>
        </tr>
   
        <tr>
        <td><label><br>Link: <input type="text" name="link" id="link"></label></td>
        </tr>

        <tr>
        <td><label> <br>Review: <span style="color:red;">*</span><br> <input type="text" style = "height:200px; width:300px;" name="review" id="review" required></label></td><td></td>
        </tr>

       </table><br>
    <input type="submit" value="Submit" id="submit">
    </form><br><br>
    
    
  <?php
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    if(!isset($_POST['album'])){
    die();
    }

    include 'queries/user_queries.php';
    $mysqli = getDB();
    console_log("1");
    if($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
    }
    console_log("2");
    $author_id = $_COOKIE['user_id'];
    $album = mysqli_real_escape_string($mysqli,$_POST["album"]);
    $artist = mysqli_real_escape_string($mysqli,$_POST["artist"]);
    $link = "";
    $review = mysqli_real_escape_string($mysqli,$_POST["review"]);
    console_log("3");
    postReview($mysqli, $author_id, $album, $artist, $link, $review);


    if (isset($_POST["album"])){
        echo "Thank you for your submission!";
    } else {
    }

    ?>

    </section>

    <footer>
      <div>
        &copy; <a href="./home.php"> Soundscape </a> &bull; <a href="./about.php">
          Contact Us </a> &emsp; &bull; Page Last Updated:
        <script>
          document.write(document.lastModified);
        </script>
      </div>
    </footer>

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

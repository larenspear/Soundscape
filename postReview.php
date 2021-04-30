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
  <script src="review_valid.js" async></script>
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
          <a href="./home.php"><img id="logo" src="./data/logo1.png" width="100px" alt="SoundscapeLogo"></a>
        </div>
        <div id="backbutton">
          <a href="./profilepage.html"><img src="./data/back_button.png" width="100px" alt="backbutton"></a>
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
        <td><label>Album: <input type="text" name="album" id="album" required></label></td><td>*</td>
        </tr>

        <tr>
        <td><label>Artist: <input type="text" name="artist" id="artist" required></label></td><td>*</td>
        </tr>
   
        <tr>
        <td><label>Link: <input type="text" name="link" id="link"></label></td>
        </tr>

        <tr>
        <td><label> Review: <input type="text" name="review" id="review" required></label></td><td>*</td>
        </tr>

    </table>
    <input type="submit" value="Submit" id="submit">
    </form>
    
  <?php

    if(!isset($_POST['album'])){
    die();
    }

    $server = "spring-2021.cs.utexas.edu";
    $dbUser = "cs329e_bulko_lcspear";
    $dbPass = "Ponder\$Rhine5magnum";
    $dbName = "cs329e_bulko_lcspear";

    $mysqli = new mysqli ($server,$dbUser,$dbPass,$dbName);

    if($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
    }

    //Need to query a bunch of tables - bad news

    $author_id = $_COOKIE['user'];
    $album = mysqli_real_escape_string($mysqli,$_POST["album"]);
    $artist = mysqli_real_escape_string($mysqli,$_POST["artist"]);
    $link = mysqli_real_escape_string($mysqli,$_POST["link"]);
    $review = mysqli_real_escape_string($mysqli,$_POST["review"]);

    if(mysqli_num_rows($mysqli->query("SELECT id from ARTISTS WHERE name='$artist';")) == 0){
        $mysqli->query("INSERT INTO ARTISTS (name) VALUES ('$artist');");
    }
    $artist_id = $mysqli->query("SELECT id from ARTISTS WHERE name='$artist';");
    
    if(mysqli_num_rows($mysqli->query("SELECT id from ALBUMS WHERE name='$album';")) == 0){
        $mysqli->query("INSERT INTO ALBUMS (title) VALUES ('$album');");
    }
    $album_id = $mysqli->query("SELECT id from ALBUMS WHERE name='$album';");

    $cmd = "INSERT INTO REVIEWS (author_id, content, album_id) VALUES ('$author_id', '$content', '$album_id');"; 

    $mysqli->query($cmd);

    if (isset($_POST["album"])){
        echo "Thank you for your submission!";
    } else {
    }

    ?>

    </section>

    <footer>
      <div>
        &copy; <a href="./home.php"> Soundscape </a>
        &bull; <a href="https://github.com/larenspear/Soundscape"> Github </a>
        &emsp; &bull; Page Last Updated:
        <script> document.write(document.lastModified);</script>
      </div>
    </footer>

  </section>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <title> Post A review </title>
  <meta charset="UTF-8">
  <meta title="description" content="Profile Page">
  <meta title="author" content="CS329E Group 13">
  <link href="./css/postReview.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="./data/logo1.png" />
</head>

<body>
  <section id="pictureBorder">

    <header>
      <div class="banner">

        <!-- banner left -->
        <div id="bannerLeft">
          <a href="./home.html"><img id="logo" src="./data/logo1.png" width="100px" alt="SoundscapeLogo"></a>
        </div>

      </div>
    </header>

    <section id="main">


      <?php
// define variables and set to empty values
$titleErr = $artistErr  = $spotifylinkErr = "";
$title = $artist = $review = $spotifylink = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["title"])) {
    $titleErr = "Album title is required";
  } else {
    $title = test_input($_POST["title"]);
    // check if title only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$title)) {
      $titleErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["artist"])) {
    $artistErr = "Artist name is required";
  } else {
    $artist = test_input($_POST["artist"]);
  }
    
  if (empty($_POST["link"])) {
    $link = "";
  } else {
    $link = test_input($_POST["link"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$link)) {
      $linkErr = "Invalid URL";
    }
  }

  if (empty($_POST["review"])) {
    $review = "";
  } else {
    $review = test_input($_POST["review"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div id="formContainer">
<h2>New Post</h2></h2>
<p><span class="error"style="color:#ec3b83;" >* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="color:#AD8DFB; font-weight:bold;">
  Album: <input type="text" name="title" value="<?php echo $title;?>">
  <span class="error" style="color:red;">* <?php echo $titleErr;?></span>
  <br><br>
  Artist: <input type="text" name="artist" value="<?php echo $artist;?>">
  <span class="error" style="color:red;">* <?php echo $artistErr;?></span>
  <br><br>
  Link: <input type="text" name="link" value="<?php echo $link;?>">
  <span class="error"><?php echo $spotifylinkErr;?></span>
  <br><br>
  Review:<span style="color:red;"> *</span> <br><textarea name="review" rows="5" cols="40"><?php echo $review;?></textarea>
  <br><br>
 
  <input id="submit" type="submit" name="submit" value="Submit">
</form>

    </section>

    <footer>
      <div>
        &copy; <a href="./home.html"> Soundscape </a>
        &bull; <a href="https://github.com/larenspear/Soundscape"> Github </a>
        &emsp; &bull; Page Last Updated:
        <script> document.write(document.lastModified);</script>
      </div>
    </footer>

  </section>
</body>

</html>
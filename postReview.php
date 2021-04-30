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
          <a href="./home.html"><img id="logo" src="./data/logo1.png" width="100px" alt="SoundscapeLogo"></a>
        </div>
        <div id="backbutton">
          <a href="./profilepage.html"><img src="./data/back_button.png" width="100px" alt="backbutton"></a>
        </div>
      </div>
    </header>

    <section id="main">


      <?php
// define variables and set to empty values
$titleErr = $artistErr = $reviewErr  = $spotifylinkErr = "";
$title = $artist = $review = $spotifylink = "";

  if (empty($_POST["title"])) {
    $titleErr = "Album title is required";
  } else {
    $title = test_input($_POST["title"]);
    $titleErr = "";
  }
  
  
  if (empty($_POST["artist"])) {
    $artistErr = "Artist name is required";
  } else {
    $artist = test_input($_POST["artist"]);
    $artistErr = "";
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
    $reviewErr = "Review is required";
  } else {
    $review = test_input($_POST["review"]);
    $reviewErr ="";
  }

function test_input($data) {
  $data = trim($data);
  return $data;
  
  
}

$error = (empty($_POST["title"]))+(empty($_POST["artist"])) +(empty($_POST["review"]));
if (isset($_POST["submit"]) and $error === 0)
{
    thanksPage();
  }
  
else{
  displayForm();
  
}

 function displayForm(){
$script = $_SERVER['PHP_SELF'];
print<<<FORM
<div id="formContainer">
<h2>New Post</h2>
<p><span class="error" style="color:red;" >* required field</span></p>
<form method="post" action="$scipt" style="color:#AD8DFB; font-weight:bold;">
  Album: <input type="text" name="title">
  <span class="error" style="color:red;">*  $titleErr</span>
  <br><br>
Artist: <input type="text" name="artist"><span class="error" style="color:red;">*  $artistErr</span><br><br>
Link: <input type="text" name="link>
<span class="error">  $spotifylinkErr</span>
<br><br>
Review:<span style="color:red;"> *</span> <br><input type="text" name="review" rows="5" cols="40">  $review</input>
<br><br>
<input id="submit" type="submit" name="submit" value="Submit">
</form>
FORM;
  }

function thanksPage ()
  {
$title = $_POST["title"];
$artist = $_POST["artist"];
$review = $_POST["review"];
print <<<THANKYOU
<div id="formContainer">
<h2> Thank you for your submission! </h2>
<br>
<p style="color:#a1caf1;"> Your input: <p>
<p> $title <br> $artist <br> $review <br> </p>
THANKYOU;
  }
  
 

?>



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

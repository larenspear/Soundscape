<!DOCTYPE html>
<html lang="en">

<head>
  <title> Incomplete! </title>
  <meta charset="UTF-8">
  <link href="./css/incomplete.css" rel="stylesheet">
  <meta name="description" content="work in progress">
  <meta name="author" content="CS329E Group 13">
  <link rel="icon" type="image/png" href="./data/logo1.png" />
</head>

<body>

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
    <div id="mainContent" class="center">


      <div class="contentContainerWrap" id="incompleteMsg">
        <div class="contentContainer">
          <h3> Oops... Content Incomplete. </h3>
          <p>Return to <a id="goBack" href="./home.php">home page</a>.
          </p>
        </div>
      </div>


    </div>
  </section>

  <br><br>
  <br><br>
  <footer>
    <div>
      &copy; <a href="./home.php"> Soundscape </a> &bull; <a href="./about.php">
        Contact Us </a> &emsp; &bull; Page Last Updated:
      <script>
        document.write(document.lastModified);
      </script>
    </div>
  </footer>

</body>

</html>
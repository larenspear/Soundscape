<!DOCTYPE html>
<html lang="en">

<head>
  <title> Incomplete! </title>
  <link href="./css/about.css" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="description" content="work in progress">
  <meta name="author" content="CS329E Group 13">
  <link rel="icon" type="image/png" href="./data/logo1.png" />
</head>

<body>
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
        </p>
        <p id="explore">
          <a id="explore2" href="./feed.php">
            EXPLORE
          </a>
        </p>
        <?php
          if(!isset($_COOKIE['user'])){
            echo "<script type='text/javascript'>document.getElementById('explore2').setAttribute('href', './registration/registration.php')</script>";
          } else {
            echo "<script type='text/javascript'>document.getElementById('register').innerHTML = 'Log Out'</script>";
          }
        ?>
      </div>

    </div>
  </header>

  <section id="main">
    <div id="mainContent" class="center">
      <div class="contentContainerWrap" id="featureA">
        <div class="contentContainer">
          <h3> Oops... Content Incomplete. </h3>
          <p>Return to <a href="./home.php">home page</a>.
          </p>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div>
      &copy; <a href="./home.php"> Soundscape </a> &bull; <a href="https://github.com/larenspear/Soundscape">
        Github </a> &emsp; &bull; Page Last Updated:
      <script>
        document.write(document.lastModified);
      </script>
    </div>
  </footer>

  </section>
</body>

</html>
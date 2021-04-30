<!DOCTYPE html>
<html lang="en">

<head>
  <title> About Us! </title>
  <meta charset="UTF-8">
  <meta name="description" content="About Us">
  <meta name="author" content="CS329E Group 13">
  <link href="./css/about.css" rel="stylesheet">
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

  <div class="contentContainer" id="biggerLogoWrapper">
    <img id="biggerLogo" class="center" src="./data/soundscapeTextPurple.png" alt="SoundscapeBiggerLogo">
  </div>

  <section id="main">
    <div id="mainContent" class="center">

      <div class="contentContainerWrap" id="feature0">
        <div class="contentContainer">
          <h3> Laren Spear </h3>
          <p>Laren is a fan of all sorts of electronic music, especially house and techno. When he's not
            thinking about music, he is a chemistry major in his final year at UT-Austin and likes writing
            Python programs to automate tasks that don't
            need to be automated.
          </p>
        </div>
      </div>

      <div class="contentContainerWrap" id="feature1">
        <div class="contentContainer">
          <h3> Abi Iovino </h3>
          <p>Abi, like the rest of us, is a music lover. She also enjoys traveling, having moved to Italy
            during the semester. We're all just a little bit jealous.
          </p>
        </div>
      </div>

      <div class="contentContainerWrap" id="feature2">
        <div class="contentContainer">
          <h3> Mehmet Y. Zenginerler </h3>
          <p>Mehmet is mysterious. Not even he knows what kind of music he likes. Like the ideal user of our
            website! He was once a military student, then a psychology student, now he is a software
            developer. We're excited to see what his next
            move will be!
          </p>
        </div>
      </div>

      <div class="contentContainerWrap" id="feature3">
        <div class="contentContainer">
          <h3> Ashford Hastings </h3>
          <p>Ashford is a big fan of indie rock and the Austin music scene. He also likes learning new
            programming frameworks and believes this site will be better than RateYourMusic once it takes
            off.
          </p>
        </div>
      </div>

    </div>
  </section>

  <footer>
    <div>
      &copy; <a href="./home.html"> Soundscape </a> &bull; <a href="https://github.com/larenspear/Soundscape">
        Github </a> &emsp; &bull; Page Last Updated:
      <script>
        document.write(document.lastModified);
      </script>
    </div>
  </footer>

  </section>
</body>

</html>
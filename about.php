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
  <div id="progressbar"></div>
  <div id="scrollPath"></div>

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

    <div id="mainContent" class="center">
      <div class="contentContainerWrap">
        <div class="contentContainer">
          <div class="animation_box">
            <div class="box_title">
              Abigail Antonia Iovino
            </div>
            <div class="animation_content">
              <h3>Abigail Antonia Iovino</h3>
              <p style="font-size:11pt;">
                Abi, like the rest of us, is a music lover. She also enjoys traveling, having moved to Italy
                during the semester. We're all just a little bit jealous.<br>
                Here is a song I can't get out of my head!
<iframe width="200" height="60" src="https://www.youtube.com/embed/PC9tgxm9BMM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="contentContainerWrap">
        <div class="contentContainer">
          <div class="animation_box">
            <div class="box_title">
              Mehmet Yavuz Zenginerler
            </div>
            <div class="animation_content">
              <h3>Mehmet Yavuz Zenginerler</h3>
              <p style="font-size:11pt; line-height:1.4;">
                Mehmet is mysterious. Not even he knows what kind of music he likes. Like the ideal user of our
                website! He was once a military student, then a psychology student, now he is a software
                developer. We're excited to see what his next
                move will be!<br>
                Here is a song I can't get out of my head!
<iframe width="200" height="60" src="https://www.youtube.com/embed/LYU-8IFcDPw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="contentContainerWrap">
        <div class="contentContainer">
          <div class="animation_box">
            <div class="box_title">
              Laren Spear
            </div>
            <div class="animation_content">
              <h3>Laren Spear</h3>
              <p style="font-size:11pt; line-height:1.4;">
                Laren is a fan of all sorts of electronic music, especially house and techno. When he's not
                thinking about music, he is a chemistry major in his final year at UT-Austin and likes writing
                Python programs to automate tasks that don't
                need to be automated.<br>
                Here is a song I can't get out of my head!
                <iframe width="200" height="60" src="https://www.youtube.com/embed/4xmckWVPRaI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="contentContainerWrap">
        <div class="contentContainer">
          <div class="animation_box">
            <div class="box_title">
              Ashford Hastings
            </div>
            <div class="animation_content">
              <h3>Ashford Hastings</h3>
              <p style="font-size:11pt;">
                Ashford is a big fan of indie rock and the Austin music scene. He also likes learning new
                programming frameworks and believes this site will be better than RateYourMusic once it takes
                off.<br>
                Here is a song I can't get out of my head!
                <iframe width="200" height="60" src="https://www.youtube.com/embed/Sd0u7-qP2I0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
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

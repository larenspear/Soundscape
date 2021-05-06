<!DOCTYPE html>
<html lang="en">

<head>
  <title> Soundscape Home </title>
  <meta charset="UTF-8">
  <meta name="description" content="The Soundscape Homepage">
  <meta name="author" content="CS329E Group 13">
  <link href="./css/home.css" rel="stylesheet">
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
          if(!isset($_COOKIE['user'])){
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
              WHO WE ARE
            </div>
            <div class="animation_content">
              <h3>Who We Are</h3>
              <p>
                We may be programmers, we may be computer scientists, but above all, we're music lovers. We
                built Soundscape to be the perfect place to discover new music. Where competitors fail, we
                bring the music social network you've always
                wanted.<br>
                <a href="./about.php" style="color:#ff6600"><b>&#9658; More About Us </b></a>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="contentContainerWrap">
        <div class="contentContainer">
          <div class="animation_box">
            <div class="box_title">
              FOLLOW YOUR FRIENDS
            </div>
            <div class="animation_content">
              <h3>Follow Your Friends</h3>
              <p>
                Music is a social activity! Don't be left out of the loop on your friends' new music
                discoveries. Make new friends with common interests. Try out some new music, just for the
                fun of it.
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="contentContainerWrap">
        <div class="contentContainer">
          <div class="animation_box">
            <div class="box_title">
              ASK FOR RECOMMENDATIONS
            </div>
            <div class="animation_content">
              <h3> Ask For Recommendations </h3>
              <p>
                Don't know what to listen to today? In a bad mood and want something to cheer you up? Need a
                new playlist for your scenic Sunday drive? Ask your friends, or the whole world, and see
                what they suggest. Two heads are better than one!
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="contentContainerWrap">
        <div class="contentContainer">
          <div class="animation_box">
            <div class="box_title">
              SHARE YOUR TASTE
            </div>
            <div class="animation_content">
              <h3>Share Your Taste</h3>
              <p>
                Do your friends always bother you all the time to see what you're listening to? Get them off
                your back and let everyone know what you're listening to! Share your best kept musical
                secrets.
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="contentContainerWrap">
        <div class="contentContainer">
          <div class="animation_box">
            <div class="box_title">
              DISCOVER NEW ARTIRTS
            </div>
            <div class="animation_content">
              <h3> Discover New Artists </h3>
              <p>
                Finding new music can be a chore, but it doesn't have to be with Soundscape. Find new
                artists you never would have listened to, without any effort on your part. Just sit back,
                relax, and let the music take control.
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
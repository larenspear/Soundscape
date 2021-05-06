<!DOCTYPE html>
<html lang="en">

<head>
  <title>Join Soundscape!</title>
  <meta charset="UTF-8">
  <link href="register.css" rel="stylesheet">
  <meta name="description" content="Registration">
  <meta name="author" content="CS329E Group 13">
  <link rel="icon" type="image/png" href="../data/logo1.png" />
  <script src="register.js" defer></script>
</head>

<body>
  <?php
  if(isset($_COOKIE['user'])){
    setcookie('user', '', time()-3600, "/");
  }
  ?>
  <img src="../data/signup.png" alt="signup_img" id="signUpPic" class="center">
  <div class="contentContainerWrap">
    <div class="contentContainer" id="container">

      <div id="sign_up">
        <form action="register.php" method="post" onsubmit="return validate_registration()" name='new_user'>
          <h3> Create an Account: </h3>
          <input type="text" name="username" placeholder="User Name" required />
          <input type="email" name="email" placeholder="Email" required />
          <input type="password" name="password" placeholder="Password" required />
          <span class="errorWrap">
            <p id="signup_error1">error1</p>
            <p id="signup_error2">error1</p>
          </span>
          <button type="submit" id="sign_up_button"> SIGN UP </button>
        </form>
      </div>


      <div id="coverWrap">
        <div id="cover">
          <div class="cover-sections left_cover">
            <h2>Don't you have an account?</h2>
            No worries, just create a new account with us!
            <button class="ghost" id="sign_up_slide"> SIGN UP </button>
          </div>
          <div class="cover-sections right_cover">
            <h2>Already have an Account?</h2>
            You can log into your account here!
            <button class="ghost" id="sign_in_slide"> LOGIN </button>
          </div>
        </div>
      </div>

      <div id="sign_in">
        <form action="login.php" method="post" onsubmit="return validate_login()" name='existing_user'>
          <h3> Login: </h3>
          <br>
          <input type="email" name="email" placeholder="Email" required />
          <input type="password" name="password" placeholder="Password" required />
          <br>
          <span class="errorWrap">
            <p id="login_error1">error2</p>
            <p id="login_error2">error2</p>
          </span>
          <button type="submit" id="sign_in_button"> LOGIN </button>
        </form>
      </div>

    </div>
  </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <title> Profile Page </title>
  <meta charset="UTF-8">
  <meta name="description" content="Profile Page">
  <meta name="author" content="CS329E Group 13">
  <link href="./css/profilepage.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="./data/logo1.png" />
</head>

<body onload="loadImages()">
  <section id="pictureBorder">

    <header>
      <div class="banner">

        <!-- banner left -->
        <div id="bannerLeft">
          <a href="./home.html"><img id="logo" src="./data/logo1.png" width="100px" alt="SoundscapeLogo"></a>
        </div>

      </div>
    </header>

            <!-- <div id="biggerLogoWrapper">
      <img id="biggerLogo" src="./data/soundscapeTextPurple.png" alt="SoundscapeBiggerLogo" width=100%>
    </div>-->

    <section id="main">
      <!--<div id="splashWrapper">
        <img id="splash" src="./data/splash.png" alt="splash effect">
      </div>-->
      
    
      

      <div id="mainContent" class="center">
        <div id="albumReviews" class="roundedEdges">

        <div id ="review0" class="reviewContainer">
        <a href="spotifylink"><img id="0" src="./data/monthofmayhem.jpg" alt="./data/monthofmayhem.jpg" width="500px"></a>
<span>I can’t wait for the month of May! When everyone gets their vaccines, we can start partying again. This really captures the chaotic energy I’ve been feeling. Definitely check this album out.</span>
<br><br><br>
      
      <?php
 // Display all error messages in the browser
error_reporting(E_ALL);
ini_set("display_errors", 1);
 
 echo ' <form method="post" action="review0_comments.php"> ';
 $myfile = fopen("review0_comments.txt","r");
 echo '<table id="commentary">';
 $counter = 0;

 $commentary = array();
 $comment = "comment";
 $name = "name";
 
 while (!feof($myfile)){
	 $line = fgets($myfile);
	 if ($counter % 2 === 0) {
		$name = trim(strval($line));
		 echo "<tr><td class='user'> $name </td>";
	}
	 

	 else {
		if ($line[0]=="\n"){
		echo "<td> <span class='comment'> <input type='text' id=$comment size = '45' name='names[$comment]'> </span></td></tr>";
		}
		else {
			$comment =trim(strval( $line));
			echo "<td><span class='comment'> $comment</span> </td></tr>";
		}
	$commentary[$comment] = $name;
		#$name = '';
		#$info = var_dump($commentary);
		#echo "<tr><td> $info</td></tr>";
 	}
  $counter++;
 }
 echo "<tr><td class='user'>You:</td> <td> <span class='comment'> <input type='text' id='newcomment' size = '45' name='newcomment'> </span></td> </tr><tr><td colspan='2'></td></tr>";
echo "<tr><td></td><td id='rowWithButton'><input id='submit' type='submit' name = 'submit' value = 'Submit'></td></tr>";
 echo "</table>";
 fclose($myfile);

 echo "</form>";

 unset($commentary[""]); // cleaning up


 function addComment($commentary){
	 echo "<br> form has been submitted!";
	 $comments = $_POST['newcomment'];
	 echo $comments;
 	$commentary[$comments]="You";
	 //adding names to file
	 $updatedfile = fopen("review0_comments.txt","w");
	 foreach ($commentary as $comment => $name){
		$line1 = $name."\n";
		$line2 = $comment."\n";
		 fwrite($updatedfile, $line1);
		 fwrite($updatedfile, $line2);
	 }
	fclose($updatedfile);
	
 }



 if(isset($_POST['submit'])){
   addComment($commentary);
  // header("Refresh: 0");
   header("Location: review0_comments.php");
 }

?>
      </div><!--this div ends review0-->
      </div><!--this div ends albumReview-->
      </div>

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

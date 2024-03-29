<?php

    function getDB() {


    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    return new mysqli($server, $username, $password, $db);
  }

    function getPostsQuery($mysqli) {
      $command = 
      "SELECT p.id, p.post_type, p.post_datetime, u.username, u.firstname, u.lastname   
      FROM POSTS AS p 
      JOIN USERS AS u ON p.user_id = u.id
      WHERE u.id IN (
        SELECT f.following_id
        FROM FOLLOWS as f
        WHERE f.follower_id = 12)
      ORDER BY p.post_datetime DESC;";
        /*
        
        $command = 
        "SELECT POST.id, Post.TYPE as type, Post.POST_DATETIME, Users.display_name, Users.profile_pic  
        FROM POSTS AS p 
        JOIN USERS AS u ON p.USER_ID = u.id
        WHERE User.User_ID IN (
        SELECT Follows.Followee_ID
        FROM Followers
        WHERE Follows.Follower_ID = $_SESSION(USER_ID) 
        AND Follows.Accepted = TRUE)
        ORDER BY POST.POST_DATETIME DESC";
        */
        

        $result = $mysqli->query($command);
        return $result;

    }

    function getShareAlbumPost($mysqli, $post_id) {
      $command = "SELECT user.firstname, user.lastname, album.title, artist.name, post.post_datetime, album.title, album.profilepic
      FROM POSTS AS post
      JOIN SHAREALBUM_POST ON post.id = SHAREALBUM_POST.post_id
      JOIN ALBUMS AS album ON SHAREALBUM_POST.album_id = album.id
      JOIN ARTISTS AS artist ON album.artist_id = artist.id
      JOIN USERS AS user ON user.id = post.user_id
      WHERE post.id = $post_id;";

      $result = $mysqli->query($command);
      return $result;
    }

    function getReviewPost($mysqli, $post_id) {
      $command = "SELECT user.firstname, user.lastname, artist.name, album.title, post.post_datetime, review.content, album.profilepic
      FROM POSTS AS post
      JOIN REVIEW_POSTS ON post.id = REVIEW_POSTS.post_id
      JOIN REVIEWS AS review ON REVIEW_POSTS.review_id = review.id
      JOIN ALBUMS AS album ON review.album_id = album.id
      JOIN ARTISTS AS artist ON album.artist_id = artist.id
      JOIN USERS as user ON user.id = review.author_id
      WHERE post.id = $post_id;";

      $result = $mysqli->query($command);
      console_log("Butt");
      return $result;
    }

    function getFollowPost($mysqli, $post_id)


    
?>

<?php

function getDB() {
    $server = "spring-2021.cs.utexas.edu";
    $user = "cs329e_bulko_lcspear";
    $password = 'Ponder$Rhine5magnum';
    $dbName = 'cs329e_bulko_lcspear';
  
    return new mysqli ($server, $user, $password, $dbName);
  }

    function getPostsQuery($mysqli) {
      // note: make failure 
      if(isset($_COOKIE["user_id"])) {
        $user_id = $_COOKIE['user_id'];
      } else {
        $user_id = true;
      }

      $command = 
      "SELECT p.id, p.post_type, p.post_datetime, u.username, u.firstname, u.lastname   
      FROM POSTS AS p 
      JOIN USERS AS u ON p.user_id = u.id
      WHERE u.id IN (
        SELECT f.following_id
        FROM FOLLOWS as f
        WHERE f.follower_id = $user_id)
      OR u.id = $user_id
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
      $command = "SELECT post.id, user.firstname, user.lastname, artist.name, album.title, post.post_datetime, review.content, album.profilepic, review.id as review_id
      FROM POSTS AS post
      JOIN REVIEW_POSTS ON post.id = REVIEW_POSTS.post_id
      JOIN REVIEWS AS review ON REVIEW_POSTS.review_id = review.id
      JOIN ALBUMS AS album ON review.album_id = album.id
      JOIN ARTISTS AS artist ON album.artist_id = artist.id
      JOIN USERS as user ON user.id = review.author_id
      WHERE post.id = $post_id;";

      $result = $mysqli->query($command);
      return $result;
    }

    function getReviewLikes($review_id) {
      $db = getDB();
      $review_id = (int)$review_id;

      $command = "SELECT count(*) as likeCount FROM REVIEW_LIKES as likes WHERE
      likes.review_id = $review_id;";
      $result = $db->query($command);
      return $result;
    }

    function toggleReviewLike($user_id, $review_id) {
      $db = getDB();

      $command = "SELECT count(*) as likeCount FROM REVIEW_LIKES as likes WHERE
      likes.review_id = $review_id AND likes.user_id = $user_id;";
      $result = $db->query($command);
      $return = $result->fetch_assoc();
      $likeCount = $return["likeCount"];
      if($likeCount == 0) {
        $command = "INSERT INTO REVIEW_LIKES (user_id, review_id) values ($user_id, $review_id);";
        $db->query($command);
      } else {
        $command = "DELETE FROM REVIEW_LIKES where user_id = $user_id AND review_id = $review_id;";
        $db->query($command);
      }
      
      
      //, (CASE WHEN (SELECT count(*) FROM REVIEW_LIKES as likes WHERE likes.user_id = $user_id) = 0 THEN 'false' else 'true') as isLiked FROM REVIEW_LIKES"
    }
?>
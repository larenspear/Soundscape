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
        WHERE f.follower_id = '$user_id')
      OR u.id = '$user_id'
      ORDER BY p.post_datetime DESC;";

        $result = $mysqli->query($command);
        return $result;

    }

    function getProfilePostsQuery($mysqli, $username) {
      $command = 
      "SELECT p.id, p.post_type, p.post_datetime, u.username, u.firstname, u.lastname   
      FROM POSTS AS p 
      JOIN USERS AS u ON p.user_id = u.id
      WHERE u.username = '$username'
      ORDER BY p.post_datetime DESC;";

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
        return true;
      } else {
        $command = "DELETE FROM REVIEW_LIKES where user_id = $user_id AND review_id = $review_id;";
        $db->query($command);
        return false;
      }
    }
      
      function followUser($user_id, $follow_username) {
        $db = getDB();

        $user_id = (int)$user_id;
        $command = "INSERT INTO FOLLOWS (follower_id, following_id, follow_initiated) SELECT $user_id, (SELECT id FROM USERS WHERE username='$follow_username'), NOW() WHERE (SELECT count(*) FROM FOLLOWS WHERE follower_id = $user_id AND following_id = (SELECT id FROM USERS WHERE username='$follow_username')) < 1";
        $result = $db->query($command);
        //WHERE (SELECT count(*) FROM FOLLOWS WHERE follower_id = $user_id AND following_id = '$follow_username') < 1
        return $result;
      }
      
?>
<?php


function getDB() {
    console_log("getting Db");

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    return new mysqli($server, $username, $password, $db);
  }

  function getUser($mysqli, $username) {
    //$mysqli->query("START TRANSACTION;");

    $command = "SELECT id, username, USERS.password, email FROM USERS
    WHERE username = '$username' OR email = '$username';";

    $return = $mysqli->query($command)or mysqli_error($mysqli);
    return $return;
  }

  function postReview($mysqli, $author_id, $album, $artist, $link, $review) {
    // INSERT / FIND FORM ARTIST
    $return = $mysqli->query("SELECT id from ARTISTS WHERE name='$artist';") or die($mysqli->error);
    $result = $return->fetch_assoc();
    if(!$result){
            if (($mysqli->query("INSERT INTO ARTISTS (name) VALUES ('$artist');")) === TRUE) {
                console_log("Successful insertion");
            } else {
                console_log($mysqli->error);
            }
    }

    // PREPARE VARIALBES FOR ALBUM QUERY
    $return = $mysqli->query("SELECT id from ARTISTS WHERE name='$artist';");
    $result = $return->fetch_assoc();
    $artist_id = $result['id'];
    $profilepic = strtolower(str_replace(' ', '',$album)) . ".jpg";

    // INSERT / FIND FORM ALBUM
    $return = $mysqli->query("SELECT id from ALBUMS WHERE title='$album';")or die($mysqli->error);
    $result = $return->fetch_assoc();
    if(!$result){
        $mysqli->query("INSERT INTO ALBUMS (title, profilepic, artist_id) VALUES ('$album','$profilepic', $artist_id);")or die($mysqli->error);
    }

    // PREPARE VARIALBES FOR REVIEW QUERY
    $return = $mysqli->query("SELECT id from ALBUMS WHERE title='$album';") or die($mysqli->error);
    $result = $return->fetch_assoc();
    $album_id = $result['id'];

    // INSERT FORM REVIEW
    $return = $mysqli->query("INSERT INTO REVIEWS (author_id, content, album_id, published) VALUES ('$author_id', '$review', '$album_id', NOW());") or die($mysqli->error);

     // PREPARE VARIALBES FOR POST QUERY
    $mysqli->query("SET @review_id = LAST_INSERT_ID();");
    $return = $mysqli->query("SELECT @review_id as review_id") or die($mysqli->error);
    $result = $return->fetch_assoc();
    $review_id = $result['review_id'];

    console_log($review_id);
    
    $mysqli->query("INSERT INTO POSTS(post_datetime, post_type, user_id)
    VALUES ((SELECT published FROM REVIEWS WHERE id=$review_id), 'review', $author_id);") or die($mysqli->error);

     // PREPARE VARIALBES FOR REVIEW_POST QUERY
    $mysqli->query("SET @post_id = LAST_INSERT_ID();");
    $return = $mysqli->query("SELECT @post_id as post_id") or die($mysqli->error);
    $result = $return->fetch_assoc();
    $post_id = $result['post_id'];

    console_log($post_id);

    $mysqli->query("INSERT INTO REVIEW_POSTS(post_id, review_id) VALUES($post_id, $review_id);") or die($mysqli->error);
    //$mysqli->query("COMMIT;");
  }

?>

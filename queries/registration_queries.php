<?php

function getDB() {

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    return new mysqli($server, $username, $password, $db);
  }

  function getUser($mysqli, $username) {

    $command = "SELECT id, username, USERS.password, email FROM USERS
    WHERE username = '$username' OR email = '$username';";

    $return = $mysqli->query($command)or mysqli_error($mysqli);
    return $return;
  }

?>

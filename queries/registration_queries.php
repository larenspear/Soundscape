<?php


function getDB() {
    $server = "spring-2021.cs.utexas.edu";
    $user = "cs329e_bulko_lcspear";
    $password = 'Ponder$Rhine5magnum';
    $dbName = 'cs329e_bulko_lcspear';
  
    return new mysqli ($server, $user, $password, $dbName);
  }

  function getUser($mysqli, $username) {

    $command = "SELECT id, username, USERS.password, email FROM USERS
    WHERE username = '$username' OR email = '$username';";

    $return = $mysqli->query($command)or mysqli_error($mysqli);
    return $return;
  }

?>
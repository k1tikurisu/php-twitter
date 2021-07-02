<?php
  // basic auth
  @session_start();  
  if(isset($_SESSION['dirname']) && $_SESSION['dirname'] == dirname($_SERVER['SCRIPT_NAME'])) {
    $login = true;
  } else {
    $login = false;
  }
?>
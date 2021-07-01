<?php 
  if (isset($_SERVER['REMOTE_USER'])) {
    @session_start();
    $_SESSION['dirname'] = dirname($_SERVER['SCRIPT_NAME']);
    header('Location: index.php');
  } else {
    echo "ログインしてください。";
  }
?>
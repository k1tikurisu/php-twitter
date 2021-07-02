<?php
  // redirect to base_url when the POST methods runs
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Location:" . $baseUrl);
    exit;
  }
?>
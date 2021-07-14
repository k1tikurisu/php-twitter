<?php
  header("Content-Type: text/xml");
  include("config.php");
  $tweets = simplexml_load_file($xmlfile);
  echo $tweets -> asXML();
?>
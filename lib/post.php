<?php
  // create data
  if ($login && isset($_POST['tweet'])) {
    $now = date("Y-m-d H:i:s");
    $tweets = simplexml_load_file($xmlfile);
    $newid = $tweets -> count() + 1;
    $entry = $tweets -> addChild("entry");
    $entry -> addAttribute("id", $newid);
    $entry -> addChild("date", $now);
    $entry -> addChild("text", $_POST['tweet']);

    // uploading image files and registering paths
    if(is_uploaded_file($_FILES['image']['tmp_name'])) {
      $tmpfile = $_FILES['image']['tmp_name'];
      $imgfile = "./img/" . $newid . "_" . $_FILES['image']['name'];
      move_uploaded_file($tmpfile, $imgfile);
      $entry -> addChild("img", $imgfile);
    }
    file_put_contents($xmlfile, $tweets -> asXML());
  }
?>
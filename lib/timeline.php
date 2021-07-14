<?php
  if (file_exists($xmlfile)) {
    $tweets= simplexml_load_file($xmlfile);
    // sort by date
    foreach($tweets as $entry) {
      $entries[(string)$entry -> date] = $entry;
    }
    if (file_exists($flwfile)) {
      $follows = simplexml_load_file($flwfile);
      foreach($follows as $flw) {
        $url = $server . "~" .$flw['userid'] . "/" .$flw['dir'];
        $twurl = $url . "/entries.php";
        $tweets = simplexml_load_file($twurl);
        foreach($tweets as $entry) {
          if ($entry -> img != "") {
            $entry -> img = $url . "/" . $entry -> img;
          }
          $entries[(string)$entry -> date . "@" .$flw['userid']] = $entry;
        }
      }
    }
    // sort by desc
    krsort($entries);
    foreach($entries as $entry) {
      echo "<div>";
      echo "<div>" . $entry -> date . "</div>";
      echo "<div>" . $entry -> text . "</div>";
      if ($entry -> img != "") {
        echo "<img src='". $entry -> img . "'/>";
      }
      echo "</div>\n";
    }
  }
?>
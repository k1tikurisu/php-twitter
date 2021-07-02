<?php
  if (file_exists($xmlfile)) {
    $tweets= simplexml_load_file($xmlfile);
    // sort by id
    foreach($tweets as $entry) {
      $entries[(string)$entry['id']] = $entry;
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
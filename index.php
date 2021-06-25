<?php
  // set timezone
  date_default_timezone_set('Asia/Tokyo');
  
  $title = "Twitter clone with PHP5";
  $xmlfile = "tweets.xml";
  
  // create data
  if (isset($_POST['tweet'])) {
    $now = date("Y-m-d H:i:s");
    $tweets = simplexml_load_file($xmlfile);
    $newid = $tweets -> count() + 1;
    $entry = $tweets -> addChild("entry");
    $entry -> addAttribute("id", $newid);
    $entry -> addChild("date", $now);
    $entry -> addChild("text", $_POST['tweet']);
    file_put_contents($xmlfile, $tweets -> asXML());
  }

  // set base_url
  if (\filter_input(INPUT_SERVER, "SERVER_NAME") === "webdesign.center.wakayama-u.ac.jp") {
    // production
    $baseUrl = "http://webdesign.center.wakayama-u.ac.jp:60080/~s256245/mytweets/";
  } else {
    // dev
    $baseUrl = "http://localhost:4000/";
  }
  
  // redirect to base_url when the POST methods runs
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Location:" . $baseUrl);
    exit;
  }
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title><?php echo $title; ?></title>
</head>

<body>
  <h1><?php echo $title; ?></h1>
  <form action="index.php" method="POST">
    <div>
      <textarea name="tweet" placeholder="いまどうしてる？"></textarea>
    </div>
    <input type="submit">
  </form>
  <div>
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
          echo "</div>\n";
        }
      }
    ?>
  </div>
</body>

</html>
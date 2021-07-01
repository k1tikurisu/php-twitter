<?php
  // set timezone
  date_default_timezone_set('Asia/Tokyo');
  
  $title = "Twitter clone with PHP5";
  $xmlfile = "tweets.xml";  
  
  // basic auth
  @session_start();  
  if(isset($_SESSION['dirname']) && $_SESSION['dirname'] == dirname($_SERVER['SCRIPT_NAME'])) {
    $login = true;
  } else {
    $login = false;
  }
  
  // set base_url
  if (\filter_input(INPUT_SERVER, "SERVER_NAME") === "webdesign.center.wakayama-u.ac.jp") {
    // production
    $baseUrl = "http://webdesign.center.wakayama-u.ac.jp:60080/~s256245/mytweets/";
  } else {
    // dev
    $baseUrl = "http://localhost:4000/";
    // always logedin in the dev env
    $login = true;
  }

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
  <?php 
    if ($login) {
      echo <<<HTML
        <form action="index.php" method="POST" enctype="multipart/form-data">
          <div>
            <textarea name="tweet" placeholder="いまどうしてる？"></textarea>
          </div>
          <input type="file" name="image" accept="image/gif,image/jpeg,image/jpg,image/png">
          <input type="submit">
        </form>
HTML;
} else {
echo "<a href='login.php'>ログイン</a>";
}
?>

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
          if ($entry -> img != "") {
            echo "<img src='". $entry -> img . "'/>";
          }
          echo "</div>\n";
        }
      }
    ?>
  </div>
</body>

</html>
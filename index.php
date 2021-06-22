<?php
  $title = "Twitter clone with PHP5";
  $fname = "tweets.txt";
  file_put_contents($fname, !empty($_POST['tweet']) . "\n", FILE_APPEND);

  // set base_url
  if (\filter_input(INPUT_SERVER, "SERVER_NAME") === "webdesign.center.wakayama-u.ac.jp") {
    $baseUrl = "http://webdesign.center.wakayama-u.ac.jp:60080/~s256245/mytweets/";
  } else {
    $baseUrl = "http://localhost:4000/";
  }
  
  // prevent double submission
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
      if (file_exists($fname)) {
        $tweets = file_get_contents($fname);
        $tweets = explode("\n", $tweets);
        for ($i = 0;$i < count($tweets);$i++) {
          echo "<div>" . $tweets[$i] . "</div>";
        }
      }
    ?>
  </div>
</body>

</html>
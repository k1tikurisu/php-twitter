<?php
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
?>
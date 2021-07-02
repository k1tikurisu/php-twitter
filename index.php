<?php
  include("lib/config.php");
  include("lib/auth.php");
  include("lib/set_base_url.php");
  include("lib/post.php");
  include("lib/redirect.php")
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
    include("lib/form.php");
  ?>
  <div>
    <?php
      include("lib/timeline.php");
    ?>
  </div>
</body>

</html>
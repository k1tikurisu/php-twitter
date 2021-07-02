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
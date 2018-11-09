<?php
if(isset($_GET["id"])) {
  $postid = $_GET["id"];
} else {
  echo "no id";
}
$postcontent = file_get_contents("post-" . $postid . ".txt");
echo $postcontent;
?>
<?php
if(isset($_COOKIE["user"])) {
    // We are sure at this point that user is logged in, and he can send messages.
    if(isset($_GET["text"])) {
        $text = $_GET["text"];
    }
    $beforesubmit = file_get_contents("posts.html");
    $submitting = fopen("posts.html", "w");
    $ak = $_COOKIE["user"];
    $layer1= base64_decode($ak);
    $layer2= base64_decode($layer1);
    $layer3= base64_decode($layer2);
    $layer4= base64_decode($layer3);
    $layer5= base64_decode($layer4);
    $layer6= base64_decode($layer5);
    fwrite($submitting, "<center><h2>" . $layer6 . ": " . $text . "</center><br><br>" . $beforesubmit);
    echo "<meta http-equiv='refresh' content='0; url=index.html'>";
} else {
    // This will occur when user isn't logged in.
    echo "You are not logged in! You can't post messages! (If you want to, create a free account)";
}
?>
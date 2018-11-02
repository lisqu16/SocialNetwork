<?php
if(isset($_GET["login"])) {
    $login = $_GET["login"];
}
if(isset($_GET["password"])) {
    $password = $_GET["password"];
}
mkdir("users/" . $login, 0777, true);
if(file_exists("users/" . $login . "/password.txt")) {
    echo "This nick is already taken!"; // message when this user exists
} else {
    $passwordfile = fopen("users/" . $login . "/password.txt", "w");
    $hashedpassword = md5($password);
    fwrite($passwordfile, $hashedpassword);
    fclose($passwordfile);
    $profilepage = fopen("users/" . $login . "/index.html", "w");
    fwrite($profilepage, "<html>
    <head><title>Source-SocialNetwork</title><link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'><style>.header {background-color: #6da5ff;}.posttext {width: 400px;height: 100px;text-align: center;}body {font-family: 'Montserrat', sans-serif;} .postbutton {background-color: #6da5ff;border-radius: 3px; }.posts {    width: 100%;height: 55%; border-width: 0px;} </style></head><body><div class='header'> <img src='logo.png'></img></div><br><center> <p>Hi, I'm" . $login . "!</p> </center></body></html>");
    fclose($profilepage);
    // To make SN a bit secure, we need a few layers of encode.
    $layer1= base64_encode($login);
    $layer2= base64_encode($layer1);
    $layer3= base64_encode($layer2);
    $layer4= base64_encode($layer3);
    $layer5= base64_encode($layer4);
    $layer6= base64_encode($layer5);
    setcookie("user", $layer6, time() + 60*60*24*30);
    echo "<meta http-equiv='refresh' content='0; url=index.html'>";
}
?>
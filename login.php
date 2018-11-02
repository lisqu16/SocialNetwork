<?php
if(isset($_GET["login"])) {
    $login = $_GET["login"];
}
if(isset($_GET["password"])) {
    $password = $_GET["password"];
}
if(file_exists("users/" . $login . "/password.txt")) {
    // Checking, if password is correct, and logging in.
    $realpassword = file_get_contents("users/" . $login . "/password.txt");
    $writtenpassword = md5($password);
    if($realpassword === $writtenpassword) {
        $layer1= base64_encode($login);
        $layer2= base64_encode($layer1);
        $layer3= base64_encode($layer2);
        $layer4= base64_encode($layer3);
        $layer5= base64_encode($layer4);
        $layer6= base64_encode($layer5);
        setcookie("user", $layer6, time() + 60*60*24*30);
        echo "<meta http-equiv='refresh' content='0; url=index.html'>";
    } else {
        echo "Password incorrect!";
    }
} else {
    echo "This account doesn't exist!";
}
?>
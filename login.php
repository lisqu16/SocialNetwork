<?php
/*if(isset($_GET["login"])) {
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
}*/

    session_start();

    // if user type "login.php" in browser, move him to login page
    if (!(isset($_POST['login'])) || !(isset($_POST['password']))) {
        header('Location: login.html');
    }

    require_once "config.php";

    // connection with database
    $connection = @new mysqli($host, $user, $pass, $db);
    
    // if an error occurred while connecting to the database, inform user
    if ($connection->connect_errno!=0) {
        echo "Sorry, but an error ".$connection->connect_errno." occurred!";
        return;
    }

    // get info from the login form
    $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
    $password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");

    $result = @$connection->query(sprintf("SELECT * FROM users WHERE user='%s' AND pass='%s'", mysqli_real_escape_string($connection, $login), mysqli_real_escape_string($connection, $password)));
    
    // if an error occurred during the query, inform user
    if (!($result)) {
        echo "Sorry, but an error occured during the query.";
        $connection->close();
        return;
    }

    // incorrect login or password
    $rows = $result->num_rows;
    if (!($rows>0)) {
        echo "Incorrect login or password!";
        $connection->close();
        return;
    }

    // valid login and password! hurray!
    $user_info = $result->fetch_assoc();
    $_SESSION['logged'] = true;
    $_SESSION['user'] = $user_info['user'];
    $_SESSION['name'] = $user_info['name'];

    // deleting a variable from memory
    $result->free_result();

    // closing a connection
    $connection->close();

    header('Location: index.php');

?>
<?php

    session_start();

    if (isset($_POST['login'])) {
        // if variable "login" exists, so whether the user pressed the button
        $regStatus = true;

        $nickname = $_POST['login'];

        // checks if a nickname have between 5 and 20 characters
        if ((strlen($nickname)<5) || (strlen($nickname)>20)) {
            $regStatus = false;
            $_SESSION['err_nickname'] = "A nickname must have between 5 and 20 characters";
        }

        // checks if a nickname have strange characters
        if (ctype_alnum($nickname) == false) {
            $regStatus = false;
            $_SESSION['err_nickname'] = "A nickname should contain only letters and numbers";
        }

        $password1 = $_POST['password'];
        $password2 = $_POST['password2'];

        // checks if a password have at least 8 characters
        if (strlen($password1)<8) {
            $regStatus = false;
            $_SESSION['err_pass'] = "A password should contain at least 8 characters";
        }

        // chceks if the passwords are the same
        if ($password1!=$password2) {
            $regStatus = false;
            $_SESSION['err_pass'] = "The passwords are not the same";
        }

        // password hashing
        $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

        // importing a config
        require_once "config.php";

        // connection with database
        $connection = @new mysqli($host, $user, $pass, $db);

        // if an error occurred while connecting to the database, inform user
        if ($connection->connect_errno!=0) {
            echo "Sorry, but an error ".$connection->connect_errno." occurred!";
            return;
        }

        // checks if a nickname exists in the database
        $result = @$connection->query("SELECT id FROM users WHERE user='$nickname'");

        $rows = $result->num_rows;
        if ($rows>0) {
            $regStatus = false;
            $_SESSION['err_nickname'] = "Sorry, but an user with this nickname already exists";
        }

        // if an error occurred during the query, inform user
        if (!($result)) {
            echo "Sorry, but an error occured during the query.";
            $connection->close();
            return;
        }

        // if registration status eqauls to true, add an user to the databsae.
        if ($regStatus == true) {
            $name = $_POST['name'];
            $result_two = @$connection->query("INSERT INTO users VALUES (NULL, '$nickname', '$name', '$hashed_password')");
            if (!($result_two)) {
                echo "Sorry, but an error occured during the query.";
                $connection->close();
                return;
            }
            echo "The registration finished succesfully, now you can <a href=\"./log_in.php\">log in</a>.";
            return;
        }

        // closing a connection
        $connection->close();

    }
?>

<html>
    <head>
        <title>Source-SocialNetwork</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <style>
            .header {
                background-color: #6da5ff;
            }
            .loginbox {
                width: 10%;
            }
            body {
                font-family: 'Montserrat', sans-serif;
            }
            .postbutton {
                background-color: #6da5ff;
                border-radius: 3px;
            }
            .posts {
                width: 100%;
                height: 55%;
                border-width: 0px;
            }
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <img src="logo.png"></img>
        </div>
        <br>
        <center>
            <form method="POST">
                <input type="text" class="loginbox" name="login" placeholder="Login" autocorrect=off><br><br>
                <?php
                    if (isset($_SESSION['err_nickname']))
                    {
                        echo '<div class="error">'.$_SESSION['err_nickname'].'</div>';
                        unset($_SESSION['err_nickname']);
                    }
                ?>
                <input type="text" class="loginbox" name="name" placeholder="Name" autocorrect=off required><br><br>
                <input type="password" class="loginbox" name="password" placeholder="Password" autocorrect=off><br><br>
                <input type="password" class="loginbox" name="password2" placeholder="Repeat password" autocorrect=off><br><br>
                <?php
                    if (isset($_SESSION['err_pass']))
                    {
                        echo '<div class="error">'.$_SESSION['err_pass'].'</div>';
                        unset($_SESSION['err_pass']);
                    }
                ?>
                <input type="submit" value="Register" class="postbutton"><br>
            </form>
        </center>
    </body>
</html>
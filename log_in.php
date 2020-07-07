<?php

    session_start();

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
            <form action="login.php" method="POST">
                <input type="text" class="loginbox" name="login" placeholder="Login" autocorrect=off><br><br>
                <input type="password" class="loginbox" name="password" placeholder="Password" autocorrect=off><br>
                <?php
                    if (isset($_SESSION['error'])) {
                        echo "<div class=\"error\">".$_SESSION['error']."</div>";
                    }
                ?>
                <br><br>
                <input type="submit" value="Log in" class="postbutton"><br>
            </form>
            <a href="register.html">Don't have an account? Create one here.</a>
        </center>
    </body>
</html>
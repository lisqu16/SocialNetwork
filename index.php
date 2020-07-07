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
            .posttext {
                width: 400px;
                height: 100px;
                text-align: center;
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
        </style>
    </head>
    <body>
        <div class="header">
            <img src="logo.png"></img>
        </div>
        <br>
        <center>
            <?php
                if (!(isset($_SESSION['name']))) {
                    echo "<p>Hi Guest!<p> <br /> <a href=\"./log_in.php\">Login here!</a>";
                } else {
                    echo "<p>Hi ".$_SESSION['name']."!</p> <br /> <a href=\"log_out.php\">Log out</a>";
                }
            ?>
            <hr>
            <form action="post.php" method="GET">
                <input type="text" class="posttext" name="text" placeholder="What's on your mind?" autocorrect=off><br><br>
                <input type="submit" value="Post" class="postbutton"><br>
            </form>
            <hr><br>
            <p>Newest posts:</p>
            <br>
            <iframe src="posts.html" class="posts"></iframe>
        </center>
    </body>
</html>
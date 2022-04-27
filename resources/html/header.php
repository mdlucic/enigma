<?php
#Global variables

session_start();
$docroot = $_SERVER['DOCUMENT_ROOT'] . "/enigma";
$s_username = $_SESSION['username'];
require("$docroot/config/database.php");
require("$docroot/public/view/includes/user_error.php");

$sql = "SELECT username FROM user_profile where username=:username";
$stmt = new DBConn;

$db = $stmt->connect()->prepare($sql);
$db->bindParam(':username', $s_username);
$db->execute();
$row = $db->fetch(PDO::FETCH_ASSOC);



?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/enigma/resources/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="/enigma/resources/images/logo.png">

</head>


<header>
    <div class="menu_border">
        <div class="menu_align">
            <a style="margin-left:5%" href="/enigma/public/view/homepage.php">
                <img class="rotate_logo" src="/enigma/resources/images/logo.png" alt="logo" width="70" height="70">
            </a>

                <?php


                if (!$s_username || $s_username == "") {
                    require("../../public/view/includes/user_error.php");
                ?>
                    <form style="display:inline-block;" action="/enigma/src/model/login_verification.php" method="POST">
                        <input type="text" name="username" placeholder="Username or Email">
                        <br>
                        <input type="password" name="password" placeholder="Password">
                        <br>
                        <input style="display:inline-block" class="black_button" type="submit" value="Log in">
                        <a class="black_button" href="/enigma/public/view/register.php">Register</a>


                    </form>
                <?php

                }
                if (isset($s_username)) {
                    echo " <div class='user_search'>  <span >Good day, <a href='/enigma/public/user_profiles/" . $s_username . ".php'>" . $s_username . "</a></span><br>";
                    echo "<a   href='/enigma/src/model/logout.php'>Logout</a>";


                    ?>
                    </div>
                    <?php

                }
$stmt=null;
                ?>
            </div>
    </div>
</header>

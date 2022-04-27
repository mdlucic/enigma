<?php
#Global variables

session_start();
$docroot = $_SERVER['DOCUMENT_ROOT'] . "/enigma";
$s_username = $_SESSION['username'];
require("$docroot/config/database.php");

$sql_id = "SELECT id FROM user_profile where username=:username";
$stmt_id = new DBConn;

$db_id = $stmt_id->connect()->prepare($sql_id);
$db_id->bindParam(':username', $s_username);
$db_id->execute();
$row_id = $db_id->fetchAll(PDO::FETCH_ASSOC);

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
            <a style="margin-left:5%" href="/enigma/">
                <img src="/enigma/resources/images/logo.png" alt="logo" width="75" height="75">
            </a>

            <div style="margin-left:50%">
                <?php


                if (!$s_username || $s_username == "") {

                ?>
                    <form style="display:inline-block;" action="../../src/model/login_verification.php" method="POST">
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
                    echo "<span style='float:right; position:absolute; right:3em;'>Good day, <a href='/enigma/public/user_profiles/" . $s_username  . ".php'>" . $s_username . "</a></span><br>";
                    echo "<a style='float:right; position:absolute; right:3em;  href='/enigma/src/model/logout.php'>Logout</a>";
                }
                ?>
            </div>
        </div>
    </div>
</header>

<?php

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!--If user tries to enter the page without loging in send them back. -->

    <?php if (!$s_username || $s_username == "") { ?>
        <h2>You are not autorized to view this page</h2>
        <p>Click <a href="index.php">here</a> to go back and login!</p>
        </div>
    <?php } ?>



</head>

<body>
    <?php

    ## If Login Statement

    if (isset($s_username)) {
        // If statement for picking a friend through chat

        $sql = "SELECT friend_one, friend_two FROM friendships WHERE friend_one<>:friend_one OR friend_two<>:friend_two";

        $stmt = new DBConn;

        $db = $stmt->connect()->prepare($sql);
        $db->bindParam(':friend_one', $s_username);
        $db->bindParam(':friend_two', $s_username);
        $db->execute();
        $row_f = $db->fetchAll(PDO::FETCH_ASSOC);
    ?>

        <div id="index_chat">

            <h2 class="chat_friend_title"><?php echo $_POST['chat_friend']; ?></h2>
            <?php

            if (isset($_POST['chat_friend'])) {
                //Display Messages

                $sql = "SELECT * FROM messages WHERE (users_username=:from_one && send_to=:from_two) OR (users_username=:from_two && send_to=:from_one)";

                $stmt = new DBConn;
                $db = $stmt->connect()->prepare($sql);
                $db->bindparam(":from_one", $s_username);
                $db->bindparam(":from_two", $_POST['chat_friend']);
                $db->execute();
                $row_m = $db->fetchAll(PDO::FETCH_ASSOC);


                foreach ($row_m as $msgs) {
                    if ($msgs['users_username'] == $s_username) {
                        echo "<p class='user_message'>" . $msgs['msg'] . "</p>";
                    }

                    if ($msgs['send_to'] == $s_username) {
                        echo "<p class='friend_message'>" . $msgs['msg'] . "</p>";
                    }
                }
            }


            ?>
        </div>
<div id="index_messages_box">
        <form action="../../src/model/message_validation.php" method="POST">
            <input class="index_text_message" type="text" name="message" placeholder="Message">
            <input type="hidden" name="send_to" value="<?php echo $_POST['chat_friend'] ?>">
            <input class="index_text_message_submit" type="submit" value="Send">
        </form>
</div>
    <div id="index_friend_list">
            <?php

            foreach ($row_f as $friend) {
                if ($friend['friend_one'] == $s_username) {
            ?>

                    <form method="POST">
                        <input class="index_friend" type="submit" name="chat_friend" value="<?php echo $friend['friend_two'] ?>">
                    </form>
                <?php
                }

                if ($friend['friend_two'] == $s_username) {
                ?>
                    <form method="POST">
                        <input class="index_friend" type="submit" name="chat_friend" value="<?php echo $friend['friend_one'] ?>">
                    </form>
            <?php

                }
            }
            ?>
        </div>

        <?php
        require("../../config/database.php");
        $sql = "SELECT * FROM messages WHERE users_username = :users_username";
        $stmt = new DBConn;

        $db = $stmt->connect()->prepare($sql);
        $db->bindParam(':users_username', $s_username);
        $db->execute();
        $row = $db->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $msg) {
        ?>
            <p><?php echo $msg['msg'] ?></p>
        <?php
        }
        ?>
</body>

</html>
<?php

        ## Closing if login statement
    }
?>
</body>

</html>

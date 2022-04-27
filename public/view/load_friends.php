<?php

if (isset($_POST['chat_friend'])) {
    //Display Messages

    $sql = "SELECT * FROM messages WHERE (users_username=:from_one && send_to=:from_two) OR (users_username=:from_two && send_to=:from_one)";

    $stmt = new DBConn;
    $db = $stmt->connect()->prepare($sql);
    $db->bindparam(":from_one", $_SESSION['username']);
    $db->bindparam(":from_two", $_POST['chat_friend']);
    $db->execute();
    $row_m = $db->fetchAll(PDO::FETCH_ASSOC);


    foreach ($row_m as $msgs) {
        if ($msgs['users_username'] == $_SESSION['username']) {
            echo "<p>" . $msgs['users_username'] . ": " . $msgs['msg'] . "</p>";
        }

        if ($msgs['send_to'] == $_SESSION['username']) {
            echo "<p>" . $msgs['users_username'] . ": " . $msgs['msg'] . "</p>";
        }
    }
}

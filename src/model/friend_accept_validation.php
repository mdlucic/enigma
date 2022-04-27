<?php
#Insert friend request into table
include_once('../../config/database.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require("../classes/Friend_Accept.php");
    $friend_two = $_SESSION['username'];
    $friend_one = $_POST['accept'];

    $friend_request = new Friend_Accept;
    $friend_request->setFriendOne($friend_one);
    $friend_request->setFriendTwo($friend_two);

    if (isset($_POST['accept']) || $_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($friend_request->insertFriendshipAccept()) {
            $sql = "DELETE FROM friendship_requests WHERE friend_one=:friend_one AND friend_two=:friend_two";
            $stmt = new DBConn;
            $db = $stmt->connect()->prepare($sql);
            $db->bindParam(':friend_one', $friend_one);
            $db->bindParam(':friend_two', $friend_two);

            $db->execute();
            $db = null;

            header("Location: ../../public/view/homepage.php?friend_added");
            exit();
        } else {
            header("Location: ../../public/view/homepage.php?request_not_sent");
            exit();
        }
    } else {
        echo "error";
        exit();
    }
}

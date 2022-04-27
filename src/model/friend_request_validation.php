<?php
#Insert friend request into table

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require("../classes/Friend_Request.php");
    $friend_one = $_SESSION['username'];
    $friend_two = $_POST['friend_request'];
    $request_status = "Requested";

    $friend_request = new Friend_Request;
    $friend_request->setFriendOne($friend_one);
    $friend_request->setFriendTwo($friend_two);
    $friend_request->setRequestStatus($request_status);

    if (isset($_POST['friend_request'])) {
        if ($friend_request->insertFriendshipRequest()) {
            header("Location: ../../public/view/homepage.php");
            exit();
        } else {
            echo "Friend request could not be sent";
        }
    } else {
        header("Location: ../../public/view/homepage.php");
        exit();
    }
}

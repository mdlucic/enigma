<?php
# Insert user data into db
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    require("../classes/Message.php");
    $msg = $_POST['message'];
    $users_username = $_SESSION['username'];
    $send_to = $_POST['send_to'];

    $message = new Message;
    $message->setMsg($msg);
    $message->setUsersUsername($users_username);
    $message->setSendTo($send_to);
    if (isset($msg) && $msg != "") {
        if ($message->insertMessage()) {
            header("Location: ../../public/view/chat.php");
            exit();
        } else {
            echo "Message could not be sent";
        }
    } else {
        header("Location: ../../public/view/chat.php");
        exit();
    }
}

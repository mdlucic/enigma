<?php
class Message
{
    /*
        *
        *
        *
        *
        *
        *
        *
        * */

    private $id;
    private $msg;
    private $users_username;
    private $send_to;
    private $connection;

    public function __construct()
    {
        require("../../config/database.php");
        $database = new DBConn;
        $this->connection = $database->connect();
    }

    //Setter methods for @id, @msg, $users_username
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    public function setUsersUsername($users_username)
    {
        $this->users_username = $users_username;
    }

    public function setSendTo($send_to)
    {
        $this->send_to = $send_to;
    }

    //Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getMsg(): string
    {
        return $this->msg;
    }

    public function getSendTo(): string
    {
        return $this->send_to;
    }

    public function getUsersUsername(): string
    {
        return $this->users_username;
    }

    //Insert user data into message table
    public function insertMessage(): bool
    {

        $sql = "INSERT INTO messages (msg, users_username, send_to) VALUES (:msg, :users_username, :send_to)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':msg', $this->msg);
        $stmt->bindParam(':users_username', $this->users_username);
        $stmt->bindParam(':send_to', $this->send_to);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

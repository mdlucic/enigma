<?php

class Friend_Accept
{
    private $id;
    private $friend_one;
    private $friend_two;

    public function __construct()
    {
        include_once("../../config/database.php");
        $database = new DBConn;
        $this->connection = $database->connect();
    }

    //Setters

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setFriendOne($friend_one)
    {
        $this->friend_one = $friend_one;
    }

    public function setFriendTwo($friend_two)
    {
        $this->friend_two = $friend_two;
    }


    //Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getFriendOne(): string
    {
        return $this->friend_one;
    }

    public function getFriendTwo(): string
    {
        return $this->friend_two;
    }


    // Insert Request into friendship_requests table

    public function insertFriendshipAccept(): bool
    {
        $sql = "INSERT INTO friendships (friend_one, friend_two) VALUES (:friend_one, :friend_two)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':friend_one', $this->friend_one);
        $stmt->bindParam(':friend_two', $this->friend_two);





        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

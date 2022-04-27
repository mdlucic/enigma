<?php

class Friend_Request
{
    private $id;
    private $friend_one;
    private $friend_two;
    private $request_status;

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

    public function setRequestStatus($request_status)
    {
        $this->request_status = $request_status;
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

    public function getRequestStatus(): string
    {
        return $this->request_status;
    }

    // Insert Request into friendship_requests table

    public function insertFriendshipRequest(): bool
    {
        $sql = "INSERT INTO friendship_requests (friend_one, friend_two, request_status) VALUES (:friend_one, :friend_two, :request_status)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':friend_one', $this->friend_one);
        $stmt->bindParam(':friend_two', $this->friend_two);
        $stmt->bindParam(':request_status', $this->request_status);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

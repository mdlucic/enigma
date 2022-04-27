<?php

use PHPUnit\Framework\MockObject\Builder\Identity;

class Chat
{


    public $id;
    public $from_one;
    public $from_two;
    public $msg;
    public $time;

    public function __construct()
    {
        require("../../config/database.php");
        $database = new DBConn;
        $this->connection = $database->connect();
    }

    //Setter methods
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setFromOne(string $from_one)
    {
        $this->from_one = $from_one;
    }

    public function setFromTwo(string $from_two)
    {
        $this->from_two = $from_two;
    }

    public function setMsg(string $msg)
    {
        $this->msg = $msg;
    }

    public function setTime(string $time)
    {
        $this->time = $time;
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getFromOne(): string
    {
        return $this->from_one;
    }

    public function getFromTwo(): string
    {
        return $this->from_two;
    }

    public function getMsg(): string
    {
        return $this->msg;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function extractMessages(): bool
    {
        $sql = "SELECT * FROM messages WHERE users_username=:from_one && send_to=:from_two || users_username=:from_two && send_to=:from_one";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindparam(":from_one", $this->from_one);
        $stmt->bindparam(":from_two", $this->from_two);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

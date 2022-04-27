<?php
class Todo
{

	/**
	 *
	 *@id = to_do id
	 *@todo = to_do messages
	 *@todo_user = username associated with @todo from different table
	 *@connection = for connecting to the db
	 *
	 */

	private $id;
	private $todo_task;
	private $todo_user;
	private $connection;

	public function __construct()
	{
		require("../../config/database.php");
		$database = new DBConn;
		$this->connection = $database->connect();
	}

	//Setter methods for @id, @todo, $todo_user
	public function setId(int $id)
	{
		$this->id = $id;
	}
	public function setTodoTask($todo_task)
	{
		$this->todo_task = $todo_task;
	}
	public function setTodoUser($todo_user)
	{
		$this->todo_user = $todo_user;
	}


	//Getters
	public function getId(): int
	{
		return $this->id;
	}
	public function getTodoTask(): string
	{
		return $this->todo_task;
	}
	public function getUsersUsername(): string
	{
		return $this->todo_user;
	}

	//Insert user data into to_do table
	public function insertTodo(): bool
	{
		$sql = "INSERT INTO todo_list (todo_task, todo_user) VALUES (:todo_task, :todo_user)";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':todo_task', $this->todo_task);
		$stmt->bindParam(':todo_user', $this->todo_user);

		if ($stmt->execute()) {
			return true;
		}
		return false;
	}
}

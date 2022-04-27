<?php

//insert user data into db
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();
	require("../classes/Todo.php");

	$todo_task = $_POST['todo_task'];
	$username = $_SESSION['username'];

	$todo = new Todo;
	$todo->setTodoTask($todo_task);
	$todo->setTodoUser($username);

	if (isset($todo_task) && $todo_task != "") {
		if ($todo->insertTodo()) {
			header("Location: ../../public/view/todo_list.php?inserted");
			exit();
		} else {
			echo "Not good";
		}
	} else {
		header("Location: ../../public/view/homepage.php");
		exit();
	}
}

<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

	if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['assigned_to']) && $_SESSION['role'] == 'admin' && isset($_POST['due_date'])) {
		include "../DB_connection.php";

		function validate_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		$title = validate_input($_POST['title']);
		$description = validate_input($_POST['description']);
		$assigned_to = validate_input($_POST['assigned_to']);
		$due_date = validate_input($_POST['due_date']);

		if (empty($title)) {
			$em = "Требуется заголовок";
			header("Location: ../create_task.php?error=$em");
			exit();
		} else if (empty($description)) {
			$em = "Требуется описание";
			header("Location: ../create_task.php?error=$em");
			exit();
		} else if ($assigned_to == 0) {
			$em = "Требуется выбрать работника";
			header("Location: ../create_task.php?error=$em");
			exit();
		} else {

			include "Model/Task.php";

			$data = array($title, $description, $assigned_to, $due_date);
			insert_task($conn, $data);

			$em = "Задача успешно создана";
			header("Location: ../create_task.php?success=$em");
			exit();

		}
	} else {
		$em = "Данные из формы не поступили 1";
		header("Location: ../create_task.php?error=$em");
		exit();
	}

} else {
	$em = "Требуется вход";
	header("Location: ../create_task.php?error=$em");
	exit();
}
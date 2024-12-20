<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

	if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['full_name']) && $_SESSION['role'] == 'admin') {
		include "../DB_connection.php";

		function validate_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		$user_name = validate_input($_POST['user_name']);
		$password = validate_input($_POST['password']);
		$full_name = validate_input($_POST['full_name']);
		$id = validate_input($_POST['id']);


		if (empty($user_name)) {
			$em = "Требуется логин";
			header("Location: ../edit-user.php?error=$em&id=$id");
			exit();
		} else if (empty($password)) {
			$em = "Требуется пароль";
			header("Location: ../edit-user.php?error=$em&id=$id");
			exit();
		} else if (empty($full_name)) {
			$em = "Требуется полное имя";
			header("Location: ../edit-user.php?error=$em&id=$id");
			exit();
		} else {

			include "Model/User.php";
			$password = password_hash($password, PASSWORD_DEFAULT);

			$data = array($full_name, $user_name, $password, "employee", $id, "employee");
			update_user($conn, $data);

			$em = "Данные обновлены успешно";
			header("Location: ../edit-user.php?success=$em&id=$id");
			exit();


		}
	} else {
		$em = "Через форму не поступил логин, пароль или полное имя";
		header("Location: ../edit-user.php?error=$em");
		exit();
	}

} else {
	$em = "Требуется вход";
	header("Location: ../edit-user.php?error=$em");
	exit();
}
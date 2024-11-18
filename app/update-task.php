<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

    if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['assigned_to']) && $_SESSION['role'] == 'admin' && isset($_POST['due_date'])) {
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
        $id = validate_input($_POST['id']);
        $due_date = validate_input($_POST['due_date']);

        if (empty($title)) {
            $em = "Требуется заголовок";
            header("Location: ../edit-task.php?error=$em&id=$id");
            exit();
        } else if (empty($description)) {
            $em = "Требуется описание";
            header("Location: ../edit-task.php?error=$em&id=$id");
            exit();
        } else if ($assigned_to == 0) {
            $em = "Требуется выбрать работника";
            header("Location: ../edit-task.php?error=$em&id=$id");
            exit();
        } else {

            include "Model/Task.php";

            $data = array($title, $description, $assigned_to, $due_date, $id);
            update_task($conn, $data);

            $em = "Задача успешно обновлена";
            header("Location: ../edit-task.php?success=$em&id=$id");
            exit();

        }
    } else {
        $em = "Данные из формы не поступили";
        header("Location: ../edit-task.php?error=$em");
        exit();
    }

} else {
    $em = "Требуется вход";
    header("Location: ../login.php?error=$em");
    exit();
}
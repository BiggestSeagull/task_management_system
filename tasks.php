<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "app/Model/Task.php";
    include "app/Model/User.php";
    include "DB_connection.php";

    // $text = "Все задачи";
    // if (isset($_GET['due_date']) && $_GET['due_date'] == "Due Today") {
    //     $text = "Сегодня";
    //     $tasks = get_all_tasks_due_today($conn);
    //     $num_task = count_tasks_due_today($conn);

    // } else if (isset($_GET['due_date']) && $_GET['due_date'] == "Overdue") {
    //     $text = "Просрочено";
    //     $tasks = get_all_tasks_overdue($conn);
    //     $num_task = count_tasks_overdue($conn);

    // } else if (isset($_GET['due_date']) && $_GET['due_date'] == "No Deadline") {
    //     $text = "Без срока";
    //     $tasks = get_all_tasks_NoDeadline($conn);
    //     $num_task = count_tasks_NoDeadline($conn);

    // } else {
    //     $tasks = get_all_tasks($conn);
    //     $num_task = count_tasks($conn);
    // }

    // My code block
    $due_date = $_GET['due_date'] ?? null;

    switch ($due_date) {
        case "Due Today":
            $text = "Сегодня";
            $tasks = get_all_tasks_due_today($conn);
            $num_task = count_tasks_due_today($conn);
            break;

        case "Overdue":
            $text = "Просрочено";
            $tasks = get_all_tasks_overdue($conn);
            $num_task = count_tasks_overdue($conn);
            break;

        case "No Deadline":
            $text = "Без срока";
            $tasks = get_all_tasks_NoDeadline($conn);
            $num_task = count_tasks_NoDeadline($conn);
            break;

        default:
            $text = "Все задачи";
            $tasks = get_all_tasks($conn);
            $num_task = count_tasks($conn);
            break;
    }
    // End of my code


    $users = get_all_users($conn);

    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset=utf-8>

        <title>Все задачи</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body>
        <input type="checkbox" id="checkbox">

        <?php include "inc/header.php" ?>

        <div class="body">
            <?php include "inc/nav.php" ?>

            <section class="section-1">
                <h4 class="title-2">

                    <a href="create_task.php" class="btn">Создать</a>
                    <a href="tasks.php?due_date=Due Today">Сегодня</a>
                    <a href="tasks.php?due_date=Overdue">Просрочено</a>
                    <a href="tasks.php?due_date=No Deadline">Без срока</a>
                    <a href="tasks.php">Все задачи</a>

                </h4>

                <h4 class="title-2"><?= $text ?> (<?= $num_task ?>)

                    <?php if (isset($_GET['success'])) { ?>
                        <div class="success" role="alert">
                            <?php echo stripcslashes($_GET['success']); ?>
                        </div>
                    <?php } ?>

                    <?php if ($tasks != 0) { ?>
                        <table class="main-table">
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Назначено</th>
                                <th>Срок выполнения</th>
                                <th>Статус</th>
                                <th>Действие</th>
                            </tr>
                            <?php $i = 0;
                            foreach ($tasks as $task) { ?>
                                <tr>
                                    <td><?= ++$i ?></td>
                                    <td><?= $task['title'] ?></td>
                                    <td><?= $task['description'] ?></td>
                                    <td>
                                        <?php
                                        foreach ($users as $user) {
                                            if ($user['id'] == $task['assigned_to']) {
                                                echo $user['full_name'];
                                            }
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($task['due_date'] == "")
                                            echo "Нет срока";
                                        else
                                            echo $task['due_date']; ?>
                                    </td>
                                    <td><?= $task['status'] ?></td>
                                    <td>
                                        <a href="edit-task.php?id=<?= $task['id'] ?>" class="edit-btn">Редактировать</a>
                                        <a href="delete-task.php?id=<?= $task['id'] ?>" class="delete-btn">Удалить</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php } else { ?>
                        <h3>Пусто</h3>
                    <?php } ?>
            </section>
        </div>

        <script type="text/javascript">
            var active = document.querySelector("#navList li:nth-child(4)");
            active.classList.add("active");
        </script>
    </body>

    </html>

<?php } else {
    $em = "Требуется вход";
    header("Location: login.php?error=$em");
    exit();
}
?>
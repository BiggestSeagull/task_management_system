<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "app/Model/Task.php";
    include "app/Model/User.php";
    include "DB_connection.php";
    $tasks = get_all_tasks($conn);
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
                <h4 class="title">Все задачи <a href="create_task.php">Создать</a></h4>

                <?php if ($tasks != 0) { ?>
                    <table class="main-table">
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Назначено</th>
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
                                    <?= $task['status'] ?>
                                </td>
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
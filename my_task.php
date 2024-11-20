<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    include "DB_connection.php";
    include "app/Model/Task.php";
    include "app/Model/User.php";

    $tasks = get_all_tasks_by_id($conn, $_SESSION['id']);

    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Мои задачи</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body>
        <input type="checkbox" id="checkbox">
        <?php include "inc/header.php" ?>
        <div class="body">
            <?php include "inc/nav.php" ?>
            <section class="section-1">
                <h4 class="title">Мои задачи</h4>
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
                            <th>Статус</th>
                            <th>Срок выполнения</th>
                            <th>Действие</th>
                        </tr>
                        <?php $i = 0;
                        foreach ($tasks as $task) { ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= $task['title'] ?></td>
                                <td><?= $task['description'] ?></td>
                                <td><?= $task['status'] ?></td>
                                <td><?= $task['due_date'] ?></td>

                                <td>
                                    <a href="edit-task-employee.php?id=<?= $task['id'] ?>" class="edit-btn">Изменить</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } else { ?>
                    <h3>Нет задач</h3>
                <?php } ?>

            </section>
        </div>

        <script type="text/javascript">
            var active = document.querySelector("#navList li:nth-child(2)");
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
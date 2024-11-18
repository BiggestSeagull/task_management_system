<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    include "app/Model/User.php";
    include "DB_connection.php";
    $users = get_all_users($conn);
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset=utf-8>

        <title>Работники</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body>
        <input type="checkbox" id="checkbox">

        <?php include "inc/header.php" ?>

        <div class="body">
            <?php include "inc/nav.php" ?>

            <section class="section-1">
                <h4 class="title">Управление работниками <a href="add-user.php">Добавить</a></h4>

                <?php if ($users != 0) { ?>
                    <table class="main-table">
                        <tr>
                            <th>#</th>
                            <th>Полное имя</th>
                            <th>Логин</th>
                            <th>Роль</th>
                            <th>Действие</th>
                        </tr>
                        <?php $i = 0;
                        foreach ($users as $user) { ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><?= $user['full_name'] ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['role'] ?></td>
                                <td>
                                    <a href="edit-user.php?id=<?= $user['id'] ?>" class="edit-btn">Редактировать</a>
                                    <a href="delete-user.php?id=<?= $user['id'] ?>" class="delete-btn">Удалить</a>

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
            var active = document.querySelector("#navList li:nth-child(2)");
            active.classList.add("active");
        </script>
    </body>

    </html>

<?php } else {
    $em = "Сначала войдите в аккаунт";
    header("Location: login.php?error=$em");
    exit();
}
?>
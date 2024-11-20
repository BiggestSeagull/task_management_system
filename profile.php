<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
    include "DB_connection.php";
    include "app/Model/User.php";
    $user = get_user_by_id($conn, $_SESSION['id']);

    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Профиль</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body>
        <input type="checkbox" id="checkbox">
        <?php include "inc/header.php" ?>
        <div class="body">
            <?php include "inc/nav.php" ?>
            <section class="section-1">
                <h4 class="title">Профиль <a href="edit_profile.php">Редактировать профиль</a></h4>
                <table class="main-table" style="max-width: 300px;">
                    <tr>
                        <td>Полное имя</td>
                        <td><?= $user['full_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Логин</td>
                        <td><?= $user['username'] ?></td>
                    </tr>
                    <tr>
                        <td>Присоединился</td>
                        <td><?= $user['created_at'] ?></td>
                    </tr>
                </table>

            </section>
        </div>

        <script type="text/javascript">
            var active = document.querySelector("#navList li:nth-child(3)");
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
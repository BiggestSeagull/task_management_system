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
        <title>Изменение профиля</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body>
        <input type="checkbox" id="checkbox">
        <?php include "inc/header.php" ?>
        <div class="body">
            <?php include "inc/nav.php" ?>
            <section class="section-1">
                <h4 class="title">Изменение профиля <a href="profile.php">Вернуться</a></h4>
                <form class="form-1" method="POST" action="app/update-profile.php">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="danger" role="alert">
                            <?php echo stripcslashes($_GET['error']); ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <div class="success" role="alert">
                            <?php echo stripcslashes($_GET['success']); ?>
                        </div>
                    <?php } ?>
                    <div class="input-holder">
                        <lable>Полное имя</lable>
                        <input type="text" name="full_name" class="input-1" placeholder="Полное имя"
                            value="<?= $user['full_name'] ?>"><br>
                    </div>

                    <div class="input-holder">
                        <lable>Старый пароль</lable>
                        <input type="text" value="**********" name="password" class="input-1"
                            placeholder="Старый пароль"><br>
                    </div>
                    <div class="input-holder">
                        <lable>Новый пароль</lable>
                        <input type="text" name="new_password" class="input-1" placeholder="Новый пароль"><br>
                    </div>
                    <div class="input-holder">
                        <lable>Подтвердить пароль</lable>
                        <input type="text" name="confirm_password" class="input-1" placeholder="Подтвердить пароль"><br>
                    </div>

                    <button class="edit-btn">Применить</button>
                </form>

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
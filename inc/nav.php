<nav class="side-bar">
    <div class="user-p">
        <img src="img/user.jpg">
        <h4><?=$_SESSION['username']?></h4>
    </div>

    <?php
    if ($_SESSION['role'] == "employee") {
        ?>

        <!-- Employee nav bar-->
        <ul>
            <li>
                <a href="#">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    <span>Панель управления</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span>Мои задачи</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>Профиль</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <span>Уведомления</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <span>Выйти</span>
                </a>
            </li>
        </ul>

        <?php
    } else {
        ?>

        <!-- Admin nav bar-->
        <ul id="navList">
            <li>
                <a href="#">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    <span>Панель управления</span>
                </a>
            </li>
            <li class="active">
                <a href="user.php">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Управление работниками</span>
                </a>
            </li>
            <li>
                <a href="create_task.php">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span>Создать задачу</span>
                </a>
            </li>
            <li>
                <a href="tasks.php">
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span>Все задачи</span>
                </a>
            </li>
            <li>
                <a href="notifications.php">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <span>Уведомления</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <span>Выйти</span>
                </a>
            </li>
        </ul>

        <?php
    }
    ?>

</nav>
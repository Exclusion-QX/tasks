<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Главная</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <link href="/template/css/bootstrap.min.css" rel="stylesheet">

    <link href="/template/css/mdb.min.css" rel="stylesheet">

    <link href="/template/css/style.css" rel="stylesheet">

    <script type="text/javascript" src="/template/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
</head>

<header>
    <!-- Шапка сайта -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light scrolling-navbar header-color">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mr-auto ml-auto">
                    <li class="nav-item">
                        <a href="/" class="nav-link waves-effect white-text">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a href="/task/create" class="nav-link waves-effect white-text">Создать задачу</a>
                    </li>
                </ul>

                <!-- Кнопки регистрации и авторизации-->

                <ul class="navbar-nav mr-0">

                    <?php if (User::isGuest()): ?>

                        <li class="nav-item">
                            <a href="/user/login" class="nav-link waves-effect white-text">Вход</a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/register" class="nav-link waves-effect white-text">Регистрация</a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link waves-effect white-text"><?php echo(User::getUserById($_SESSION['user'])['username']); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/logout" class="nav-link waves-effect white-text"> Выход</a>
                        </li>

                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
</header>


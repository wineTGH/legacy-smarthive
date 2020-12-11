<?php

    define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');

    include ROOT.'/libs/db.php';

    $user = $_SESSION['logged_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php if(isset($_SESSION['logged_user'])): ?>

        <title>Панель управления</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    </head>

    <body>

        <?php echo 'Добро пожаловать, '.$user -> login.'! '; ?> <a href="/auth/logout.php">Выйти</a> <br>

        <div class="container">
            <canvas id="myChart" width="1280px" height="400px"></canvas>
        </div>

        <script src="js/chart.js"></script>

        <br>
        <button onclick="getData()">Обновить</button>
        <p id="ajax_data"></p><br>
    
    </body>
</html>

    <?php else:?> <!-- Если пользователь не зарегестрирован, то показываем форму входа-->
        <title>Добро пожаловать!</title>
    </head>
    <body>
        <a href="auth/login.php">Вход</a><br>
        <a href="auth/reg.php">Регистрация</a>
    </body>

</html>
<?php endif;?>
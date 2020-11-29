<?php

    include 'php/db.php';

    $user = $_SESSION['logged_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php if(isset($_SESSION['logged_user'])): ?>
        <title>Панель управления</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
        <script src="js/chart.js"></script>
    </head>
    <body>
        <? echo 'Добро пожаловать, '.$user -> login.'! '; ?> <a href="/php/logout.php">Выйти</a> <br>

        <canvas id="chart" width="600" height="400"></canvas><br>
        <button onclick="getData()">Обновить</button>
        <p id="ajax_data"></p><br>
    
    </body>
</html>

    <?php else:?>
    <title>Добро пожаловать!</title>
    </head>
    <body>
    <a href="php/login.php">Вход</a><br>
    <a href="php/reg.php">Регистрация</a>
</body>
</html>
<?php endif;?>
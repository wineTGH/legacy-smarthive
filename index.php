<?php

    define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');

    include ROOT.'/libs/db.php';

    $user = $_SESSION['logged_user'];
    $hive_count = (int)$user["hivecount"];
    $data = $_GET;
    $i = 1;
    $active = 0;

    // echo var_dump($user);

    if (isset($data["active"])) {
        $active = (int) $data["active"];
    } else {
        $active = 0;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php if(isset($_SESSION['logged_user'])): ?>


            <title>Панель управления</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="style.css">
        </head>
        <body>    

            <header>
            <nav class="navbar fixed-top navbar-expand-lg navbar-light scrolling-navbar">
                <div class="container-fluid">
                <a href="#" class="navbar-brand"><strong>SmartHive. Общее</strong></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" 
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a href="#" class="nav-link">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Настройки</a>
                    </li>
                    <button class="btn btn-danger" onclick="log_out()">Выход</button>
                    </ul>
                </div>
                </div>
            </nav>

            <div class="sidebar-fixed position-fixed">
                <a href="#" class="logo-wrapper">
                    <!-- <img src="img/bee.svg" alt="" class="img-fluid"> -->
                </a>
                <div class="list-group list-group-flush">
                <?php

                if ($active == 0) {
                    echo "<a href=\"?active=0\" class=\"list-group-item active\">Общее</a>";
                } else {
                    echo "<a href=\"?active=0\" class=\"list-group-item\">Общее</a>";
                }

                while ($i <= $hive_count) {
                    if ($active == $i) {
                    echo "<a href=\"?active={$i}\" class=\"list-group-item active\">Улей {$i}</a>";
                    } else {
                    echo "<a href=\"?active={$i}\" class=\"list-group-item\">Улей {$i}</a>";
                    }
                    $i++;
                }
                ?>
                </div>
            </div>
            </header>

            <main class="pt-5 max-lg-5">

            <!-- график температуры -->
            <div class="container-fluid mt-5">
                <div class="row">
                <div class="col-md-9 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <canvas style="position: relative; height:70vh; width:90vw;" id="tempChart"></canvas>
                    </div>
                    </div>
                </div>

                <!-- прогресс бары -->
                <div class="col-md-3 mb-4">
                    <div class="card mb-2">
                    <div class="card-body">
                        <p class="m-0">Температура</p>
                        <div class="progress m-2">
                        <div class="progress-bar" id="tempProgress" role="progressbar" style="width: 80%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">80%</div>
                        </div>
                        <p class="m-0">Влажность</p>
                        <div class="progress m-2">
                        <div class="progress-bar" id="humProgress" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                        <p class="m-0">Вес</p>
                        <div class="progress m-2">
                        <div class="progress-bar" id="weightProgress" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                        <p class="m-0">Заряд аккумулятора</p>
                        <div class="progress m-2">
                        <div class="progress-bar" id="procProgress" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- график влажности -->
                <div class="col-md-9 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <canvas style="position: relative; height:70vh; width:90vw;" id="humChart"></canvas>
                    </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card mb-2">
                    <div class="card-header"><h5 class="card-title m-0">Новости</h5></div>
                    <div class="card-body">
                    </div>
                    </div>
                </div>

                </div>
            </div>
            </main>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

            <script src="script.js"></script>
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
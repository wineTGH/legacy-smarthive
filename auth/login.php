<?php
    define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');

    include ROOT.'/libs/db.php';

    $data = $_POST;

    if (isset($data['do_login'])) {
        $errors = array();
        if (trim($data['login']) == '') {
            $errors[] = 'Введите логин!';
        }

        if ($data['pass'] == '') {
            $errors[] = 'Введите пароль!';
        }

        $user = R::findOne('users', 'login=?', array($data['login']));

        if($user){
            if(password_verify($data['pass'], $user['pass'])){
                $_SESSION['logged_user'] = $user; // Создаём сессию с этим пользователем
                header('location: '. ROOT);
                echo '<div style="color: green;">Успешно</div>';
            } else {
                $errors[] = 'Неверный пароль!';
            }

        } else {
         $errors[] = 'Пользователь с таким логином не найден!';   
        }
    
    if (!empty($errors)){
        echo '<div style="color: red;">'.array_shift($errors).'</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
</head>
<body>
    <form action="/php/login.php" method="post">
        <input name="login" type="text" placeholder="логин" value=<?php echo $data['login']; ?>> <br>
        <input name="pass" type="password" placeholder="пароль" value=<?php echo $data['pass']; ?>><br>
        <button name="do_login" type="submit">Вход</button>
    </form>
</body>
</html>
<?php

    define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');

    include ROOT.'/libs/db.php';

    $data = $_POST;

    //*-- Проверка на ошибки в заполнении формы --*//
    if (isset($data['do_signup'])) {
        
        $errors = array();

        if (trim($data['login']) == '') {
            $errors[] = 'Введите логин!';
        }

        if (trim($data['email']) == '') {
            $errors[] = 'Введите эл. почту!';
        }

        if ($data['pass'] == '') {
            $errors[] = 'Введите пароль!';
        }

        if (R::count('users', 'login = ? OR email = ?', array($data['login'], $data['email'])) > 0) {
            $errors[] = 'Пользователь с таким логином (или почтой) уже существует!';
        }

        if (trim($data['bee_id']) != '') {
            if (R::count('users', 'hiveid = ?', array($data['bee_id'])) > 0) {
                $errors[] = 'Этот улей уже зарегестрирован!';
            }
        }

    //*-- Регистрация пользователя --*//
    if (empty($errors)){

        $user = R::dispense('users');
        $user -> login  = $data['login'];
        $user -> email  = $data['email'];
        $user -> hiveid = $data['bee_id'];
        $user -> hivecount = 1;
        $user -> pass = password_hash($data['pass'], PASSWORD_DEFAULT);
        R::store($user);
        
        $hive = R::dispense($user -> id);
        $hive -> hivecount = 1;
        $hive -> hiveid = $user -> hiveid;
        $hive -> temp1 = 0;
        $hive -> hum1 = 0;
        $hive -> weight1 = 0;
        $hive -> energy1 = 0;
        R::store($hive);

        $_SESSION['logged_user'] = $user;

        header('location: /');
        echo '<div style="color: green;">Успешно</div>';

    } else {
        echo '<div style="color: red;">'.array_shift($errors).'</div>'; //! Вывод ошибки
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    <form action="/auth/reg.php" method="post">
        <input name="login" type="text" placeholder="логин" value=<?php echo @$data['login'] ?>><br>
        <input name="email" type="email" placeholder="почта" value=<?php echo @$data['email'] ?>><br>
        <input name="pass" type="password" placeholder="пароль" value=<?php echo @$data['pass'] ?>><br>
        <input name="bee_id" type="text" placeholder="идентификатор улья" value=<?php echo @$data['bee_id'] ?>><br>
        <button type="submit" name="do_signup">Зарегестрироваться</button><br>
    </form>
</body>
</html>
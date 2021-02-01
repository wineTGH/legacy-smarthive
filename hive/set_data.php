<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);    

    define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');
    include ROOT.'/libs/db.php';

    $data = $_GET;
    $i = 1;
    $errors = false;
    $user = R::findOne('users', 'hiveid=?', array($data['hiveid']));
    $buffer = 0;


    $hive_count = (int) $data['hive_count'];

    if ( isset($data)) {
        if ($data['hiveid'] == $user['hiveid']) {

            $buffer = R::dispense($user['id']);
            $buffer['hiveid'] = $data['hiveid'];
            
            while ($i <= $hive_count) {
                $buffer["temp{$i}"] = $data["temp{$i}"];
                $buffer["hum{$i}"] = $data["hum{$i}"];
                $buffer["weight{$i}"] = $data["weight{$i}"];
                $buffer["energy{$i}"] = $data["energy{$i}"];
                $buffer["hivecount"] = $data["hive_count"];
                $i++;
            }
                R::store($buffer);
                echo "success!";
        }
    }
?>
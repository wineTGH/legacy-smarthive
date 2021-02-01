<?php

    define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');
    include ROOT.'/libs/db.php';

    $user = $_SESSION['logged_user'];

    $hive = R::findLast($user["id"]);

    $i = 1;

    $hive_count = $hive["hivecount"];

    if ($hive) {
        $arr = array(
            "status" => "success",
        );

        while ($i <= $hive_count) {
            $arr["temp{$i}"] = $hive["temp{$i}"];
            $arr["hum{$i}"] = $hive["hum{$i}"];
            $arr["weight{$i}"] = $hive["weight{$i}"];
            $arr["energy{$i}"] = $hive["energy{$i}"];
            $i++;
        }
    

    } else {
        $arr = array (
            "status" => "error! Hive not found!"
        );
    }
    echo json_encode($arr);
    exit;
?>
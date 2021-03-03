<?php

    define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');
    include ROOT.'/libs/db.php';

    $user = $_SESSION['logged_user'];
    $hive = R::findLast($user["id"]);
    $i = 1;
    $hive_count = (int)$hive["hivecount"];
    $data = $_GET;

    $temp_mid = 0;
    $hum_mid = 0;
    $weight_mid = 0;
    $energy_mid = 0;

    if ($hive && isset($data['active'])) {
        $arr = array(
            "status" => "0",
        );
        $active = (int)$data['active'];

        if ($active == 0) {
            
            while ($i <= $hive_count) {
                $temp_mid   += $hive["temp{$i}"];
                $hum_mid    += $hive["hum{$i}"];
                $weight_mid += $hive["weight{$i}"];
                $energy_mid += $hive["energy{$i}"];
                $i++;
            }
            $arr["temp0"]   = $temp_mid / $hive_count;
            $arr["hum0"]    = $hum_mid / $hive_count;
            $arr["weight0"] = $weight_mid / $hive_count;
            $arr["energy0"] = $energy_mid / $hive_count;

        } else {
                $arr["temp{$active}"]   = $hive["temp{$active}"];
                $arr["hum{$active}"]    = $hive["hum{$active}"];
                $arr["weight{$active}"] = $hive["weight{$active}"];
                $arr["energy{$active}"] = $hive["energy{$active}"];
        }
    } else {
        $arr = array (
            "status" => "1"
        );
    }
    echo json_encode($arr);
    exit;
?>
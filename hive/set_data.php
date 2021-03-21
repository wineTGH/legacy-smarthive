<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);    

    define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');
    include ROOT.'/libs/db.php';

    $data          = $_GET;
    $i             = 1;
    $user          = R::findOne('users', 'hiveid=?', array($data['hiveid']));
    $buffer        = 0;
    $hive_count    = (int) $data['hivecount'];

    if ( isset($data)) {
        if ($data['hiveid'] == $user['hiveid']) {

            $buffer = R::dispense($user['id']);
            $buffer['hiveid'] = $data['hiveid'];
            
            while ($i <= $hive_count) {
                $buffer["temp{$i}"]   = $data["temp{$i}"];
                $buffer["hum{$i}"]    = $data["hum{$i}"];
                $buffer["weight{$i}"] = $data["weight{$i}"];
                $buffer["energy{$i}"] = $data["energy{$i}"];
                $i++;
            }
                
                $buffer["hivecount"]  = $data["hivecount"];
                $buffer['swarming']   = $data['swarming'];
                $buffer['time']       = get_user_time($user['timezone']);

                R::store($buffer);
                echo var_dump($buffer);
        }
    }

    function get_user_time($user_timezone):string {
        $url       = "http://worldtimeapi.org/api/timezone/".$user_timezone;
        $result    = file_get_contents ($url);
        $result    = json_decode($result, true);
        
        if(isset($result)) {
            //TODO Время уходит в минус, если на часах 23:00
            $unix_time = $result["unixtime"];
            $time = shell_exec("python3 ./time.py {$unix_time}");
            return $time;
        }
    }
?>
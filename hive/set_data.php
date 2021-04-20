<?php 
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
        $time = shell_exec("python3 ./time.py");
        return $time;
    }
?>
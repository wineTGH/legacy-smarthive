<?php
    define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');
    include ROOT.'/libs/db.php';

    $data = $_GET;
    $i = 1;

    $user = R::findOne('users', 'hiveid=?', array($data['hiveid']));

    if ( isset($data)) {
        if ($data['hiveid'] == $user['hiveid']){
            $buffer = R::dispense($user['id']);

            $buffer['hiveid'] = $data['hiveid'];
            //! Этот код может не работать
            while ($i <= $data['hive_count']) {
                $buffer['temp{$i}'] = $data['temp{$i}'];
                $buffer['hum{$i}'] = $data['hum{$i}'];
                $buffer['weight{$i}'] = $data['weight{$i}'];
                $buffer['energy{$i}'] = $data['energy{$i}'];
                $i++;
            }

            R::store($buffer);

            echo "success!";

        }
    }
?>
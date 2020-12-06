<?php

    include "db.php";

    $data = $_POST;

    $data = json_decode($data, true);

    $user = R::dispense('users');
    
    if ( isset($data)) {
        if ($data['hiveid'] == $user['hiveid']){
            $buffer = R::dispense($user['id']);

            $buffer['hiveid'] = $data['hiveid'];
            $buffer['data'] = $data['data'];
            R::store($buffer);
        }
    }

?>
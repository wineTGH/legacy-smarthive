<?php

    include "db.php";

    $data = $_POST;

    $user = R::findOne('users', 'hiveid=?', array($data['hiveid']));

    if ( isset($data)) {
        if ($data['hiveid'] == $user['hiveid']){
            // $buffer = R::findOne($user -> id, ' hiveid = ? ORDER BY id DESC', [$user -> hiveid]);

            // $buffer -> hiveid = $data['hiveid'];
            // $buffer -> data = $data['data'];
            // R::store($buffer);

            echo "success!";

        }

    }
?>
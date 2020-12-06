<?php

    include 'db.php';

    $user = $_SESSION['logged_user'];

    $hive = R::findOne($user -> id, ' hiveid = ? ORDER BY id DESC', [$user -> hiveid]);

    // if ($user -> hiveid == $hive -> hiveid) {


    // }

    $arr = array(
        'data' => $hive -> data
    ); 

    echo json_encode($arr);
    exit;

?>
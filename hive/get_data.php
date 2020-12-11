<?php

    define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');
    include ROOT.'/libs/db.php';

    $user = $_SESSION['logged_user'];

    $hive = R::findOne($user -> id, ' hiveid = ? ORDER BY id DESC', [$user -> hiveid]);

    if ($hive) {
        $arr = array(
            'data' => $hive -> data
        ); 
    
        echo json_encode($arr);
        exit;
    }
?>
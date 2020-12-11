<?php
    define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');
    include ROOT.'/libs/db.php';

    $data = $_GET;

    $user = R::findOne('users', 'hiveid=?', array($data['hiveid']));

    if ( isset($data)) {
        if ($data['hiveid'] == $user['hiveid']){
            $buffer = R::dispense($user['id']);

            $buffer['hiveid'] = $data['hiveid'];
            $buffer['data']   = $data['data'];
            R::store($buffer);

            echo "success!";

        }
    }
?>
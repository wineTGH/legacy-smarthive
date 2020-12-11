<?php
define('ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) .'/');
include ROOT.'/libs/db.php';
unset($_SESSION['logged_user']);
header('location: '. ROOT);
?>
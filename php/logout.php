<?php
include 'db.php';
unset($_SESSION['logged_user']);
header('location: /');
?>
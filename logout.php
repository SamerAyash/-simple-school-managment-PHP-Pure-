<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $url= $host.'/'.$_SESSION['user_type'].'/login.php';
    unset($_SESSION['user_name']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_type']);
    header("Location: ".$url);
}
else{
    $url= $host.'/'.$_SESSION['user_type'];
    header("Location: ".$url);
}
?>
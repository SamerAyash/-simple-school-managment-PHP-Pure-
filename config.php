<?php
$host= "http://".$_SERVER['HTTP_HOST']."/school_managment";
$connection = mysqli_connect('localhost', 'root', '', 'school_management');
if (!$connection) {
    die('Could not connect to database: ' . mysqli_connect_error());
}

session_start();
?>
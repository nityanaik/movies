<?php
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
    $dbhost = 'localhost:8080';
    $dbuser = 'root';
    $dbpass = 'root';
    // $dbname = 'drupal';
    
    $conn = mysql_connect($dbhost,$dbuser,$dbpass);
    
    if($conn->connect_error){
    die("connection failed:" .$connect->connect_error);
    }
?>
<?php

$host='phpmyadmin.test';
$dbname='mentorat';
$usrname='root';
$password='';

try {
    //code...

    $pdo=new PDO("mysql:host=$host;dbname=$dbname",$usrname,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    //throw $th;
}
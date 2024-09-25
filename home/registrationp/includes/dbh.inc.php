<?php

$host = 'localhost';
$dbname = 'suqqa';
$dbusername = 'root';
$dbpassword = '';


try{
$pdo = new PDO("mysql:host=$host;dbname=$dbname",$dbusername,$dbpassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
echo 'Connected to the database!';
}

catch(PDOException $e)
{
    die("connection failed:" . $e->getMessage());
}
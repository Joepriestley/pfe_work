<?php

$host ='gisportal.cfzonnclgbha.us-east-1.rds.amazonaws.com';
$dbname ='GISportal';
$dbusername ='postgres';
$dbpassword ='';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname",$dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException) {
    die("connection failed :".$e->getMessage());
}



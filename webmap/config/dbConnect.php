<?php

$dsn = "pgsql:host=gisportal.cfzonnclgbha.us-east-1.rds.amazonaws.com;dbname=GISportal;port=5432";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];
$pdo = new PDO($dsn, 'postgres', '1114joseph', $opt);
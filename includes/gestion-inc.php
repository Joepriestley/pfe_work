<?php
$pdo = require_once './dbConnect.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        header ('Location: ./gestion.php');
       echo $_POST['dategestion'];
    }else {
        header ('Location: ../error.php');
    }

?>
<?php
    require_once ("./config/dbConnect.php");
    $result1 = $pdo->query("SELECT * FROM espece_zone INNER JOIN espece_animale ON espece_zone.espece_name = espece_animale.nomscientifique")->fetchAll(PDO::FETCH_ASSOC); 
    $result2 = $pdo->query("SELECT * FROM espece_zone INNER JOIN espece_vegetale ON espece_zone.espece_name = espece_vegetale.nomscientifique")->fetchAll(PDO::FETCH_ASSOC);  
    
    $result = array_merge($result1, $result2);
    echo json_encode($result);
?>
<?php
    require_once ("./config/dbConnect.php");

    $resultAgri = $pdo->query("SELECT *, 'agriculture' as activite_type  FROM activites, agriculture where agriculture.codeactivite = activites.codeactivite ")->fetchAll(PDO::FETCH_ASSOC);
    $resultApi =  $pdo->query("SELECT *, 'apiculture' as activite_type  FROM activites, apiculture where apiculture.codeactivite = activites.codeactivite ")->fetchAll(PDO::FETCH_ASSOC);
    $resultEle = $pdo->query("SELECT *, 'elevages' as activite_type FROM activites, elevages where elevages.codeactivite = activites.codeactivite ")->fetchAll(PDO::FETCH_ASSOC);
    $resultPerche = $pdo->query("SELECT *, 'perche_artisanal' as activite_type FROM activites, perche_artisanal where perche_artisanal.codeactivite = activites.codeactivite ")->fetchAll(PDO::FETCH_ASSOC);
    $resultaut= $pdo->query("SELECT *,'autre_activites' as activite_type FROM activites, autre_activites where autre_activites.codeactivite = activites.codeactivite ")->fetchAll(PDO::FETCH_ASSOC);
    $result = array_merge($resultAgri, $resultApi, $resultEle, $resultPerche, $resultaut);
    echo json_encode($result);

?>
 
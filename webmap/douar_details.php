<?php
    require_once ("./config/dbConnect.php");
    // get douar_id parameter 
    $douar_id =  $_GET['douar_id'];
    echo "dddddddd $douar_id";

    $queryStatement = $pdo->query("SELECT * ,ST_AsGeoJSON(geom,5) AS geojson FROM douarsparc");

    // $result = array();

    // foreach($queryStatement AS $row){
    //     unset($row['geom']);
    //     $row['geojson']=json_decode($row['geojson']);
    //     $result[] = $row;
    // }
    // echo json_encode($result);

?>
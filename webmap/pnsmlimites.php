<?php
    require_once ("./config/dbConnect.php");

    $result = $pdo->query("SELECT * ,ST_AsGeoJSON(geom,5) AS geojson FROM parcLimites");
    $features =[];
    foreach($result AS $row){
        unset($row['geom']);
       $geometry=$row['geojson']=json_decode($row['geojson']);
       unset($row['geojson']);
       $feature =["type"=>"Feature","geometry"=>$geometry,"properties"=>$row];
        array_push($features,$feature);
    }
    $featureCollection=["type"=>"FeatureCollection","features"=>$features];
    echo json_encode($featureCollection);
//clusters
?>
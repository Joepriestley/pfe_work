<?php
$pdo = require_once '../includes/dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_amenagementtour'])){
    $id_ref_amengt_tour = $_POST['id_ref_amengt_tour'];

    try{
        $query = "DELETE FROM ref_amenagement_touristique WHERE id_ref_amengt_tour = :id_ref_amengt_tour;";

        $stmt = $pdo->prepare($query);
        
        if ($stmt){
            //binding params including the ids of the record to delete 
            $params =[
                ':id_ref_amengt_tour' => $id_ref_amengt_tour];
                $result = $stmt->execute($params);
                if ($result){
                    header("Location ../ref_amenagementtouristique.php?message=Record deleted successfully!");
                    exit();
                }else{
                    echo "Error: " . $stmt->erroorInfo()[2];
                }
               
        } else {
            echo "Error preparing statement.";
        }

    } catch (PDOException $e){
        echo "Error: " . $e->getMessage();
        
    }

}
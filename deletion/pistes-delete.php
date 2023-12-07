<?php
$pdo = require_once '../includes/dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_piste'])){
    $id_piste = $_POST['id_piste'];

    try{
        $query = "DELETE FROM pistes WHERE id_piste = :id_piste;";

        $stmt = $pdo->prepare($query);
        
        if ($stmt){
            //binding params including the ids of the record to delete 
            $params =[
                ':id_piste' => $id_piste];
                $result = $stmt->execute($params);
                if ($result){
                    header("Location ../pistes.php?message=Record deleted successfully!");
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
<?php
$pdo = require_once '../includes/dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_cloture'])){
    $id_cloture = $_POST['id_cloture'];

    try{
        $query = "DELETE FROM clotures WHERE id_cloture = :id_cloture;";

        $stmt = $pdo->prepare($query);
        
        if ($stmt){
            //binding params including the ids of the record to delete 
            $params =[
                ':id_cloture' => $id_cloture];
                $result = $stmt->execute($params);
                if ($result){
                    header("Location ../cloture.php?message=Record deleted successfully!");
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
<?php
$pdo = require_once '../includes/dbConnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_ref_point_eau'])){
    $id_ref_point_eau = $_POST['id_ref_point_eau'];
    
    try {
        $query = "DELETE FROM ref_point_eau WHERE id_ref_point_eau =:id_ref_point_eau;";
        $stmt = $pdo->prepare($query);

        if ($stmt){
            //binding parameters including id of the record to delete 
            $params = [':id_ref_point_eau'=>$id_ref_point_eau];
            $result = $stmt->execute($params);

            if ($result){
                header("Location: ../ref_point_eau.php?message=Record deleted successfully!");
                exit();
            }else{
                echo "Error: " .$stmt->errorInfo()[2];
               
            }
        }else{
            echo "Error preparing statement.";
        }
       
    } catch (PDOException $e) {
        echo "Error: " .$e->getMessage();
        //throw $th;
    }
}
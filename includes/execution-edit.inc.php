<?php
$pdo = require_once 'dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Server-side data validation
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $activite  = validate($_POST['activite ']);
    $id_executeur = validate($_POST['id_executeur']);
    $id_action = validate($_POST['id_action']);
   
    // Perform server-side validation
    if (empty($activite ) || empty($id_executeur) || empty($id_action) ) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE execut 
            SET id_executeur = :id_executeur,
                id_action = :id_action
            WHERE activite  = :idToUpdate"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':id_executeur' => $id_executeur,
                    ':id_action' => $id_action,
                    ':idToUpdate' => $activite  // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../execution.php?message=Les mises a jour faite avec success!");
                    exit();
                } else {
                    echo "Error: " . $stmt->errorInfo()[2];
                }

            } else {
                echo "Error preparing statement.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }




}

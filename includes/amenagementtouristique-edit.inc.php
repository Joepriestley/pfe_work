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

   
    
    $id_amengttour = validate($_POST['id_amengttour']);
    $responsable = validate($_POST['responsable']);
    $periode  = validate($_POST['periode']);
    $cout_creaction = validate($_POST['cout_creaction']);
    $date_cree  = validate($_POST['date_cree']);
    
    // Perform server-side validation
    if (  empty($id_amengttour) || empty($responsable) || empty($periode) || empty($commentaire)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE amenagement_touristique 
            SET responsable = :responsable,
                periode = :periode,
                cout_creaction = :cout_creaction,
                date_cree = :date_cree,
            WHERE id_amengttour = :idToUpdate"; // Use the correct primary key field
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':etatelement' => $etatelement,
                    ':responsable' => $responsable,
                    ':periode' => $periode,
                    ':cout_creaction' => $cout_creaction,
                    ':date_cree' => $date_cree,
                    ':idToUpdate' => $id_amengttour // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../amenagementtouristique.php?message=Les mises a jour faites avec success!!");
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

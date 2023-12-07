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

    $id_suivi = validate($_POST['id_suivi']);
    $lieu = validate($_POST['lieu']);
    $datesuivi = validate($_POST['datesuivi']);
    $responsable = validate($_POST['responsable']);
    $typeobservation = validate($_POST['typeobservation']);

    // Perform server-side validation
    if (empty($id_suivi) || empty($lieu) || empty($datesuivi) || empty($responsable) || empty($typeobservation)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE suivi_faune 
                      SET lieu = :lieu,
                          datesuivi = :datesuivi,
                          responsable = :responsable,
                          typeobservation = :typeobservation
                      WHERE id_suivi = :idToUpdate"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':lieu' => $lieu,
                    ':datesuivi' => $datesuivi,
                    ':responsable' => $responsable,
                    ':typeobservation' => $typeobservation,
                    ':idToUpdate' => $id_suivi // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../suivi_faune.php?message=Data updated successfully!");
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
?>

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

    $id_infrastructure = validate($_POST['id_infrastructure']);
    $nominfra = validate($_POST['nominfra']);
    $typeinfra = validate($_POST['typeinfra']);
    $etatinfra = validate($_POST['etatinfra']);
    $localisation = validate($_POST['localisation']);
    $datecontruction = validate($_POST['datecontruction']);
    $commentaire = validate($_POST['commentaire']);
    // Perform server-side validation
    if (empty($id_infrastructure) || empty($nominfra) || empty($typeinfra) || empty($etatinfra) || empty($localisation) || empty($datecontruction)|| empty($commentaire)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE infrastructure_touristique 
            SET nominfra = :nominfra,
                typeinfra = :typeinfra,
                etatinfra = :etatinfra,
                localisation = :localisation,
                datecontruction = :datecontruction,
                commentaire = :commentaire
            WHERE id_infrastructure = :idToUpdate"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':nominfra' => $nominfra,
                    ':typeinfra' => $typeinfra,
                    ':etatinfra' => $etatinfra,
                    ':localisation' => $localisation,
                    ':datecontruction' => $datecontruction,
                    ':commentaire' => $commentaire,
                    ':idToUpdate' => $id_infrastructure // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../infrastruturetouristiq.php?message=Les mises a jour faite avec success!");
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

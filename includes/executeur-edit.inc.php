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

    $numerocin = validate($_POST['numerocin']);
    $nomexecuteur = validate($_POST['nomexecuteur']);
    $prenomexecuteur = validate($_POST['prenomexecuteur']);
    $qualiteexecuteur = validate($_POST['qualiteexecuteur']);
    $adresse = validate($_POST['adresse']);
    $telephone = validate($_POST['telephone']);
    // Perform server-side validation
    if (empty($numerocin) || empty($nomexecuteur) || empty($prenomexecuteur) || empty($qualiteexecuteur) || empty($adresse) || empty($telephone)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE executeur 
            SET nomexecuteur = :nomexecuteur,
                prenomexecuteur = :prenomexecuteur,
                qualiteexecuteur = :qualiteexecuteur,
                adresse = :adresse,
                telephone = :telephone
            WHERE numerocin = :idToUpdate"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':nomexecuteur' => $nomexecuteur,
                    ':prenomexecuteur' => $prenomexecuteur,
                    ':qualiteexecuteur' => $qualiteexecuteur,
                    ':adresse' => $adresse,
                    ':telephone' => $telephone,
                    ':idToUpdate' => $numerocin // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../executeur.php?message=Les mises a jour faite avec success!");
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

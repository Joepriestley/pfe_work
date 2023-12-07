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

    $codeactivite = validate($_POST['codeactivite']);
    $codeactivite = validate($_POST['codeactivite']);
    $nombrepratiquant = validate($_POST['nombrepratiquant']);
    $commentaire = validate($_POST['commentaire']);
    $douar = validate($_POST['douar']);
    $rendement = validate($_POST['rendement']);
    $nombreruches = validate($_POST['nombreruches']);

    // Perform server-side validation
    if (empty($codeactivite) || empty($codeactivite) || empty($nombrepratiquant) || empty($commentaire) || empty($douar) || empty($rendement)|| empty($nombreruches)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE apiculture 
            SET codeactivite = :codeactivite,
                nombrepratiquant = :nombrepratiquant,
                commentaire = :commentaire,
                douar = :douar,
                rendement = :rendement,
                nombreruches = :nombreruches
            WHERE codeactivite = :idToUpdate"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':codeactivite' => $codeactivite,
                    ':nombrepratiquant' => $nombrepratiquant,
                    ':commentaire' => $commentaire,
                    ':douar' => $douar,
                    ':rendement' => $rendement,
                    ':nombreruches' => $nombreruches,
                    ':idToUpdate' => $codeactivite // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../apiculture.php?message=Les mises a jour faites avec success!");
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

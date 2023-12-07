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
    $annee = validate($_POST['annee']);
    $nombrepratiquant = validate($_POST['nombrepratiquant']);
    $commentaire = validate($_POST['commentaire']);
    $douar = validate($_POST['douar']);
    $type = validate($_POST['type']);
    $effectif = validate($_POST['effectif']);
    $rendement = validate($_POST['rendement']);
    

    // Perform server-side validation
    if (empty($codeactivite) || empty($annee) || empty($nombrepratiquant) || empty($commentaire) || empty($douar) || empty($type)|| empty($effectif)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE elevages
            SET annee = :annee,
                nombrepratiquant = :nombrepratiquant,
                commentaire = :commentaire,
                douar = :douar,
                type = :type,
                effectif = :effectif,
                rendement = :rendement
            WHERE codeactivite = :codeactivite"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':annee' => $annee,
                    ':nombrepratiquant' => $nombrepratiquant,
                    ':commentaire' => $commentaire,
                    ':douar' => $douar,
                    ':type' => $type,
                    ':effectif' => $effectif,
                    ':rendement' => $rendement,
                    ':codeactivite' => $codeactivite // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../elevage.php?message=Les mises a jour faites avec success!");
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

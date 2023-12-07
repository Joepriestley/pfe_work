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
    $nomactivite = validate($_POST['nomactivite']);
    $caracteristiques = validate($_POST['caracteristiques']);
    // Perform server-side validation
    if (empty($codeactivite) || empty($annee) || empty($nombrepratiquant) || empty($commentaire) || empty($douar) || empty($nomactivite)|| empty($caracteristiques)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE autre_activites 
            SET annee = :annee,
                nombrepratiquant = :nombrepratiquant,
                commentaire = :commentaire,
                douar = :douar,
                nomactivite = :nomactivite,
                caracteristiques = :caracteristiques
            WHERE codeactivite = :idToUpdate"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':annee' => $annee,
                    ':nombrepratiquant' => $nombrepratiquant,
                    ':commentaire' => $commentaire,
                    ':douar' => $douar,
                    ':nomactivite' => $nomactivite,
                    ':caracteristiques' => $caracteristiques,
                    ':idToUpdate' => $codeactivite // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../autreactivite.php?message=Les mises a jour faites avec success!");
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

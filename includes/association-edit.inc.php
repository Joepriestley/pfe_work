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

    $nomassociation = validate($_POST['nomassociation']);
    $nompresident = validate($_POST['nompresident']);
    $adresse = validate($_POST['adresse']);
    $datecreation = validate($_POST['datecreation']);
    $objectif = validate($_POST['objectif']);
    $id_douar = validate($_POST['id_douar']);
    $moyens = validate($_POST['moyens']);
    $commentaire = validate($_POST['commentaire']);
    // Perform server-side validation
    if (empty($nomassociation) || empty($nompresident) || empty($adresse) || empty($datecreation) || empty($objectif) || empty($id_douar) || empty($moyens)|| empty($commentaire)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE association 
            SET nompresident = :nompresident,
                adresse = :adresse,
                datecreation = :datecreation,
                objectif = :objectif,
                id_douar = :id_douar,
                moyens = :moyens,
                commentaire = :commentaire
            WHERE nomassociation = :nomassociation"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':nompresident' => $nompresident,
                    ':adresse' => $adresse,
                    ':datecreation' => $datecreation,
                    ':objectif' => $objectif,
                    ':id_douar' => $id_douar,
                    ':moyens' => $moyens,
                    ':commentaire' => $commentaire,
                    ':nomassociation' => $nomassociation // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../association.php?message=Les mises a jour faites avec success!");
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

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

    $codeprojet = validate($_POST['codeprojet']);
    $nomprojet = validate($_POST['nomprojet']);
    $objectif = validate($_POST['objectif']);
    $datedebut = validate($_POST['datedebut']);
    $duree = validate($_POST['duree']);
    $budget = validate($_POST['budget']);
    $categoriepayment = validate($_POST['categoriepayment']);
    $commentaire = validate($_POST['commentaire']);
    $id_association = validate($_POST['id_association']);

    // Perform server-side validation
    if (empty($codeprojet) || empty($nomprojet) || empty($objectif) || empty($datedebut) || empty($duree) || empty($budget) || empty($categoriepayment) || empty($commentaire) || empty($id_association)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE projet 
            SET nomprojet = :nomprojet,
                objectif = :objectif,
                datedebut = :datedebut,
                duree = :duree,
                budget = :budget,
                categoriepayment = :categoriepayment,
                commentaire = :commentaire,
                id_association = :id_association
            WHERE codeprojet = :codeprojet"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':nomprojet' => $nomprojet,
                    ':objectif' => $objectif,
                    ':datedebut' => $datedebut,
                    ':duree' => $duree,
                    ':budget' => $budget,
                    ':categoriepayment' => $categoriepayment,
                    ':commentaire' => $commentaire,
                    ':id_association' => $id_association,
                    ':codeprojet' => $codeprojet // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../projet.php?message=Data updated successfully!");
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
// Add HTML form to display the data and allow editing here
?>

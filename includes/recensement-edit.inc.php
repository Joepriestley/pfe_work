<?php
$pdo = require_once 'dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Server-side data validation (similar to what you did for 'sol' table)

    // Validate and sanitize data for 'recensement' table
    $effectifmales = validate($_POST['effectifmales']);
    $effectiffemelles = validate($_POST['effectiffemelles']);
    $effectifjeunes = validate($_POST['effectifjeunes']);
    $effectiftotal = validate($_POST['effectiftotal']);
    $vitessedeplacement = validate($_POST['vitessedeplacement']);
    $commentaire = validate($_POST['commentaire']);
    $espece_animale = validate($_POST['espece_animale']);
    $id_faune_suivi = validate($_POST['id_faune_suivi']);

    // Perform server-side validation
    if (empty($effectifmales) || empty($effectiffemelles) || empty($effectifjeunes) || empty($effectiftotal) || empty($vitessedeplacement) || empty($commentaire) || empty($espece_animale) || empty($id_faune_suivi)) {
        echo "Please fill in all fields.";
    } else {
        try {
            // Update query for 'recensement' table
            $query = "UPDATE recensement 
                      SET effectifmales = :effectifmales,
                          effectiffemelles = :effectiffemelles,
                          effectifjeunes = :effectifjeunes,
                          effectiftotal = :effectiftotal,
                          vitessedeplacement = :vitessedeplacement,
                          commentaire = :commentaire
                      WHERE espece_animale = :espece_animale AND id_faune_suivi = :id_faune_suivi";

            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters
                $params = [
                    ':effectifmales' => $effectifmales,
                    ':effectiffemelles' => $effectiffemelles,
                    ':effectifjeunes' => $effectifjeunes,
                    ':effectiftotal' => $effectiftotal,
                    ':vitessedeplacement' => $vitessedeplacement,
                    ':commentaire' => $commentaire,
                    ':espece_animale' => $espece_animale,
                    ':id_faune_suivi' => $id_faune_suivi,
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../recensement.php?message=Data updated successfully!");
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

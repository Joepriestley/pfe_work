<?php
$pdo = require_once 'dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_perche'])) {

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
    $nomperche_art = validate($_POST['nomperche_art']);
    $rendement = validate($_POST['rendement']);

    // Update query
    try {
        $query = "UPDATE perche_artisanal SET
                    annee = :annee,
                    nombrepratiquant = :nombrepratiquant,
                    commentaire = :commentaire,
                    douar = :douar,
                    nomperche_art = :nomperche_art,
                    rendement = :rendement
                  WHERE codeactivite = :codeactivite";

        $stmt = $pdo->prepare($query);

        if ($stmt) {
            // Bind parameters
            $stmt->bindParam(':annee', $annee);
            $stmt->bindParam(':nombrepratiquant', $nombrepratiquant);
            $stmt->bindParam(':commentaire', $commentaire);
            $stmt->bindParam(':douar', $douar);
            $stmt->bindParam(':nomperche_art', $nomperche_art);
            $stmt->bindParam(':rendement', $rendement);
            $stmt->bindParam(':codeactivite', $codeactivite);

            $result = $stmt->execute();

            if ($result) {
                header("Location: ../percheartisanal.php?message=Record updated successfully!");
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
?>


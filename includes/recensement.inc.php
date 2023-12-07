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

    $effectifmales = validate($_POST['effectifmales']);
    $effectiffemelles = validate($_POST['effectiffemelles']);
    $effectifjeunes = validate($_POST['effectifjeunes']);
    $effectiftotal = validate($_POST['effectiftotal']);
    $vitessedeplacement = validate($_POST['vitessedeplacement']);
    $commentaire = validate($_POST['commentaire']);
    $espece_animale = validate($_POST['espece_animale']);
    $id_faune_suivi = validate($_POST['id_faune_suivi']);


    // Perform server-side validation
    if (empty($effectifmales) || empty($effectiffemelles) || empty($effectifjeunes) || empty($effectiftotal) || empty($vitessedeplacement) || empty($commentaire) || empty($espece_animale)
        || empty($id_faune_suivi) || empty($id_recensement)) {
            header("Location: ../recensement.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO recensement (effectifmales, effectiffemelles, effectifjeunes, effectiftotal, vitessedeplacement, commentaire, espece_animale, id_faune_suivi)
                     VALUES (:effectifmales, :effectiffemelles, :effectifjeunes, :effectiftotal, :vitessedeplacement, :commentaire, :espece_animale, :id_faune_suivi)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':effectifmales' => $effectifmales,
                    ':effectiffemelles' => $effectiffemelles,
                    ':effectifjeunes' => $effectifjeunes,
                    ':effectiftotal' => $effectiftotal,
                    ':vitessedeplacement' => $vitessedeplacement,
                    ':commentaire' => $commentaire,
                    ':espece_animale' => $espece_animale,
                    ':id_faune_suivi' => $id_faune_suivi
                    
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../recensement.php?message=Data inserted successfully!");
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

    // Close the database connection (optional if your script ends here)
    // $pdo = null;
}
?>



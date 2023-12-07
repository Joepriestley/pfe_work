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

    // $codeactivite = validate($_POST['codeactivite']);
    $annee = validate($_POST['annee']);
    $nombrepratiquant = validate($_POST['nombrepratiquant']);
    $commentaire = validate($_POST['commentaire']);
    $douar = validate($_POST['douar']);
    $nomperche_art = validate($_POST['nomperche_art']);
    $douar = validate($_POST['douar']);
    $rendement = validate($_POST['rendement']);
    
    

    // Perform server-side validation
    if ( empty($annee) || empty($nombrepratiquant) || empty($commentaire) || empty($douar) || empty($nomperche_art) || empty($rendement)) {
            header("Location: ../percheartisanal.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO perche_artisanal (codeactivite, annee, nombrepratiquant, commentaire, douar,nomperche_art,rendement)
                     VALUES (uuid_generate_v4(), :annee, :nombrepratiquant, :commentaire, :douar,:nomperche_art,:rendement)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    // ':codeactivite' => $codeactivite,
                    ':annee' => $annee,
                    ':nombrepratiquant' => $nombrepratiquant,
                    ':commentaire' => $commentaire,
                    ':douar' => $douar,
                    ':nomperche_art' => $nomperche_art,
                    ':rendement' => $rendement
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../percheartisanal.php?message=Data inserted successfully!");
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



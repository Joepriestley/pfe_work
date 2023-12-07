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

    // $codeactivite ='';
    $annee = validate($_POST['annee']);
    $nombrepratiquant = validate($_POST['nombrepratiquant']);
    $commentaire = validate($_POST['commentaire']);
    $douar = validate($_POST['douar']);
    $rendement = validate($_POST['rendement']);
    $nombreruches = validate($_POST['nombreruches']);
    

    // Perform server-side validation
    if (empty($annee) || empty($nombrepratiquant) || empty($commentaire) || empty($rendement) || empty($nombreruches)) {
            header("Location: ../apiculture.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields."    
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO apiculture(codeactivite, annee, nombrepratiquant, commentaire, douar, rendement,nombreruches)
                     VALUES (uuid_generate_v4(), :annee, :nombrepratiquant, :commentaire, :douar, :rendement,:nombreruches)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    // ':codeactivite' => $codeactivite,
                    ':annee' => $annee,
                    ':nombrepratiquant' => $nombrepratiquant,
                    ':commentaire' => $commentaire,
                    ':douar' => $douar,
                    ':rendement' => $rendement,
                    ':nombreruches' => $nombreruches
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../apiculture.php?message=Data inserted successfully!");
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



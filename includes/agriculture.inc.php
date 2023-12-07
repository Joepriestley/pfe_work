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
    $rendement = validate($_POST['rendement']);
    $nom_culture = validate($_POST['nom_culture']);
    $type_culture = validate($_POST['type_culture']);
    $superficie = validate($_POST['superficie']);
    $douar = validate($_POST['douar']);
    
    

    // Perform server-side validation
    if (empty($annee) || empty($nombrepratiquant) || empty($commentaire) || empty($rendement) || empty($nom_culture) || empty($type_culture) || empty($superficie)) {
            header("Location: ../agriculture.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO agriculture(codeactivite,annee, nombrepratiquant, commentaire, rendement,nom_culture,type_culture,superficie,douar)
                     VALUES (uuid_generate_v4(),:annee,:nombrepratiquant, :commentaire, :rendement,:nom_culture,:type_culture,:superficie,:douar)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    // ':codeactivite' => $codeactivite,
                    ':annee' => $annee,
                    ':nombrepratiquant' => $nombrepratiquant,
                    ':commentaire' => $commentaire,
                    ':rendement' => $rendement,
                    ':nom_culture' => $nom_culture,
                    ':type_culture' => $type_culture,
                    ':superficie' => $superficie,
                    ':douar' => $douar,    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../agriculture.php?message=Data inserted successfully!");
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



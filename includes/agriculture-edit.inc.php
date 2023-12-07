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
    $nombrepratiquant = validate($_POST['nombrepratiquant']);
    $commentaire = validate($_POST['commentaire']);
    $douar = validate($_POST['douar']);
    $nom_culture = validate($_POST['nom_culture']);
    $type_culture = validate($_POST['type_culture']);
    $superficie = validate($_POST['superficie']);
    $rendement = validate($_POST['rendement']);
    

    // Perform server-side validation
    if (empty($codeactivite) || empty($nombrepratiquant) || empty($commentaire) || empty($douar) || empty($nom_culture)|| empty($type_culture) || empty($superficie)|| empty($rendement)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE agriculture 
            SET nombrepratiquant = :nombrepratiquant,
                commentaire = :commentaire,
                douar = :douar,
                nom_culture = :nom_culture,
                type_culture = :type_culture,
                superficie = :superficie,
                rendement = :rendement
            WHERE codeactivite = :codeactivite"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [ 
                    ':nombrepratiquant' => $nombrepratiquant,
                    ':commentaire' => $commentaire,
                    ':douar' => $douar,
                    ':nom_culture' => $nom_culture,
                    ':type_culture' => $type_culture,
                    ':superficie' => $superficie,
                    ':rendement' => $rendement,
                    ':codeactivite' => $codeactivite // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../agriculture.php?message=Les mises a jour faites avec success!");
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

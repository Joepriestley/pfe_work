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

    $codemunsell = validate($_POST['codemunsell']);
    $nomsol = validate($_POST['nomsol']);
    $groupe = validate($_POST['groupe']);
    $couleur = validate($_POST['couleur']);
    $classe = validate($_POST['classe']);
    $sousclasse = validate($_POST['sousclasse']);
    // Perform server-side validation
    if (empty($codemunsell) || empty($nomsol) || empty($groupe) || empty($couleur) || empty($classe) || empty($sousclasse)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE sol 
            SET nomsol = :nomsol,
                groupe = :groupe,
                couleur = :couleur,
                classe = :classe,
                sousclasse = :sousclasse
            WHERE codemunsell = :idToUpdate"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':nomsol' => $nomsol,
                    ':groupe' => $groupe,
                    ':couleur' => $couleur,
                    ':classe' => $classe,
                    ':sousclasse' => $sousclasse,
                    ':idToUpdate' => $codemunsell // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../sol.php?message=Data updated successfully!");
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

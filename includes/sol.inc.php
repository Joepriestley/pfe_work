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
    // $fonction = validate($_POST['fonction']);
    // $telephone = validate($_POST['telephone']);
    // $adresse = validate($_POST['adresse']);
    // $prenom = validate($_POST['prenom']);
    // $edit_sol = validate($_POST['edit_sol']);

    // Perform server-side validation
    if (empty($codemunsell) || empty($nomsol) || empty($groupe) || empty($couleur) || empty($classe) || empty($sousclasse)) {
        echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO sol (codemunsell, nomsol, groupe, couleur, classe, sousclasse)
                    VALUES (:codemunsell, :nomsol, :groupe, :couleur, :classe, :sousclasse)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':codemunsell' => $codemunsell,
                    ':nomsol' => $nomsol,
                    ':groupe' => $groupe,
                    ':couleur' => $couleur,
                    ':classe' => $age,
                    ':sousclasse' => $sousclasse
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../sol.php?message=Data inserted successfully!");
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

    //updating the data
    if (isset($edit_sol)){
        header("Location: ../sol-edit.php?id=".$codemunsell);
    }



    // 



     






    // Close the database connection (optional if your script ends here)
    // $pdo = null;
}

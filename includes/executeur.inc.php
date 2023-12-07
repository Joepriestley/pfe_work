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

    $numerocin = validate($_POST['numerocin']);
    $nomexecuteur = validate($_POST['nomexecuteur']);
    $prenomexecuteur = validate($_POST['prenomexecuteur']);
    $qualiteexecuteur = validate($_POST['qualiteexecuteur']);
    $adresse = validate($_POST['adresse']);
    $telephone = validate($_POST['telephone']);
   
    
    

    // Perform server-side validation
    if (empty($numerocin) || empty($nomexecuteur) || empty($prenomexecuteur) || empty($qualiteexecuteur) || empty($adresse) || empty($telephone)) {
            header("Location: ../executeur.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO executeur (numerocin, nomexecuteur,prenomexecuteur,qualiteexecuteur, adresse,telephone)
                     VALUES (:numerocin, :nomexecuteur, :prenomexecuteur,:qualiteexecuteur, :adresse,:telephone)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':numerocin' => $numerocin,
                    ':nomexecuteur' => $nomexecuteur,
                    ':prenomexecuteur' => $prenomexecuteur,
                    ':qualiteexecuteur' => $qualiteexecuteur,
                    ':adresse' =>$adresse,
                    ':telephone' => $telephone,
                   
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../executeur.php?message=Data inserted successfully!");
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



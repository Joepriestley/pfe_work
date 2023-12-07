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

    $nomassociation = validate($_POST['nomassociation']);
    $nompresident = validate($_POST['nompresident']);
    $adresse = validate($_POST['adresse']);
    $datecreation = validate($_POST['datecreation']);
    $objectif = validate($_POST['objectif']);
    $id_douar = validate($_POST['id_douar']);
    $moyens = validate($_POST['moyens']);
    $commentaire = validate($_POST['commentaire']);
   
    
    

    // Perform server-side validation
    if (empty($nomassociation) || empty($nompresident) || empty($adresse) || empty($datecreation) || empty($objectif) || empty($id_douar) || empty($moyens)|| empty($commentaire)) {
            header("Location: ../association.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO association (nomassociation, nompresident,adresse,datecreation, objectif,id_douar,moyens,commentaire)
                     VALUES (:nomassociation, :nompresident, :adresse,:datecreation, :objectif,:id_douar,:moyens,:commentaire)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':nomassociation' => $nomassociation,
                    ':nompresident' => $nompresident,
                    ':adresse' => $adresse,
                    ':datecreation' => $datecreation,
                    ':objectif' =>$objectif,
                    ':id_douar' => $id_douar,
                    ':moyens' => $moyens,
                    ':commentaire' => $commentaire
                    
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../association.php?message=Data inserted successfully!");
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



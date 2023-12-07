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

    $nomcircuit = validate($_POST['nomcircuit']);
    $categoriecircuit = validate($_POST['categoriecircuit']);
    $longeur = validate($_POST['longeur']);
    $pointdepart = validate($_POST['pointdepart']);
    $pointarrivee = validate($_POST['pointarrivee']);
    $commentaire = validate($_POST['commentaire']);
    $id_douar = validate($_POST['id_douar']);
    $nomsite = validate($_POST['nomsite']);
    
    

    // Perform server-side validation
    if (empty($nomcircuit) || empty($categoriecircuit) || empty($longeur)  || empty($pointdepart)|| empty($pointarrivee) || empty($commentaire)|| empty($id_douar)|| empty($nomsite)) {
        header("Location: ../circuittourist.php?message=<span style='color:green;'>veuillez saisir de donnees dans tous les champs!</span>");
        exit();
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO circuit_touristique (nomcircuit, categoriecircuit, longeur, pointdepart, pointarrivee,commentaire, id_douar,nomsite)
                     VALUES (:nomcircuit, :categoriecircuit, :longeur, :pointdepart, :pointarrivee, :commentaire,:id_douar,:nomsite )";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':nomcircuit' => $nomcircuit,
                    ':categoriecircuit' => $categoriecircuit,
                    ':longeur' => $longeur,
                    ':pointdepart' => $pointdepart,
                    ':pointarrivee' => $pointarrivee,
                    ':commentaire' => $commentaire,
                    ':id_douar' => $id_douar,
                    ':nomsite' => $nomsite
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../circuittourist.php?message=Data inserted successfully!");
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
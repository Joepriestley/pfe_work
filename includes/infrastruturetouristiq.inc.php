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

    $id_infrastructure = validate($_POST['id_infrastructure']);
    $nominfra = validate($_POST['nominfra']);
    $typeinfra = validate($_POST['typeinfra']);
    $etatinfra = validate($_POST['etatinfra']);
    $localisation = validate($_POST['localisation']);
    $datecontruction = validate($_POST['datecontruction']);
    $commentaire = validate($_POST['commentaire']);
    

    // Perform server-side validation
    if (empty($id_infrastructure) || empty($nominfra) || empty($typeinfra)  || empty($etatinfra)|| empty($localisation)|| empty($datecontruction)|| empty($commentaire)) {
        header("Location: ../infrastruturetouristiq.php?message=veuillez saisir de donnees dans tous les champs!");
        exit();
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO infrastructure_touristique (id_infrastructure, nominfra, typeinfra, etatinfra, localisation,datecontruction,commentaire)
                     VALUES (:id_infrastructure, :nominfra, :typeinfra, :etatinfra, :localisation,:datecontruction, :commentaire)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':id_infrastructure' => $id_infrastructure,
                    ':nominfra' => $nominfra,
                    ':typeinfra' => $typeinfra,
                    ':etatinfra' => $etatinfra,
                    ':localisation' => $localisation,
                    ':datecontruction' => $datecontruction,
                     ':commentaire' => $commentaire,
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../infrastruturetouristiq.php?message=Data inserted successfully!");
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
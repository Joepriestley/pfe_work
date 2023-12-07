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

    $dateutilisation = validate($_POST['dateutilisation']);
    $duree = validate($_POST['duree']);
    $appreciation = validate($_POST['appreciation']);
    $id_infrastructure = validate($_POST['id_infrastructure']);
    $id_touriste = validate($_POST['id_touriste']);
    

    // Perform server-side validation
    if (empty($dateutilisation) || empty($duree) || empty($appreciation) || empty($id_infrastructure) || empty($id_touriste)) {
        header("Location: ../utilise.php?message=veuillez saisir de donnees dans tous les champs!");
        exit();
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO utilise (dateutilisation, duree, appreciation, id_infrastructure, id_touriste)
                     VALUES (:dateutilisation, :duree, :appreciation, :id_infrastructure, :id_touriste)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':dateutilisation' => $dateutilisation,
                    ':duree' => $duree,
                    ':appreciation' => $appreciation,
                    ':id_infrastructure' => $id_infrastructure,
                    ':id_touriste' => $id_touriste,
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../utilise.php?message=Data inserted successfully!");
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
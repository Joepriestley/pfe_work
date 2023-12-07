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

    $datevisite = validate($_POST['datevisite']);
    $duree = validate($_POST['duree']);
    $visiteengroupe = validate($_POST['visiteengroupe']);
    $id_sitetouristique = validate($_POST['id_sitetouristique']);
    $id_touriste = validate($_POST['id_touriste']);
    

    // Perform server-side validation
    if (empty($datevisite) || empty($duree) || empty($visiteengroupe) || empty($id_sitetouristique) || empty($id_touriste)) {
        header("Location: ../visitesite.php?message=veuillez saisir de donnees dans tous les champs!");
        exit();
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO visitesite (datevisite, duree, visiteengroupe, id_sitetouristique, id_touriste)
                     VALUES (:datevisite, :duree, :visiteengroupe, :id_sitetouristique, :id_touriste)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':datevisite' => $datevisite,
                    ':duree' => $duree,
                    ':visiteengroupe' => $visiteengroupe,
                    ':id_sitetouristique' => $id_sitetouristique,
                    ':id_touriste' => $id_touriste,
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../visitesite.php?message=Data inserted successfully!");
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
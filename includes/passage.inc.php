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

    $datepassage = validate($_POST['datepassage']);
    $duree = validate($_POST['duree']);
    $en_groupe = validate($_POST['en_groupe']);
    $id_touriste = validate($_POST['id_touriste']);
    $id_circuittour = validate($_POST['id_circuittour']);
    
    

    // Perform server-side validation
    if (empty($datepassage) || empty($duree) || empty($en_groupe)  || empty($id_touriste) || empty($id_circuittour)) {
        header("Location: ../passage.php?message=veuillez saisir de donnees dans tous les champs!");
        exit();
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO passe (datepassage, duree, en_groupe, id_touriste, id_circuittour)
                     VALUES (:datepassage, :duree, :en_groupe, :id_touriste, :id_circuittour)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':datepassage' => $datepassage,
                    ':duree' => $duree,
                    ':en_groupe' => $en_groupe,
                    ':id_touriste' => $id_touriste,
                    ':id_circuittour' => $id_circuittour
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../passage.php?message=Data inserted successfully!");
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
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

    $id_suivi = validate($_POST['id_suivi']);
    $lieu = validate($_POST['lieu']);
    $datesuivi = validate($_POST['datesuivi']);
    $responsable = validate($_POST['responsable']);
    $typeobservation = validate($_POST['typeobservation']);
    
    

    // Perform server-side validation
    if (empty($id_suivi) || empty($lieu) || empty($datesuivi) || empty($responsable) || empty($typeobservation)) {
            header("Location: ../suivi_faune.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO suivi_faune (id_suivi, lieu, datesuivi, responsable, typeobservation)
                     VALUES (:id_suivi, :lieu, :datesuivi, :responsable, :typeobservation)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':id_suivi' => $id_suivi,
                    ':lieu' => $lieu,
                    ':datesuivi' => $datesuivi,
                    ':responsable' => $responsable,
                    ':typeobservation' => $typeobservation
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../suivi_faune.php?message=Data inserted successfully!");
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



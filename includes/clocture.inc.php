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

    $id_cloture = validate($_POST['id_cloture']);
    $date_cloture = validate($_POST['date_cloture']);
    $cout_creation = validate($_POST['cout_creation']);
    $nature = validate($_POST['nature']);
    $duree = validate($_POST['duree']);
    
    
    

    // Perform server-side validation
    if (empty($id_cloture) || empty($date_cloture) || empty($cout_creation) || empty($nature)|| empty($duree)) {
            header("Location: ../cloture.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO clotures (id_cloture,date_cloture,cout_creation,nature,duree)
                     VALUES (:id_cloture, :date_cloture,:cout_creation,:nature,:duree)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':id_cloture' => $id_cloture,
                    ':date_cloture' => $date_cloture,
                    ':cout_creation' => $cout_creation,
                    ':nature' => $nature,
                    ':duree' => $duree,
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../cloture.php?message=Data inserted successfully!");
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



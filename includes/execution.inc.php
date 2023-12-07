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

    $activite = validate($_POST['activite']);
    $id_executeur = validate($_POST['id_executeur']);
    $id_action = validate($_POST['id_action']);
   
    
    

    // Perform server-side validation
    if (empty($activite) || empty($id_executeur) || empty($id_action)) {
            header("Location: ../execution.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO execut (activite, id_executeur, id_action)
                     VALUES (:activite, :id_executeur,:id_action)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':activite' => $activite,
                    ':id_executeur' => $id_executeur,
                    ':id_action' => $id_action
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../execution.php?message=Data inserted successfully!");
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



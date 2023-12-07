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

    $id_action = validate($_POST['id_action']);
    $duree = validate($_POST['duree']);
    $lieu = validate($_POST['lieu']);
    $commentaire = validate($_POST['commentaire']);
    $id_projet = validate($_POST['id_projet']);
    
    

    // Perform server-side validation
    if (empty($id_action) || empty($duree) || empty($lieu) || empty($commentaire) || empty($id_projet)) {
            header("Location: ../action.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO actions (id_action, duree, lieu, commentaire,id_projet)
                     VALUES (:id_action, :duree, :lieu, :commentaire,:id_projet)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':id_action' => $id_action,
                    ':duree' => $duree,
                    ':lieu' => $lieu,
                    ':commentaire' => $commentaire,
                    ':id_projet' => $id_projet
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../action.php?message=Data inserted successfully!");
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



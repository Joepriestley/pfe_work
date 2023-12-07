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
    $nom_cloture = validate($_POST['nom_cloture']);
    
    
    // Perform server-side validation
    if (empty($id_cloture) || empty($date_cloture) || empty($cout_creation) || empty($nature) || empty($duree)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE clotures 
            SET id_cloture = :id_cloture,
                date_cloture = :date_cloture,
                cout_creation = :cout_creation,
                nature = :nature,
                duree = :duree,
                nom_cloture = nom_cloture,
                
            WHERE id_cloture = :idToUpdate"; // Change 'id_cloture' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':id_cloture' => $id_cloture,
                    ':date_cloture' => $date_cloture,
                    ':cout_creation' => $cout_creation,
                    ':nature' => $nature,
                    ':duree' => $duree,
                    ':nom_cloture' => $nom_cloture,
                    ':idToUpdate' => $id_cloture // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../cloture.php?message=Data updated successfully!");
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
}
?>

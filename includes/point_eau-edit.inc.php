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

    $id_point_eau  = validate($_POST['id_point_eau']);
    $profondeur = validate($_POST['profondeur']);
    $nature = validate($_POST['nature']);
    $cout_installation = validate($_POST['cout_installation']);
    $localisation = validate($_POST['localisation']);
    $importance = validate($_POST['importance']);
    $date_installation = validate($_POST['date_installation']);

    // Perform server-side validation
    if (empty($id_point_eau ) || empty($profondeur) || empty($nature) || empty($cout_installation) || empty($profondeur) || empty($nature) || empty($localisation) || empty($importance)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE point_eau 
            SET profondeur = :profondeur,
                nature = :nature,
                cout_installation = :cout_installation,
                localisation = :localisation,
                importance = :importance,
                date_installation = :date_installation
            WHERE id_point_eau  = :id_point_eau"; // Change 'id_point_eau ' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the primary key 'id_point_eau ' for the record to update
                $params = [
                    ':profondeur' => $profondeur,
                    ':nature' => $nature,
                    ':cout_installation' => $cout_installation,
                    ':localisation' => $localisation,
                    ':importance' => $importance,
                    ':date_installation' => $date_installation,
                    ':id_point_eau' => $id_point_eau  // Replace with the actual 'id_point_eau ' value you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../point_eau.php?message=Data updated successfully!");
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

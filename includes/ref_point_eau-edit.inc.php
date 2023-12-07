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

    $id_ref_point_eau  = validate($_POST['id_ref_point_eau ']);
    $date_refection = validate($_POST['date_refection']);
    $executeur = validate($_POST['executeur']);
    $cout_amengt = validate($_POST['cout_amengt']);
    $id_pointeau = validate($_POST['id_pointeau']);
    $nom_point_eau = validate($_POST['nom_point_eau']);




    $id_point_eau = '';
    $profondeur = '';
    $nature = '';
    $cout_installation = '';
    $localisation = '';
    $importance = '';
    $date_installation = '';
    

    // Perform server-side validation
    if (empty($id_ref_point_eau ) || empty($date_refection) || empty($executeur) || empty($cout_amengt) || empty($date_refection) || empty($executeur)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE ref_point_eau 
            SET date_refection = :date_refection,
                executeur = :executeur,
                cout_amengt = :cout_amengt,
                id_pointeau = :id_pointeau,
                nom_point_eau = :nom_point_eau
            WHERE id_ref_point_eau  = :id_ref_point_eau "; // Change 'id_ref_point_eau ' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the primary key 'id_ref_point_eau ' for the record to update
                $params = [
                    ':date_refection' => $date_refection,
                    ':executeur' => $executeur,
                    ':cout_amengt' => $cout_amengt,
                    ':id_pointeau' => $id_pointeau,
                    ':nom_point_eau' => $nom_point_eau,
                
                    ':id_ref_point_eau' => $id_ref_point_eau  // Replace with the actual 'id_ref_point_eau ' value you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../ref_point_eau.php?message=Data updated successfully!");
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

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

    $id_ref_amengt_tour  = validate($_POST['id_ref_amengt_tour']);
    $date_refection = validate($_POST['date_refection']);
    $responsable = validate($_POST['responsable']);
    $cout_amengt = validate($_POST['cout_amengt']);
    $nature = validate($_POST['nature']);
    $nom_amenagementtour = validate($_POST['nom_amenagementtour']);



    // Perform server-side validation
    if (empty($id_ref_amengt_tour ) || empty($date_refection) || empty($responsable) || empty($cout_amengt) || empty($date_refection) || empty($responsable)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE ref_amenagement_touristique 
            SET date_refection = :date_refection,
                responsable = :responsable,
                cout_amengt = :cout_amengt,
                nature = :nature,
                nom_amenagementtour = :nom_amenagementtour
            WHERE id_ref_amengt_tour  = :id_ref_amengt_tour"; // Change 'id_ref_amengt_tour ' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the primary key 'id_ref_amengt_tour ' for the record to update
                $params = [
                    ':date_refection' => $date_refection,
                    ':responsable' => $responsable,
                    ':cout_amengt' => $cout_amengt,
                    ':nature' => $nature,
                    ':nom_amenagementtour' => $nom_amenagementtour,
                
                    ':id_ref_amengt_tour' => $id_ref_amengt_tour  // Replace with the actual 'id_ref_amengt_tour ' value you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../ref_amenagementtouristique.php?message=Data updated successfully!");
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

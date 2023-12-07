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

    $id_refection_piste  = validate($_POST['id_refection_piste']);
    $nom_piste = validate($_POST['nom_piste']);
    $date_refection = validate($_POST['date_refection']);
    $executeur = validate($_POST['executeur']);
    $cout_amengt = validate($_POST['cout_amengt']);
    $etat = validate($_POST['etat']);



    // Perform server-side validation
    if (empty($id_refection_piste ) || empty($nom_piste) || empty($date_refection) || empty($executeur) || empty($nom_piste) || empty($date_refection)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE ref_point_eau 
        SET nom_piste = :nom_piste,
            date_refection = :date_refection,
            executeur = :executeur,
            cout_amengt = :cout_amengt,
            etat = :etat
        WHERE id_refection_piste = :id_refection_piste"; // Remove the comma before WHERE

            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the primary key 'id_refection_piste ' for the record to update
                $params = [
                    ':nom_piste' => $nom_piste,
                    ':date_refection' => $date_refection,
                    ':executeur' => $executeur,
                    ':cout_amengt' => $cout_amengt,
                    ':etat' => $etat,
                    ':id_refection_piste' => $id_refection_piste  // Replace with the actual 'id_refection_piste ' value you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../refection_pistes.php?message=Data updated successfully!");
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

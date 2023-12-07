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
    $id_ref_point_eau = isset($_POST['id_ref_point_eau']) ? validate($_POST['id_ref_point_eau']) : '';
    $nom_point_eau = isset($_POST['nom_point_eau']) ? validate($_POST['nom_point_eau']) : '';
    $date_refection = validate($_POST['date_refection']);
    $executeur = validate($_POST['executeur']);
    $cout_amengt = validate($_POST['cout_amengt']);
   
    
    $text = ''; // Initialize $text variable
    
    // Check if the $id_ref_point_eau contains at least two elements
    if (strpos($id_ref_point_eau, '|') !== false) {
        $tab = explode('|', $id_ref_point_eau);
        $text = $tab[1];
    }

    // Perform server-side validation
    if (empty($date_refection) || empty($executeur) || empty($cout_amengt)) {
        $error_message = "Veuillez saisir des données dans tous les champs!";
    } else {
        try {
                // If the point_eau record is found, proceed with the ref_point_eau insertion
                $query = "INSERT INTO ref_point_eau (id_ref_point_eau, date_refection, executeur, cout_amengt, nom_point_eau)
                     VALUES (:id_ref_point_eau, :date_refection, :executeur, :cout_amengt, :nom_point_eau)";

                $stmt = $pdo->prepare($query);

                $params = [
                    ':id_ref_point_eau' =>$nom_point_eau,
                    ':date_refection' => $date_refection,
                    ':executeur' => $executeur,
                    ':cout_amengt' => $cout_amengt,
                    ':nom_point_eau' => $text
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    // Data inserted successfully
                    header("Location: ../ref_point_eau.php?message=Data inserted successfully!");
                    exit();
                } else {
                    $error_message = "Error: " . $stmt->errorInfo()[2];
             
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

        // Close the database connection (optional if your script ends here)
        // $pdo = null;
}
?>

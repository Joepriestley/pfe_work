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
    $id_refection =Validate($_POST['id_refection']);
    $date_refection = validate($_POST['date_refection']);
    $nature = validate($_POST['nature']);
    $etat = validate($_POST['etat']);
    $executeur = validate($_POST['executeur']);
    $coutamengt = validate($_POST['coutamengt']);
    $nom_cloture =Validate($_POST['nom_cloture']);
   
    $tab= explode('|', $id_refection);

    $text = $tab[1];

    // Perform server-side validation
    if (empty($date_refection) || empty($executeur) || empty($coutamengt)) {
        $error_message = "Veuillez saisir des données dans tous les champs!";
    } else {
        try {
                // If the point_eau record is found, proceed with the ref_point_eau insertion
                $query = "INSERT INTO refection_cloture (id_refection, date_refection, executeur, nature, etat, coutamengt, nom_cloture)
                     VALUES (:id_refection, :date_refection, :executeur, :nature,:etat, :coutamengt, :nom_cloture)";

                $stmt = $pdo->prepare($query);

                $params = [
                    ':id_refection' =>$nom_cloture,
                    ':date_refection' => $date_refection,
                    ':executeur' => $executeur,
                    ':nature' => $nature,
                    ':etat' => $etat,
                    ':coutamengt' => $coutamengt,
                    ':nom_cloture' => $text
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    // Data inserted successfully
                    header("Location: ../refection_cloture.php?message=Data inserted successfully!");
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

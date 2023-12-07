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
    $id_refection_piste =Validate($_POST['id_refection_piste']);
    $nom_piste =Validate($_POST['nom_piste']);
    $date_refection = validate($_POST['date_refection']);
    $executeur = validate($_POST['executeur']);
    $cout_amengt = validate($_POST['cout_amengt']);
    $etat = validate($_POST['etat']);

   
    $tab= explode('|', $id_refection_piste);

    $text = $tab[1];

    // Perform server-side validation
    if (empty($date_refection) || empty($executeur) || empty($cout_amengt)) {
        $error_message = "Veuillez saisir des données dans tous les champs!";
    } else {
        try {
                // If the point_eau record is found, proceed with the ref_point_eau insertion
                $query = "INSERT INTO refection_pistes (id_refection_piste, date_refection, executeur, cout_amengt, nom_piste,etat)
                     VALUES (:id_refection_piste, :date_refection, :executeur, :cout_amengt, :nom_piste,:etat)";

                $stmt = $pdo->prepare($query);

                $params = [
                    ':id_refection_piste' =>$nom_piste,
                    ':date_refection' => $date_refection,
                    ':executeur' => $executeur,
                    ':cout_amengt' => $cout_amengt,
                    ':nom_piste' => $text,
                    ':etat' => $etat,
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    // Data inserted successfully
                    header("Location: ../refection_pistes.php?message=Data inserted successfully!");
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

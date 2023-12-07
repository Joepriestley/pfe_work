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
    $id_ref_amengt_tour =Validate($_POST['id_ref_amengt_tour']);
    $nom_amenagementtour =Validate($_POST['nom_amenagementtour']);
    $date_refection = validate($_POST['date_refection']);
    $nature = validate($_POST['nature']);
    $responsable = validate($_POST['responsable']);
    $cout_amengt = validate($_POST['cout_amengt']);
   
    $tab= explode('|', $id_ref_amengt_tour);

    $text = $tab[1];

    // Perform server-side validation
    if (empty($date_refection) || empty($responsable) || empty($cout_amengt)) {
        $error_message = "Veuillez saisir des données dans tous les champs!";
    } else {
        try {
                // If the point_eau record is found, proceed with the ref_point_eau insertion
                $query = "INSERT INTO ref_amenagement_touristique (id_ref_amengt_tour, date_refection, responsable,nature, cout_amengt, nom_amenagementtour)
                     VALUES (:id_ref_amengt_tour, :date_refection, :responsable,:nature, :cout_amengt, :nom_amenagementtour)";

                $stmt = $pdo->prepare($query);

                $params = [
                    ':id_ref_amengt_tour' =>$nom_amenagementtour,
                    ':date_refection' => $date_refection,
                    ':responsable' => $responsable,
                    ':nature' => $nature,
                    ':cout_amengt' => $cout_amengt,
                    ':nom_amenagementtour' => $text
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    // Data inserted successfully
                    header("Location: ../ref_amenagementtouristique.php?message=Data inserted successfully!");
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

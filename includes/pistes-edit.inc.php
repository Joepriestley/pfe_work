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

    $id_piste = validate($_POST['id_piste']);
    $longueur = validate($_POST['longueur']);
    $cout_amengt = validate($_POST['cout_amengt']);
    $accessibilite = validate($_POST['accessibilite']);
    $dateouverture = validate($_POST['dateouverture']);
    $id_amengt = validate($_POST['id_amengt']);
    $_nom_piste = validate($_POST['_nom_piste']);
    
    // Perform server-side validation
    if (empty($id_piste) || empty($longueur) || empty($cout_amengt) || empty($accessibilite) || empty($dateouverture)|| empty($id_amengt)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE pistes 
            SET id_piste = :id_piste,
                longueur = :longueur,
                cout_amengt = :cout_amengt,
                accessibilite = :accessibilite,
                dateouverture = :dateouverture,
                id_amengt = :id_amengt
                _nom_piste = :_nom_piste
            WHERE id_piste = :idToUpdate"; // Change 'id_piste' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':id_piste' => $id_piste,
                    ':longueur' => $longueur,
                    ':cout_amengt' => $cout_amengt,
                    ':accessibilite' => $accessibilite,
                    ':dateouverture' => $dateouverture,
                    ':id_amengt' => $id_amengt,
                    ':_nom_piste' => $_nom_piste,
                    ':idToUpdate' => $id_piste // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../pistes.php?message=Data updated successfully!");
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

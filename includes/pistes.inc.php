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
    if (empty($id_piste) || empty($longueur) || empty($cout_amengt) || empty($accessibilite)|| empty($dateouverture)|| empty($id_amengt)) {
            header("Location: ../pistes.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO pistes (id_piste,longueur,cout_amengt,accessibilite,dateouverture,id_amengt,_nom_piste)
                     VALUES (:id_piste, :longueur,:cout_amengt,:accessibilite,:dateouverture,:id_amengt,:_nom_piste)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':id_piste' => $id_piste,
                    ':longueur' => $longueur,
                    ':cout_amengt' => $cout_amengt,
                    ':accessibilite' => $accessibilite,
                    ':dateouverture' => $dateouverture,
                    ':id_amengt' => $id_amengt,
                    ':_nom_piste' => $_nom_piste
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../pistes.php?message=Data inserted successfully!");
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

    // Close the database connection (optional if your script ends here)
    // $pdo = null;
}
?>



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

    $date_refection = validate($_POST['date_refection']);
    $executeur = validate($_POST['executeur']);
    $cout_amengt = validate($_POST['cout_amengt']);


    //function to retrieve from the point_eau table 
    function fetchpointEauDataFromDatabase(){
        $pdo = require_once 'dbConnect.php'; 
        
    $query1 = "SELECT id_point_eau, nom_point_eau FROM point_eau WHERE id_point_eau =:id_point_eau AND nom_point_eau= :nom_point_eau"; // Your SQL query here

    // Prepare and execute the query to retrieve the id and name
    $stmt = $pdo->prepare($query1);
    $stmt->execute();

    // Fetch and return the result (the point_eau's ID and name)
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result;
    } else {
        return null; // Handle the case where the point_eau data is not found
    }

    }

    // Fetch both the 'id_point_eau' and 'nom_point_eau' from the 'point_eau' table
    $point_eauData = fetchpointEauDataFromDatabase(); // Modify this line

    if ($point_eauData) {
        $id_point_eau = $point_eauData['id_point_eau'];
        $nom_point_eau = $point_eauData['nom_point_eau'];
    } else {
        // Handle the case where the point_eau data is not found
        $error_message = "point_eau data not found.";
    }

    // Continue with the data insertion
    if (empty($date_refection) || empty($executeur) || empty($cout_amengt)) {
        $error_message = "Veuillez saisir des données dans tous les champs!";
    } else {
        try {
            // Prepare the SQL query for inserting into 'repair_point_eau'
            $query = "INSERT INTO ref_point_eau (id_ref_point_eau, date_refection, executeur, cout_amengt, nom_point_eau)
                     VALUES (:id_ref_point_eau, :date_refection, :executeur, :cout_amengt, :nom_point_eau)";

            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':id_ref_point_eau' => $id_point_eau,
                    ':date_refection' => $date_refection,
                    ':executeur' => $executeur,
                    ':cout_amengt' => $cout_amengt,
                    ':nom_point_eau' => $nom_point_eau,
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    // Data inserted successfully
                    header("Location: ../ref_point_eau.php?message=Data inserted successfully!");
                    exit();
                } else {
                    $error_message = "Error: " . $stmt->errorInfo()[2];
                }
            } else {
                $error_message = "Error preparing statement.";
            }
        } catch (PDOException $e) {
            $error_message = "Error: " . $e->getMessage();
        }
    }

    // Close the database connection (optional if your script ends here)
    // $pdo = null;
}

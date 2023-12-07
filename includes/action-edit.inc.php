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

    $id_action = validate($_POST['id_action']);
    $duree = validate($_POST['duree']);
    $lieu = validate($_POST['lieu']);
    $commentaire = validate($_POST['commentaire']);
    $id_projet = validate($_POST['id_projet']);
    // Perform server-side validation
    if (empty($id_action) || empty($duree) || empty($lieu) || empty($commentaire) || empty($id_projet)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE actions
            SET duree = :duree,
                lieu = :lieu,
                commentaire = :commentaire,
                id_projet = :id_projet
            WHERE id_action = :id_action"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':duree' => $duree,
                    ':lieu' => $lieu,
                    ':commentaire' => $commentaire,
                    ':id_projet' => $id_projet,
                    ':id_action' => $id_action // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../action.php?message=Data updated successfully!");
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

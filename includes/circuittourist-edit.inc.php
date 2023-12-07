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

    $nomcircuit = validate($_POST['nomcircuit']);
    $categoriecircuit = validate($_POST['categoriecircuit']);
    $longeur = validate($_POST['longeur']);
    $pointdepart = validate($_POST['pointdepart']);
    $pointarrivee  = validate($_POST['pointarrivee']);
    $commentaire  = validate($_POST['commentaire']);
    $id_douar = validate($_POST['id_douar']);
    $nomsite  = validate($_POST['nomsite']);
    // Perform server-side validation
    if (empty($nomcircuit) || empty($categoriecircuit) || empty($longeur) || empty($pointdepart) || empty($pointarrivee ) || empty($commentaire )|| empty($id_douar)|| empty($nomsite)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE circuit_touristique 
            SET categoriecircuit = :categoriecircuit,
                longeur = :longeur,
                pointdepart = :pointdepart,
                pointarrivee = :pointarrivee ,
                commentaire = :commentaire, 
                id_douar = :id_douar, 
                nomsite = :nomsite 
            WHERE nomcircuit = :nomcircuit"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':categoriecircuit' => $categoriecircuit,
                    ':longeur' => $longeur,
                    ':pointdepart' => $pointdepart,
                    ':pointarrivee' => $pointarrivee ,
                    ':commentaire' => $commentaire,
                    ':id_douar' => $id_douar,
                    ':nomsite' => $nomsite,
                    ':nomcircuit' => $nomcircuit // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../circuittourist.php?message=Les mises a jour faite avec success!");
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

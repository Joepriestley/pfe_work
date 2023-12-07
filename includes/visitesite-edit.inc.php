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

    $datevisite = validate($_POST['datevisite']);
    $duree = validate($_POST['duree']);
    $visiteengroupe = validate($_POST['visiteengroupe']);
    $id_sitetouristique = validate($_POST['id_sitetouristique']);
    $id_touriste = validate($_POST['id_touriste']);

    // Perform server-side validation
    if (empty($datevisite) || empty($duree) || empty($visiteengroupe) || empty($id_sitetouristique) || empty($id_touriste)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE visitesite 
                      SET duree = :duree,
                          visiteengroupe = :visiteengroupe
                      WHERE id_sitetouristique = :id_sitetouristique
                      AND id_touriste = :id_touriste";
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the primary key columns
                $params = [
                    ':duree' => $duree,
                    ':visiteengroupe' => $visiteengroupe,
                    ':id_sitetouristique' => $id_sitetouristique,
                    ':id_touriste' => $id_touriste
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../visitesite.php?message=Data updated successfully!");
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

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

    $dateutilisation = validate($_POST['dateutilisation']);
    $duree = validate($_POST['duree']);
    $appreciation = validate($_POST['appreciation']);
    $id_infrastructure = validate($_POST['id_infrastructure']);
    $id_touriste = validate($_POST['id_touriste']);

    // Perform server-side validation
    if (empty($dateutilisation) || empty($duree) || empty($appreciation) || empty($id_infrastructure) || empty($id_touriste)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE utilisation 
                      SET duree = :duree,
                          appreciation = :appreciation
                      WHERE id_infrastructure = :id_infrastructure
                      AND id_touriste = :id_touriste";
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the primary key columns
                $params = [
                    ':duree' => $duree,
                    ':appreciation' => $appreciation,
                    ':id_infrastructure' => $id_infrastructure,
                    ':id_touriste' => $id_touriste
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../utilisation.php?message=Data updated successfully!");
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

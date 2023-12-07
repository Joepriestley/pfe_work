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

    $codeamenagement = validate($_POST['codeamenagement']);
    // $coutamenagement = validate($_POST['coutamenagement']);
    $element_amenage = validate($_POST['element_amenage']);
    $commentaire = validate($_POST['commentaire']);

    // Perform server-side validation
    if (empty($commentaire)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE amenagement  
            SET codeamenagement = :codeamenagement,
                element_amenage = :element_amenage,
                commentaire = :commentaire
               
            WHERE codeamenagement = :codeamenagement"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    'element_amenage' => $element_amenage,
                    ':commentaire' => $commentaire,
                    ':codeamenagement' => $codeamenagement // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../amenagement.php?message=Data updated successfully!");
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

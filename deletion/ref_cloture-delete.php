<?php
// Import your database connection and validation functions if needed
$pdo = require_once '../includes/dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_ref_cloture'])) {
    $id_refection = $_POST['id_refection'];

    try {
        $query = "DELETE FROM refection_cloture WHERE id_refection = :id_refection"; // Change 'id' to the actual primary key field name of your table
        $stmt = $pdo->prepare($query);

        if ($stmt) {
            // Bind parameters including the ID of the record to delete
            $params = [':id_refection' => $id_refection];
            $result = $stmt->execute($params);

            if ($result) {
                
                header("Location: ../refection_cloture.php?message=Record deleted successfully!");
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
?>

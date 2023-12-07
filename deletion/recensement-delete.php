<?php
// Import your database connection and validation functions if needed
$pdo = require_once '../includes/dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_recensement'])) {
    $espece_animale = $_POST['espece_animale'];
    $id_faune_suivi = $_POST['id_faune_suivi'];

    try {
        $query = "DELETE FROM recensement WHERE  espece_animale = :espece_animale AND id_faune_suivi = :id_faune_suivi"; // Change 'id' to the actual primary key field name of your table
        $stmt = $pdo->prepare($query);

        if ($stmt) {
            // Bind parameters including the ID of the record to delete
            $params = [
                ':espece_animale' => $espece_animale,
                ':id_faune_suivi' => $id_faune_suivi];

            $result = $stmt->execute($params);

            if ($result) {
                
                header("Location: ../recensement.php?message=Record deleted successfully!");
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
<?php
// Import your database connection and validation functions if needed
$pdo = require_once '../includes/dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_suivi_faune'])) {
    $id_suivi = $_POST['id_suivi'];

    try {
        $query = "DELETE FROM suivi_faune WHERE id_suivi = :id_suivi"; // Change 'id' to the actual primary key field name of your table
        $stmt = $pdo->prepare($query);

        if ($stmt) {
            // Bind parameters including the ID of the record to delete
            $params = [':id_suivi' => $id_suivi];
            $result = $stmt->execute($params);

            if ($result) {
                
                header("Location: ../suivi_faune.php?message=Record deleted successfully!");
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


<?php
// Import your database connection and validation functions if needed
$pdo = require_once '../includes/dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_partenaire'])) {
    $nompartenaire = $_POST['nompartenaire'];

    try {
        $query = "DELETE FROM partenaire WHERE nompartenaire = :nompartenaire"; // Change 'id' to the actual primary key field name of your table
        $stmt = $pdo->prepare($query);

        if ($stmt) {
            // Bind parameters including the ID of the record to delete
            $params = [':nompartenaire' => $nompartenaire];
            $result = $stmt->execute($params);

            if ($result) {
                
                header("Location: ../partenaire.php?message=Record deleted successfully!");
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

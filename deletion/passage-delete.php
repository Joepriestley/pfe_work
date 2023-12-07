<?php
// Import your database connection and validation functions if needed
$pdo = require_once '../includes/dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_passage'])) {
    $datepassage = $_POST['datepassage'];

    try {
        $query = "DELETE FROM passe WHERE datepassage = :datepassage"; // Change 'datepassage' to the actual primary key field name of your table
        $stmt = $pdo->prepare($query);

        if ($stmt) {
            // Bind parameters including the datepassage of the record to delete
            $params = [':datepassage' => $datepassage];
            $result = $stmt->execute($params);

            if ($result) {
                header("Location: ../passage.php?message=Record deleted successfully!");
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

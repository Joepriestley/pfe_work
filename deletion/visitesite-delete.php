<?php
// Import your database connection and validation functions if needed
$pdo = require_once '../includes/dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_recensement'])) {
    $id_sitetouristique = $_POST['id_sitetouristique'];
    $id_touriste = $_POST['id_touriste'];

    try {
        $query = "DELETE FROM visitesite WHERE  id_sitetouristique = :id_sitetouristique AND id_touriste = :id_touriste"; // Change 'id' to the actual primary key field name of your table
        $stmt = $pdo->prepare($query);

        if ($stmt) {
            // Bind parameters including the ID of the record to delete
            $params = [
                ':id_sitetouristique' => $id_sitetouristique,
                ':id_touriste' => $id_touriste];

            $result = $stmt->execute($params);

            if ($result) {
                
                header("Location: ../visitesite.php?message=Record deleted successfully!");
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
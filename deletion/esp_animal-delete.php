<?php
$pdo = require_once '../includes/dbConnect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_animal'])) {
    $nomscientifique = $_POST['nomscientifique']; // Get the ID or unique identifier of the record to delete

    try {
        // First, fetch the image file path for the record you're deleting
        $imageFilePath = ""; // Modify this to match the location and naming convention of your image files
        $query = "SELECT photo FROM espece_animale WHERE nomscientifique = :nomscientifique";
        $stmt = $pdo->prepare($query);

        if ($stmt) {
            $params = [':nomscientifique' => $nomscientifique];
            $stmt->execute($params);
            $imageData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($imageData && !empty($imageData['photo'])) {
                // Construct the full image file path based on your file naming convention
                $imageFilePath = "../includes/savedImage" . $imageData['photo'];
            }
        }

        // Delete the record from the database
        $deleteQuery = "DELETE FROM espece_animale WHERE nomscientifique = :nomscientifique";
        $stmt = $pdo->prepare($deleteQuery);

        if ($stmt) {
            $params = [':nomscientifique' => $nomscientifique];
            $result = $stmt->execute($params);

            if ($result) {
                // If the record is deleted successfully, also delete the associated image
                if (file_exists($imageFilePath)) {
                    unlink($imageFilePath); // Delete the image file
                }

                header("Location: ../esp_animal.php?message=Record deleted successfully!");
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

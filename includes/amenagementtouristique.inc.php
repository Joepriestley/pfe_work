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

    $id_amengttour = validate($_POST['id_amengttour']);
    $responsable = validate($_POST['responsable']);
    $cout_creaction = validate($_POST['cout_creaction']);
    $periode = validate($_POST['periode']);
    $date_cree = validate($_POST['date_cree']);
    

    // Perform server-side validation
    if (empty($id_amengttour) || empty($type) || empty($responsable) || empty($cout_creaction) ||empty($periode)) {
            header("Location: ../amenagementtouristique.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO amenagement_touristiques ( cout_creaction, id_amengttour,responsable,periode,date_cree)
                     VALUES (:etatelement, :cout_creaction, :id_amengttour,:responsable,:periode,:date_cree";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':id_amengttour' => $id_amengttour,
                    ':responsable' => $responsable,
                    ':periode' => $periode,
                    ':cout_creaction' => $cout_creaction,
                    ':date_cree' => $date_cree
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../amenagementtouristique.php?message=Les mises a jour faites avec success!");
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

    // Close the database connection (optional if your script ends here)
    // $pdo = null;
}
?>



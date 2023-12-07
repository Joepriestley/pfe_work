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
        
            $datepassage = validate($_POST['datepassage']);
            $duree = validate($_POST['duree']);
            $en_groupe = validate($_POST['en_groupe']);
            $id_touriste = validate($_POST['id_touriste']);
            $id_circuittour = validate($_POST['id_circuittour']);
        
            // Perform server-side validation
            if (empty($datepassage) || empty($duree) || empty($en_groupe) || empty($id_touriste) || empty($id_circuittour)) {
                echo "Please fill in all fields.";
            } else {
                try {
                    $query = "UPDATE passe 
                    SET duree = :duree,
                        en_groupe = :en_groupe,
                        id_touriste = :id_touriste,
                        id_circuittour = :id_circuittour
                    WHERE datepassage = :idToUpdate"; // Change 'id' to the actual primary key field name of your table
        
                    $stmt = $pdo->prepare($query);
        
                    if ($stmt) {
                        // Bind parameters including the ID of the record to update
                        $params = [
                            ':duree' => $duree,
                            ':en_groupe' => $en_groupe,
                            ':id_touriste' => $id_touriste,
                            ':id_circuittour' => $id_circuittour,
                            ':idToUpdate' => $datepassage // Replace with the actual ID you want to update
                        ];
        
                        $result = $stmt->execute($params);
        
                        if ($result) {
                            header("Location: ../passage.php?message=Data updated successfully!");
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
        
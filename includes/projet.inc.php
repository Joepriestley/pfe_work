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

    $codeprojet = validate($_POST['codeprojet']);
    $nomprojet = validate($_POST['nomprojet']);
    $objectif = validate($_POST['objectif']);
    $datedebut = validate($_POST['datedebut']);
    $duree = validate($_POST['duree']);
    $budget = validate($_POST['budget']);
    $categoriepayment = validate($_POST['categoriepayment']);
    $commentaire = validate($_POST['commentaire']);
    $id_association = validate($_POST['id_association']);
   
    
    

    // Perform server-side validation
    if (empty($codeprojet) || empty($nomprojet) || empty($objectif) || empty($datedebut) || empty($duree) || empty($budget)|| empty($categoriepayment)|| empty($commentaire)|| empty($id_association)) {
            header("Location: ../projet.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO projet (codeprojet, nomprojet,objectif,datedebut, duree,budget,categoriepayment,commentaire,id_association)
                     VALUES (:codeprojet, :nomprojet, :objectif,:datedebut, :duree,:budget,:categoriepayment,:commentaire,:id_association)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':codeprojet' => $codeprojet,
                    ':nomprojet' => $nomprojet,
                    ':objectif' => $objectif,
                    ':datedebut' => $datedebut,
                    ':duree' =>$duree,
                    ':budget' => $budget,
                    ':categoriepayment' => $categoriepayment,
                    ':commentaire' => $commentaire,
                    ':id_association' => $id_association,
                   
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../projet.php?message=Data inserted successfully!");
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



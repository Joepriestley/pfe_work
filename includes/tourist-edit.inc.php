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

    $numerocin_passport = validate($_POST['numerocin_passport']);
    $nomtouriste = validate($_POST['nomtouriste']);
    $nationalite = validate($_POST['nationalite']);
    $motivation = validate($_POST['motivation']);
    $age = validate($_POST['age']);
    $sexe = validate($_POST['sexe']);
    $fonction = validate($_POST['fonction']);
    $telephone = validate($_POST['telephone']);
    $adresse = validate($_POST['adresse']);
    $date_visite = validate($_POST['date_visite']);
    $prenom = validate($_POST['prenom']);
    // Perform server-side validation
    if (empty($numerocin_passport) || empty($nomtouriste) || empty($nationalite) || empty($motivation) 
    || empty($age) || empty($sexe) || empty($fonction)|| empty($telephone) || empty($adresse) || empty($prenom)){
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE touristes
            SET nomtouriste = :nomtouriste,
                nationalite = :nationalite,
                motivation = :motivation,
                age = :age,
                sexe = :sexe,
                fonction = :fonction,
                telephone = :telephone,
                adresse = :adresse,
                date_visite = :date_visite,
                prenom = :prenom               
            WHERE numerocin_passport = :numerocin_passport"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':nomtouriste' => $nomtouriste,
                    ':nationalite' => $nationalite,
                    ':motivation' => $motivation,
                    ':age' => $age,
                    ':sexe' => $sexe,
                    ':fonction' => $fonction,
                    ':telephone' => $telephone,
                    ':adresse' => $adresse,
                    ':date_visite' => $date_visite,
                    ':prenom' => $prenom,
                    ':numerocin_passport' => $numerocin_passport // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../touriste.php?message=Les mises a jour faite avec succes!!");
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

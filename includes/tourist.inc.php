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
    $prenom = validate($_POST['prenom']);
    $date_visite = validate($_POST['date_visite']);

    // Perform server-side validation
    if (empty($numerocin_passport) || empty($nomtouriste) || empty($nationalite) || empty($motivation) || empty($age) || empty($sexe) || empty($fonction)
        || empty($telephone) || empty($adresse) || empty($prenom)) {
        echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO touristes (numerocin_passport, nomtouriste, nationalite, motivation, age, sexe, fonction, telephone, adresse, prenom, date_visite)
                     VALUES (:numerocin_passport, :nomtouriste, :nationalite, :motivation, :age, :sexe, :fonction, :telephone, :adresse, :prenom, :date_visite)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':numerocin_passport' => $numerocin_passport,
                    ':nomtouriste' => $nomtouriste,
                    ':nationalite' => $nationalite,
                    ':motivation' => $motivation,
                    ':age' => $age,
                    ':sexe' => $sexe,
                    ':fonction' => $fonction,
                    ':telephone' => $telephone,
                    ':adresse' => $adresse,
                    ':prenom' => $prenom,
                    ':date_visite' => $date_visite
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../touriste.php?message=Data inserted successfully!");
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



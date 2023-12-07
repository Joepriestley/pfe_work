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

    $nompartenaire = validate($_POST['nompartenaire']);
    $nationalite = validate($_POST['nationalite']);
    $responsable = validate($_POST['responsable']);
    $adresse = validate($_POST['adresse']);
    $telephone = validate($_POST['telephone']);
    $objectifpartenariat = validate($_POST['objectifpartenariat']);
    $datesignpart = validate($_POST['datesignpart']);
    $fax = validate($_POST['fax']);
    

    // Perform server-side validation
    if (empty($nompartenaire) || empty($nationalite) || empty($responsable) || empty($adresse) || empty($telephone) || empty($objectifpartenariat) || empty($datesignpart)
        || empty($fax)) {
            header("Location: ../partenaire.php?message=Veuillez saisir des donnees dans tous les champs!");
            exit();
        // echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO partenaire (nompartenaire, nationalite, responsable, adresse, telephone, objectifpartenariat, datesignpart, fax)
                     VALUES (:nompartenaire, :nationalite, :responsable, :adresse, :telephone, :objectifpartenariat, :datesignpart, :fax)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':nompartenaire' => $nompartenaire,
                    ':nationalite' => $nationalite,
                    ':responsable' => $responsable,
                    ':adresse' => $adresse,
                    ':telephone' => $telephone,
                    ':objectifpartenariat' => $objectifpartenariat,
                    ':datesignpart' => $datesignpart,
                    ':fax' => $fax,
                    
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../partenaire.php?message=Data inserted successfully!");
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



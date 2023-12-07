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
    $responsable = validate($_POST['responsable']); // Removed the space here
    $adresse = validate($_POST['adresse']);
    $telephone = validate($_POST['telephone']);
    $objectifpartenariat = validate($_POST['objectifpartenariat']);
    $datesignpart = validate($_POST['datesignpart']);
    $fax = validate($_POST['fax']);

    // Perform server-side validation
    if (empty($nompartenaire) || empty($nationalite) || empty($responsable) || empty($adresse) || empty($telephone) || empty($datesignpart) || empty($fax)) {
        echo "Please fill in all fields.";
    } else {
        try {
            $query = "UPDATE partenaire 
            SET nationalite = :nationalite,
                responsable = :responsable,
                adresse = :adresse,
                telephone = :telephone,
                objectifpartenariat = :objectifpartenariat,
                datesignpart = :datesignpart,
                fax = :fax
            WHERE nompartenaire = :idToUpdate"; // Change 'id' to the actual primary key field name of your table
            
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters including the ID of the record to update
                $params = [
                    ':nationalite' => $nationalite,
                    ':responsable' => $responsable,
                    ':adresse' => $adresse,
                    ':telephone' => $telephone,
                    ':objectifpartenariat' => $objectifpartenariat,
                    ':datesignpart' => $datesignpart,
                    ':fax' => $fax,
                    ':idToUpdate' => $nompartenaire // Replace with the actual ID you want to update
                ];
                
                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../partenaire.php?message=Data updated successfully!");
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

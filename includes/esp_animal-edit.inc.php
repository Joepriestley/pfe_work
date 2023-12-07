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

    $nomscientifique = validate($_POST['nomscientifique']);
    $nomfrancais = validate($_POST['nomfrancais']);
    $famille = validate($_POST['famille']);
    $statutsocial = validate($_POST['statutsocial']);
    $sedentaire = validate($_POST['sedentaire']);
    $regimealimentaire = validate($_POST['regimealimentaire']);
    $periodereproduction = validate($_POST['periodereproduction']);
    $tailleportee = validate($_POST['tailleportee']);
    $nombreportee_an = validate($_POST['nombreportee_an']);
    $commentaire = validate($_POST['commentaire']);
    
    $path = 'includes/';
    $uploadDir = 'savedImage/';
    $imageFileName = basename($_FILES['photo']['name']);

    // Check if a file was uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK){
        $imageDir = 'savedImage/'; // Specify the directory where you want to save images
        $targetFile = $imageDir . basename($_FILES['photo']['name']);

        // Check if the file already exists and handle duplicates if necessary
        if (file_exists($targetFile)) {
            $fileName = pathinfo($targetFile, PATHINFO_FILENAME);
            $fileExtension = pathinfo($targetFile, PATHINFO_EXTENSION);
            $counter = 1;

            while (file_exists($targetFile)) {
                $newFileName = $fileName . '_' . $counter . '.' . $fileExtension;
                $targetFile = $imageDir . $newFileName;
                $counter++;
            }
        }

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
            // File was successfully uploaded, you can save the file path or other relevant data in your database
            // Insert your database insertion code here
            $photoPath = $targetFile;
        } else {
            echo "Failed to upload the image.";
            exit();
        }
    }
    // Perform server-side validation
    if (empty($nomscientifique) || empty($nomfrancais) || empty($periodereproduction) || empty($tailleportee)) {
        echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "UPDATE espece_animale
            SET nomfrancais = :nomfrancais,
                famille = :famille,
                statutsocial = :statutsocial,
                sedentaire = :sedentaire,
                regimealimentaire = :regimealimentaire,
                periodereproduction = :periodereproduction,
                tailleportee = :tailleportee,
                nombreportee_an = :nombreportee_an,
                commentaire = :commentaire,
                photo = :photo
                WHERE nomscientifique = :nomscientifique";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':nomfrancais' => $nomfrancais,
                    ':famille' => $famille,
                    ':statutsocial' => $statutsocial,
                    ':sedentaire' => $sedentaire,
                    ':regimealimentaire' => $regimealimentaire,
                    ':periodereproduction' => $periodereproduction,
                    ':tailleportee' => $tailleportee,
                    ':nombreportee_an' => $nombreportee_an,
                    ':commentaire' => $commentaire,
                    ':photo' => $path . $uploadDir . $imageFileName,
                    ':nomscientifique' => $nomscientifique,
                ];

                $result = $stmt->execute($params);

                if ($result) {
                    header("Location: ../esp_animal.php?message=Les mises a jour faite avec succes!");
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

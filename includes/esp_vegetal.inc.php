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
    $nomvernaculaire = validate($_POST['nomvernaculaire']);
    $famille = validate($_POST['famille']);
    $ordre = validate($_POST['ordre']);
    $categorie = validate($_POST['categorie']);
    $milieuvie = validate($_POST['milieuvie']);
    $modreproduction = validate($_POST['modreproduction']);
    $id_sol = validate($_POST['id_sol']);
    $id_bioclimat = validate($_POST['id_bioclimat']);
    $commentaire = validate($_POST['commentaire']);

    $path = './includes/';
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
    if (empty($nomscientifique) || empty($nomfrancais) || empty($milieuvie) || empty($modreproduction)) {
        echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO espece_vegetale (nomscientifique, nomfrancais, nomvernaculaire, famille, ordre,categorie, milieuvie, modreproduction, id_sol, id_bioclimat, commentaire, photo) 
                    VALUES (:nomscientifique, :nomfrancais, :nomvernaculaire, :famille, :ordre,:categorie, :milieuvie, :modreproduction, :id_sol, :id_bioclimat, :commentaire, :photo)";
            
            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':nomscientifique' => $nomscientifique,
                    ':nomfrancais' => $nomfrancais,
                    ':nomvernaculaire' => $nomvernaculaire,
                    ':famille' => $famille,
                    ':ordre' => $ordre,
                    ':categorie' => $categorie,
                    ':milieuvie' => $milieuvie,
                    ':modreproduction' => $modreproduction,
                    ':id_sol' => $id_sol,
                    ':id_bioclimat' => $id_bioclimat,
                    ':commentaire' => $commentaire,
                    ':photo' => $path . $uploadDir . $imageFileName
                ];

                $result = $stmt->execute($params);


                 # save espece zone coeur 
     

        foreach($_POST['zcoeurs'] as $zone_name) {
            $query = "INSERT into espece_zone (zone_type, espece_type, espece_name, zone_name)  values (:zone_type, :espece_type, :espece_name, :zone_name)";
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':zone_type' => "zone_coeur",
                    ':espece_type' => "espece_vegetale",
                    ':espece_name' => $nomscientifique,
                    ':zone_name' => $zone_name
                ];
                $result = $stmt->execute($params);

                
            }
        }
# save espece zone adhsion

        foreach($_POST['zadhesions'] as $zone_name) {
            $query = "INSERT into espece_zone (zone_type, espece_type, espece_name, zone_name)  values (:zone_type, :espece_type, :espece_name, :zone_name)";
            $stmt = $pdo->prepare($query);
            
            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':zone_type' => "zone_adhesion",
                    ':espece_type' => "espece_vegetale",
                    ':espece_name' => $nomscientifique,
                    ':zone_name' => $zone_name
                ];

                $result = $stmt->execute($params);

                
            }
        }


                if ($result) {
                    header("Location: ../esp_vegetal.php?message=Data inserted successfully!");
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

<?php
$pdo = require_once 'dbConnect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Server-side data validation
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $element_amenage = validate($_POST['element_amenage']);
    $type = validate($_POST['type']);
    $commentaire = validate($_POST['commentaire']);

    $id_piste = '';
    $longueur = '';
    $cout_creation = '';
    $accessibilite = '';
    $date_creation = '';
    $_nom_piste = '';
  
    $id_point_eau = '';
    $profondeur = '';
    $nature = '';
    $cout_installation = '';
    $localisation = '';
    $importance = '';
    $date_installation = '';
    $nom_point_eau = '';
    

    $type = '';
    $responsable = '';
    $periode = '';
    $cout_creaction = '';
    $date_cree = '';
    $nom_amenagttour = '';


    $id_cloture = '';
    $date_cloture = '';
    $cout_creation = '';
    $nature = '';
    $duree = '';
    $nom_cloture = '';

    // Element selected
    if ($element_amenage === "piste") {
        $id_piste ='';
        $longueur = validate($_POST['longueur']);
        $cout_creation = validate($_POST['cout_creation']);
        $accessibilite = validate($_POST['accessibilite']);
        $date_creation = validate($_POST['date_creation']);
        $date_creation = validate($_POST['date_creation']);
        $_nom_piste = validate($_POST['_nom_piste']);


    } elseif ($element_amenage === "point_eau") {
        $id_point_eau = '';
        $profondeur = validate($_POST['profondeur']);
        $nature = validate($_POST['nature']);
        $cout_installation = validate($_POST['cout_installation']);
        $localisation = validate($_POST['localisation']);
        $importance = validate($_POST['importance']);
        $date_installation = validate($_POST['date_installation']);
        $nom_point_eau = validate($_POST['nom_point_eau']);

    } elseif ($element_amenage === "amenagement_touristique") {
        $id_amengttour ='';
        $type = validate($_POST['type']);
        $responsable = validate($_POST['responsable']);
        $periode = validate($_POST['periode']);
        $cout_creaction = validate($_POST['cout_creaction']);
        $date_cree = validate($_POST['date_cree']);
        $nom_amenagttour = validate($_POST['nom_amenagttour']);

    } elseif ($element_amenage === "cloture") {
        $id_cloture = '';
        $date_cloture = validate($_POST['date_cloture']);
        $cout_creation = validate($_POST['cout_creation']);
        $nature = validate($_POST['nature']);
        $duree = validate($_POST['duree']);
        $nom_cloture = validate($_POST['nom_cloture']);
    }

    $id = '';

    // Perform server-side validation
    if (empty($element_amenage)) {
        echo "Please fill in all fields.";
    } else {
        try {
            // Prepare the SQL query using named placeholders
            $query = "INSERT INTO amenagement (codeamenagement, element_amenage, type, commentaire)
                     VALUES (uuid_generate_v4(), :element_amenage, :type, :commentaire)";

            $stmt = $pdo->prepare($query);

            if ($stmt) {
                // Bind parameters and execute the statement using an associative array
                $params = [
                    ':element_amenage' => $element_amenage,
                    ':type' => $type,
                    ':commentaire' => $commentaire
                ];

                $result = $stmt->execute($params);

                $query1 = "SELECT * FROM amenagement WHERE element_amenage=:element_amenage AND type=:type AND commentaire=:commentaire";
                $stmt1 = $pdo->prepare($query1);
                $params1 = [
                    ':element_amenage' => $element_amenage,
                    ':type' => $type,
                    ':commentaire' => $commentaire
                ];

                $result1 = $stmt1->execute($params1);

                if ($result1) {
                    // Fetch the result set
                    $amg = $stmt1->fetch(PDO::FETCH_ASSOC);

                    if ($amg) {
                        // Access the columns using associative array keys
                        $id = $amg['codeamenagement'];
                        echo $id;
                        // Continue processing or return the $id as needed
                    } else {
                        // No matching record found
                        echo "No matching record found.";
                    }
                } else {
                    // Query execution failed
                    $errorInfo = $stmt1->errorInfo();
                    echo "Error: " . $errorInfo[2];
                }

                if ($element_amenage === 'piste') {
                    try {
                        // Prepare the SQL query using named placeholders
                        $query = "INSERT INTO pistes (id_piste, longueur, cout_creation, accessibilite, date_creation,_nom_piste)
                                     VALUES (:id_piste, :longueur, :cout_creation, :accessibilite, :date_creation,:_nom_piste)";

                        $stmt = $pdo->prepare($query);

                        if ($stmt) {
                            // Bind parameters and execute the statement using an associative array
                            $params = [
                                ':id_piste' => $id,
                                ':longueur' => $longueur,
                                ':cout_creation' => $cout_creation,
                                ':accessibilite' => $accessibilite,
                                ':date_creation' => $date_creation,
                                ':_nom_piste' => $_nom_piste,
                            ];

                            $result = $stmt->execute($params);

                            if ($result) {

                            } else {
                                echo "Error: " . $stmt->errorInfo()[2];
                            }
                        } else {
                            echo "Error preparing statement.";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                } elseif ($element_amenage === 'point_eau') {

                    try {

                        // Prepare the SQL query using named placeholders
                        $query = "INSERT INTO point_eau (id_point_eau, profondeur, nature, cout_installation, localisation, importance,date_installation,nom_point_eau)
                                        VALUES (:id_point_eau, :profondeur, :nature, :cout_installation, :localisation, :importance,:date_installation,:nom_point_eau)";

                        $stmt = $pdo->prepare($query);

                        if ($stmt) {
                            // Bind parameters and execute the statement using an associative array
                            $params = [
                                ':id_point_eau' => $id,
                                ':profondeur' => $profondeur,
                                ':nature' => $nature,
                                ':cout_installation' => $cout_installation,          
                                ':localisation' => $localisation,
                                ':importance' => $importance,
                                ':date_installation' => $date_installation,
                                ':nom_point_eau' => $nom_point_eau

                            ];

                            $result = $stmt->execute($params);

                            if ($result) {
                            } else {
                                echo "Error: " . $stmt->errorInfo()[2];
                            }
                        } else {
                            echo "Error preparing statement.";
                        }
                    } catch (PDOException $e) {


                        echo "Error: " . $e->getMessage();
                    }
                } elseif ($element_amenage === 'amenagement_touristique') {

                    try {
                        // Prepare the SQL query using named placeholders
                        $query = "INSERT INTO amenagement_touristiques(id_amengttour,type, responsable, periode, cout_creaction,date_cree,nom_amenagttour)
                                 VALUES (:id_amengttour,:type, :responsable, :periode, :cout_creaction,:date_cree,:nom_amenagttour)";

                        $stmt = $pdo->prepare($query);

                        if ($stmt) {
                            // Bind parameters and execute the statement using an associative array
                            $params = [

                                ':id_amengttour' => $id,
                                ':type' => $type,
                                ':responsable' => $responsable,
                                ':periode' => $periode,
                                ':cout_creaction' => $cout_creaction,
                                ':date_cree' => $date_cree,
                                ':nom_amenagttour'=> $nom_amenagttour,
                            ];

                            $result = $stmt->execute($params);

                            if ($result) {

                            } else {
                                echo "Error: " . $stmt->errorInfo()[2];
                            }
                        } else {
                            echo "Error preparing statement.";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }


                } elseif ($element_amenage === 'cloture') {
                    try {
                        // Prepare the SQL query using named placeholders
                        $query = "INSERT INTO clotures (id_cloture, date_cloture, cout_creation, nature, duree,nom_cloture)
                                 VALUES (:id_cloture, :date_cloture, :cout_creation, :nature, :duree,:nom_cloture)";

                        $stmt = $pdo->prepare($query);

                        if ($stmt) {
                            // Bind parameters and execute the statement using an associative array
                            $params = [
                                ':id_cloture' => $id,
                                ':date_cloture' => $date_cloture,
                                ':cout_creation' => $cout_creation,
                                ':nature' => $nature,
                                ':duree' => $duree,
                                ':nom_cloture' => $nom_cloture,
                            ];

                            $result = $stmt->execute($params);

                            if ($result) {

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

                if ($result) {
                    header("Location: ../amenagement.php?message=Data inserted successfully!");
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

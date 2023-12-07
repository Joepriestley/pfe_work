<?php
session_start();
$pdo = require_once 'dbConnect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Server-side data validation
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $nom = validate($_POST['nom']);
    $mot_de_passe = validate($_POST['mot_de_passe']);
    if (empty($nom)) {
        header('Location: ../login.php?error_message=Nom d\'utilisateur est nécessaire');
        exit();
    } else if (empty($mot_de_passe)) {
        header('Location: ../login.php?error_message=Mot de passe d\'utilisateur est nécessaire');
        exit();
    } else {
        try {
            $query = "SELECT * FROM users WHERE nom=:nom  LIMIT 1";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
            if ($result && password_verify($mot_de_passe, $result['mot_de_passe'])) {
            
                $_SESSION['nom']= $nom;
                $_SESSION['role']= $result['role'];

                header('Location: ../index.php');
                exit();
            } else {
                header('Location: ../login.php?error_message=Les informations d\'identification invalides');
                exit();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }
}
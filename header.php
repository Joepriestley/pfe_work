<?php
session_start();
if (!isset($_SESSION['nom'])  || $_SESSION['nom'] === '') {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Geoportail, SIG-WEB, Développement de SIG Web, Webmapping">
    <title>Geoportail-PNSM</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/geoportal-pnsm/css/styles.css"> <!-- Your custom CSS file for further customization -->
    <link rel="stylesheet" href="/geoportal-pnsm/lightbox/lightbox.css">
    <link rel="stylesheet" href="/geoportal-pnsm/css/style.css">
    <link rel="stylesheet" href="/geoportal-pnsm/css/nav.css">
    <link rel="stylesheet" href="/geoportal-pnsm/css/apropos.css">
    <style>
        header {
            position: fixed;
            width: 100%;
            z-index: 1000;
            padding-bottom: 45px;
            /* Increased padding to accommodate content */
            top: 0;
            /* Set the header to start right at the top of the viewport */
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-image: linear-gradient( 109.6deg,  rgba(61,131,97,1) 11.2%, rgba(28,103,88,1) 91.1% );">
            <a class="navbar-brand" href="/geoportal-pnsm/index.php" style="color: white;">
                <img src="/geoportal-pnsm/img/pnsm.png" alt="Geoportail-PNSM logo" width="40" height="40">
                Geoportail-PNSM
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/geoportal-pnsm/index.php" class="nav-link" style="color: white;">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="/geoportal-pnsm/apropos.php" class="nav-link" style="color: white;">A propos</a>
                    </li>
                    <li class="nav-item">
                        <a href="/geoportal-pnsm/galerie.php" class="nav-link" style="color: white;">Galerie</a>
                    </li>
                    <?php if (isset($_SESSION['nom']) && $_SESSION['nom'] != '') { ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="gestionDropdown" data-toggle="dropdown" style="color: white;">
                                Gestion
                            </a>
                            <div class="dropdown-menu" aria-labelledby="gestionDropdown">
                                <a class="dropdown-item" href="/geoportal-pnsm/amenagement.php">Amenagement</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/refection_pistes.php">Pistes</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/ref_point_eau.php">Point Eau</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/ref_amenagementtouristique.php">Amenagement Touristiques</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/refection_cloture.php">Cloture</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="ecodeveloppementDropdown" data-toggle="dropdown" style="color: white;">
                                Ecodeveloppement
                            </a>
                            <div class="dropdown-menu" aria-labelledby="ecodeveloppementDropdown">
                                <a class="dropdown-item" href="/geoportal-pnsm/touriste.php">Touristes</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/circuittourist.php">Circuit</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/passage.php">Circuit Passage</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/visitesite.php">Site Visite</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/apiculture.php">Alpiculture</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/percheartisanal.php">Perche Artisanal</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/agriculture.php">Agriculture</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/elevage.php">Elevage</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/autreactivite.php">Autres Activites</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/infrastruturetouristiq.php">Infrastructure Touristiques</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/utilise.php">Utilisation</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/association.php">Associations</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="ressourcesDropdown" data-toggle="dropdown" style="color: white;">
                                Ressources Naturelles
                            </a>
                            <div class="dropdown-menu" aria-labelledby="ressourcesDropdown">
                                <a class="dropdown-item" href="/geoportal-pnsm/esp_vegetal.php">Flore</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/sol.php">Sol</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/esp_animal.php">Faune</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/recensement.php">Recensement</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/suivi_faune.php">Suivi Faune</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="projetsDropdown" data-toggle="dropdown" style="color: white;">
                                Projets
                            </a>
                            <div class="dropdown-menu" aria-labelledby="projetsDropdown">
                                <a class="dropdown-item" href="/geoportal-pnsm/projet.php"">Projet</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/partenaire.php">Partenaire</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/association.php">Associations</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/executeur.PHP">Executeur</a>
                                <a class="dropdown-item" href="/geoportal-pnsm/action.php">Actions</a>
                            </div>
                        </li>

                    <?php } ?>

                    <li class="nav-item">
                        <a href="/geoportal-pnsm/webmap/map.php" class="nav-link" style="color: white;">Cartographie</a>
                    </li>
                    <li>

                    </li>
                    <?php if (isset($_SESSION['nom']) && $_SESSION['nom'] != '') {
                        if ($_SESSION['role'] === 'admin') {
                    ?>

                            <li class="nav-item">
                                <a href="/geoportal-pnsm/sign-up.php"  class="nav-link" style="color: white;">Inscrivez-vous</a>
                            </li>
                    <?php }
                    } ?>

                    <li class="nav-item">
                        <?php if (!isset($_SESSION['nom'])  || $_SESSION['nom'] === '') { ?>
                            <a href="/geoportal-pnsm/login.php" class="nav-link" style="color: white;">Authentifiez-vous</a>

                        <?php } else { ?>
                            <a href="/geoportal-pnsm/logout.php" class="nav-link" style="color: white;">Logout</a>

                        <?php } ?>

                    </li>

                </ul>
            </div>
        </nav>
    </header>
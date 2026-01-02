<?php
/**
 * HEADER - En-tête commun à toutes les pages
 * 
 * Ce fichier contient la navigation principale et l'en-tête HTML.
 * Il est inclus dans toutes les pages pour maintenir la cohérence.
 */

// Démarrer la session si nécessaire
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Portfolio professionnel - Développement et Cybersécurité">
    <meta name="author" content="<?php echo defined('NOM_COMPLET') ? NOM_COMPLET : 'Portfolio'; ?>">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?><?php echo defined('SITE_NAME') ? SITE_NAME : 'Portfolio'; ?></title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navigation principale -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-brand">
                <a href="index.php"><?php echo defined('NOM_COMPLET') ? explode(' ', NOM_COMPLET)[0] : 'Portfolio'; ?></a>
            </div>
            <button class="nav-toggle" id="navToggle" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Accueil</a></li>
                <li><a href="projets.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'projets.php' ? 'active' : ''; ?>">Projets</a></li>
                <li><a href="contact.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contenu principal (sera remplacé par le contenu de chaque page) -->
    <main class="main-content">


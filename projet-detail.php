<?php
/**
 * PAGE DÉTAIL D'UN PROJET
 * 
 * Cette page affiche les détails complets d'un projet
 * avec images, explications et code.
 */

require_once 'includes/config.php';

// Récupérer l'ID du projet depuis l'URL
$projet_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Charger les projets depuis le fichier JSON
$projets = [];
if (file_exists(CHEMIN_PROJETS)) {
    $json_content = file_get_contents(CHEMIN_PROJETS);
    $projets = json_decode($json_content, true);
    if ($projets === null) {
        $projets = [];
    }
}

// Trouver le projet correspondant
$projet = null;
foreach ($projets as $p) {
    if ($p['id'] == $projet_id) {
        $projet = $p;
        break;
    }
}

// Si le projet n'existe pas, rediriger vers la page projets
if (!$projet) {
    header('Location: projets.php');
    exit;
}

$page_title = $projet['titre'];
require_once 'includes/header.php';
?>

<section class="projet-detail-section">
    <div class="container">
        <!-- Bouton retour -->
        <a href="projets.php" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Retour aux projets
        </a>
        
        <!-- En-tête du projet -->
        <div class="projet-detail-header">
            <div class="projet-detail-title-wrapper">
                <h1 class="projet-detail-title"><?php echo htmlspecialchars($projet['titre']); ?></h1>
                <?php if (isset($projet['statut'])): ?>
                    <span class="projet-badge projet-badge-<?php echo htmlspecialchars($projet['statut']); ?>">
                        <?php
                        $statut_labels = [
                            'complet' => 'Complet',
                            'en_development' => 'En développement',
                            'partiellement_fonctionnel' => 'En amélioration'
                        ];
                        echo $statut_labels[$projet['statut']] ?? 'En cours';
                        ?>
                    </span>
                <?php endif; ?>
            </div>
            
            <div class="projet-detail-meta">
                <?php if (!empty($projet['date'])): ?>
                    <span class="projet-meta-item">
                        <i class="fas fa-calendar"></i>
                        <?php echo htmlspecialchars($projet['date']); ?>
                    </span>
                <?php endif; ?>
                
                <?php if ($projet['type_hebergement'] === 'github' && !empty($projet['lien_github'])): ?>
                    <a href="<?php echo htmlspecialchars($projet['lien_github']); ?>" 
                       target="_blank" 
                       rel="noopener" 
                       class="projet-meta-item projet-meta-link">
                        <i class="fab fa-github"></i>
                        Voir sur GitHub
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($projet['lien_demo'])): ?>
                    <a href="<?php echo htmlspecialchars($projet['lien_demo']); ?>" 
                       target="_blank" 
                       rel="noopener" 
                       class="projet-meta-item projet-meta-link">
                        <i class="fas fa-external-link-alt"></i>
                        Voir la démo
                    </a>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Galerie d'images -->
        <?php if (!empty($projet['images']) && is_array($projet['images'])): ?>
            <div class="projet-detail-gallery">
                <?php foreach ($projet['images'] as $index => $image): ?>
                    <?php 
                    $image_path = $image;
                    if (!file_exists($image)) {
                        $image_path = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="800" height="500"%3E%3Crect fill="%23f1f5f9" width="800" height="500"/%3E%3Ctext fill="%2394a3b8" font-family="sans-serif" font-size="20" x="50%25" y="50%25" text-anchor="middle" dy=".3em"%3EImage non disponible%3C/text%3E%3C/svg%3E';
                    }
                    ?>
                    <div class="projet-detail-image-wrapper">
                        <img src="<?php echo htmlspecialchars($image_path); ?>" 
                             alt="<?php echo htmlspecialchars($projet['titre']); ?> - Image <?php echo $index + 1; ?>" 
                             class="projet-detail-image"
                             loading="lazy"
                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'800\' height=\'500\'%3E%3Crect fill=\'%23f1f5f9\' width=\'800\' height=\'500\'/%3E%3Ctext fill=\'%2394a3b8\' font-family=\'sans-serif\' font-size=\'20\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\'%3EImage non disponible%3C/text%3E%3C/svg%3E';">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <!-- Description -->
        <div class="projet-detail-content">
            <div class="projet-detail-main">
                <div class="projet-detail-description">
                    <h2>Description</h2>
                    <p><?php echo nl2br(htmlspecialchars($projet['description'])); ?></p>
                </div>
                
                <!-- Compétences -->
                <?php if (!empty($projet['competences']) && is_array($projet['competences'])): ?>
                    <div class="projet-detail-competences">
                        <h2>Compétences utilisées</h2>
                        <div class="competences-tags">
                            <?php foreach ($projet['competences'] as $competence): ?>
                                <span class="competence-tag"><?php echo htmlspecialchars($competence); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Informations sur l'hébergement -->
                <?php if ($projet['type_hebergement'] === 'local'): ?>
                    <div class="projet-detail-info">
                        <h2>Informations</h2>
                        <div class="projet-info-local">
                            <i class="fas fa-info-circle"></i>
                            <p><?php echo htmlspecialchars($projet['explication_hebergement'] ?? 'Projet développé localement'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Sidebar avec informations supplémentaires -->
            <aside class="projet-detail-sidebar">
                <div class="projet-detail-card">
                    <h3>Détails du projet</h3>
                    <ul class="projet-detail-list">
                        <?php if (!empty($projet['date'])): ?>
                            <li>
                                <i class="fas fa-calendar"></i>
                                <strong>Date :</strong> <?php echo htmlspecialchars($projet['date']); ?>
                            </li>
                        <?php endif; ?>
                        <li>
                            <i class="fas fa-folder"></i>
                            <strong>Type :</strong> 
                            <?php echo $projet['type_hebergement'] === 'github' ? 'Projet GitHub' : 'Projet local'; ?>
                        </li>
                        <?php if (!empty($projet['competences'])): ?>
                            <li>
                                <i class="fas fa-code"></i>
                                <strong>Technologies :</strong> 
                                <?php echo count($projet['competences']); ?> utilisées
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>


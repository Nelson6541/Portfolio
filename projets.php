<?php
/**
 * PAGE PROJETS
 * 
 * Cette page affiche dynamiquement tous les projets
 * depuis le fichier JSON. Les projets peuvent être ajoutés
 * ou modifiés sans toucher à cette page.
 */

require_once 'includes/config.php';
$page_title = 'Projets';
require_once 'includes/header.php';

// Charger les projets depuis le fichier JSON
$projets = [];
if (file_exists(CHEMIN_PROJETS)) {
    $json_content = file_get_contents(CHEMIN_PROJETS);
    $projets = json_decode($json_content, true);
    if ($projets === null) {
        // Erreur de décodage JSON
        $json_error = json_last_error_msg();
        error_log("Erreur JSON dans projets.json: " . $json_error);
        $projets = [];
    }
} else {
    error_log("Fichier projets.json introuvable: " . CHEMIN_PROJETS);
}
?>

<section class="projets-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Mes Projets</h2>
            <p class="section-subtitle">Découvrez mes réalisations et compétences techniques</p>
        </div>
        
        <?php 
        // Afficher un message d'erreur si le JSON est invalide
        if (file_exists(CHEMIN_PROJETS)) {
            $json_content = file_get_contents(CHEMIN_PROJETS);
            $test_decode = json_decode($json_content, true);
            if ($test_decode === null && json_last_error() !== JSON_ERROR_NONE) {
                echo '<div class="alert alert-error">';
                echo '<i class="fas fa-exclamation-triangle"></i>';
                echo '<p>Erreur dans le fichier projets.json : ' . htmlspecialchars(json_last_error_msg()) . '</p>';
                echo '<p>Veuillez vérifier la syntaxe du fichier JSON.</p>';
                echo '</div>';
            }
        }
        
        if (empty($projets)): ?>
            <div class="no-projets">
                <i class="fas fa-folder-open"></i>
                <p>Aucun projet disponible pour le moment.</p>
                <?php if (!file_exists(CHEMIN_PROJETS)): ?>
                    <p style="margin-top: 1rem; color: #ef4444; font-size: 0.875rem;">
                        <i class="fas fa-exclamation-circle"></i> 
                        Fichier projets.json introuvable.
                    </p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="projets-grid">
                <?php foreach ($projets as $projet): ?>
                    <a href="projet-detail.php?id=<?php echo htmlspecialchars($projet['id']); ?>" class="projet-card-link">
                    <article class="projet-card" data-projet-id="<?php echo htmlspecialchars($projet['id']); ?>">
                        <!-- Images du projet -->
                        <?php if (!empty($projet['images']) && is_array($projet['images'])): ?>
                            <div class="projet-images">
                                <?php 
                                $first_image = $projet['images'][0];
                                $image_path = $first_image;
                                
                                // Vérifier si l'image existe
                                if (!file_exists($first_image)) {
                                    // Si l'image n'existe pas, utiliser un placeholder SVG
                                    $image_path = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="400" height="250"%3E%3Crect fill="%23f1f5f9" width="400" height="250"/%3E%3Ctext fill="%2394a3b8" font-family="sans-serif" font-size="18" x="50%25" y="50%25" text-anchor="middle" dy=".3em"%3EImage non disponible%3C/text%3E%3C/svg%3E';
                                }
                                ?>
                                <img src="<?php echo htmlspecialchars($image_path); ?>" 
                                     alt="<?php echo htmlspecialchars($projet['titre']); ?>" 
                                     class="projet-image-main"
                                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'250\'%3E%3Crect fill=\'%23f1f5f9\' width=\'400\' height=\'250\'/%3E%3Ctext fill=\'%2394a3b8\' font-family=\'sans-serif\' font-size=\'18\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\'%3EImage non disponible%3C/text%3E%3C/svg%3E';">
                            </div>
                        <?php endif; ?>
                        
                        <!-- Contenu de la carte -->
                        <div class="projet-content">
                            <h3 class="projet-titre"><?php echo htmlspecialchars($projet['titre']); ?></h3>
                            
                            <!-- Badge de statut -->
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
                            
                            <p class="projet-description"><?php echo htmlspecialchars($projet['description']); ?></p>
                            
                            <!-- Compétences utilisées -->
                            <?php if (!empty($projet['competences']) && is_array($projet['competences'])): ?>
                                <div class="projet-competences">
                                    <h4>Compétences :</h4>
                                    <div class="competences-tags">
                                        <?php foreach ($projet['competences'] as $competence): ?>
                                            <span class="competence-tag"><?php echo htmlspecialchars($competence); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Informations sur l'hébergement -->
                            <div class="projet-hebergement" onclick="event.stopPropagation();">
                                <?php if ($projet['type_hebergement'] === 'github' && !empty($projet['lien_github'])): ?>
                                    <a href="<?php echo htmlspecialchars($projet['lien_github']); ?>" 
                                       target="_blank" 
                                       rel="noopener" 
                                       class="projet-lien"
                                       onclick="event.stopPropagation();">
                                        <i class="fab fa-github"></i>
                                        Voir sur GitHub
                                    </a>
                                <?php elseif ($projet['type_hebergement'] === 'local'): ?>
                                    <div class="projet-info-local">
                                        <i class="fas fa-info-circle"></i>
                                        <span><?php echo htmlspecialchars($projet['explication_hebergement'] ?? 'Projet développé localement'); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($projet['lien_demo'])): ?>
                                    <a href="<?php echo htmlspecialchars($projet['lien_demo']); ?>" 
                                       target="_blank" 
                                       rel="noopener" 
                                       class="projet-lien projet-lien-demo"
                                       onclick="event.stopPropagation();">
                                        <i class="fas fa-external-link-alt"></i>
                                        Voir la démo
                                    </a>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Date -->
                            <?php if (!empty($projet['date'])): ?>
                                <div class="projet-date">
                                    <i class="fas fa-calendar"></i>
                                    <?php echo htmlspecialchars($projet['date']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>


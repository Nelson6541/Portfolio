<?php
/**
 * PAGE D'ACCUEIL
 * 
 * Cette page présente une grande photo, une phrase d'accroche
 * et un bouton pour télécharger le CV.
 */

require_once 'includes/config.php';
$page_title = 'Accueil';
require_once 'includes/header.php';

// Charger le parcours depuis le fichier JSON
$parcours = [];
$chemin_parcours = __DIR__ . '/data/parcours.json';
if (file_exists($chemin_parcours)) {
    $json_content = file_get_contents($chemin_parcours);
    $parcours = json_decode($json_content, true);
    if ($parcours === null) {
        $parcours = [];
    }
}
?>

<!-- Section Hero avec photo principale -->
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <div class="hero-grid">
                <!-- Photo principale -->
                <div class="hero-image-wrapper">
                    <div class="hero-image-container">
                        <?php 
                        $photo_profil = 'assets/images/photo-profil.jpeg';
                        if (!file_exists($photo_profil)) {
                            $photo_profil = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="400" height="500"%3E%3Crect fill="%23e2e8f0" width="400" height="500"/%3E%3Ccircle cx="200" cy="200" r="80" fill="%23cbd5e1"/%3E%3Cpath d="M100 400 L300 400" stroke="%23cbd5e1" stroke-width="40" stroke-linecap="round"/%3E%3C/svg%3E';
                        }
                        ?>
                        <img src="<?php echo htmlspecialchars($photo_profil); ?>" alt="<?php echo htmlspecialchars(NOM_COMPLET); ?>" class="hero-image" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'500\'%3E%3Crect fill=\'%23e2e8f0\' width=\'400\' height=\'500\'/%3E%3Ccircle cx=\'200\' cy=\'200\' r=\'80\' fill=\'%23cbd5e1\'/%3E%3Cpath d=\'M100 400 L300 400\' stroke=\'%23cbd5e1\' stroke-width=\'40\' stroke-linecap=\'round\'/%3E%3C/svg%3E';">
                        <div class="hero-image-overlay"></div>
                    </div>
                </div>
                
                <!-- Contenu texte -->
                <div class="hero-text">
                    <h1 class="hero-title">
                        <span class="hero-greeting">Bonjour, je suis</span>
                        <span class="hero-name"><?php echo NOM_COMPLET; ?></span>
                    </h1>
                    <p class="hero-subtitle"><?php echo TITRE_PROFESSIONNEL; ?></p>
                    <p class="hero-description"><?php echo PHRASE_ACCROCHE; ?></p>
                    
                    <!-- Bouton téléchargement CV -->
                    <div class="hero-actions">
                        <?php if (file_exists(CHEMIN_CV)): ?>
                            <a href="<?php echo CHEMIN_CV; ?>" class="btn btn-primary" download>
                                <i class="fas fa-download"></i>
                                Télécharger mon CV
                            </a>
                        <?php endif; ?>
                        <a href="projets.php" class="btn btn-secondary">
                            <i class="fas fa-code"></i>
                            Voir mes projets
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Indicateur de scroll -->
    <div class="scroll-indicator">
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<!-- Section À propos (optionnelle) -->
<section class="about-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">À propos</h2>
            <p class="section-subtitle">Mon parcours et mes compétences</p>
        </div>
        
        <div class="about-content">
            <div class="about-text">
                <p>
                    Étudiant passionné par le développement web et la cybersécurité, 
                    je me spécialise dans la création de solutions numériques sécurisées et performantes.
                </p>
                <p>
                    Chaque projet que je développe est une opportunité d'apprendre, 
                    d'innover et de relever de nouveaux défis techniques.
                </p>
            </div>
            
            <!-- Parcours -->
            <?php if (!empty($parcours)): ?>
                <div class="parcours-preview">
                    <h3 class="parcours-preview-title">Mon Parcours</h3>
                    <div class="parcours-preview-list">
                        <?php foreach ($parcours as $item): ?>
                            <?php if (isset($item['type']) && isset($item['titre'])): ?>
                                <div class="parcours-preview-item" data-type="<?php echo htmlspecialchars($item['type'] ?? 'academique'); ?>">
                                    <div class="parcours-preview-icon">
                                        <?php if (($item['type'] ?? 'academique') === 'academique'): ?>
                                            <i class="fas fa-graduation-cap"></i>
                                        <?php else: ?>
                                            <i class="fas fa-briefcase"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="parcours-preview-content">
                                        <h4 class="parcours-preview-titre"><?php echo htmlspecialchars($item['titre'] ?? 'Non spécifié'); ?></h4>
                                        <?php if (!empty($item['institution'])): ?>
                                            <p class="parcours-preview-institution"><?php echo htmlspecialchars($item['institution']); ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($item['date_debut']) || !empty($item['date_fin'])): ?>
                                            <span class="parcours-preview-date">
                                                <?php echo htmlspecialchars($item['date_debut'] ?? ''); ?><?php echo (!empty($item['date_debut']) && !empty($item['date_fin'])) ? ' - ' : ''; ?><?php echo htmlspecialchars($item['date_fin'] ?? ''); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Compétences principales -->
            <div class="skills-grid">
                <div class="skill-item">
                    <i class="fas fa-code"></i>
                    <h3>Développement Web</h3>
                    <p>Front-end & Back-end</p>
                </div>
                <div class="skill-item">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Cybersécurité</h3>
                    <p>Analyse & Protection</p>
                </div>
                <div class="skill-item">
                    <i class="fas fa-database"></i>
                    <h3>Bases de données</h3>
                    <p>MySQL & Architecture</p>
                </div>
                <div class="skill-item">
                    <i class="fas fa-tools"></i>
                    <h3>Outils & Technologies</h3>
                    <p>Stack moderne</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>


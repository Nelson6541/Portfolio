<?php
/**
 * PAGE CONTACT
 * 
 * Cette page contient un formulaire de contact fonctionnel
 * qui envoie les messages par email.
 */

require_once 'includes/config.php';
$page_title = 'Contact';
require_once 'includes/header.php';

// Gérer les messages de confirmation/erreur
$message_success = '';
$message_error = '';

if (isset($_SESSION['contact_success'])) {
    $message_success = $_SESSION['contact_success'];
    unset($_SESSION['contact_success']);
}

if (isset($_SESSION['contact_error'])) {
    $message_error = $_SESSION['contact_error'];
    unset($_SESSION['contact_error']);
}
?>

<section class="contact-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Contactez-moi</h2>
            <p class="section-subtitle">Une question ? Un projet ? N'hésitez pas à me contacter</p>
        </div>
        
        <div class="contact-wrapper">
            <!-- Informations de contact -->
            <div class="contact-info">
                <h3>Informations de contact</h3>
                <div class="contact-info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <strong>Email</strong>
                        <p><a href="mailto:<?php echo htmlspecialchars(EMAIL_CONTACT); ?>"><?php echo htmlspecialchars(EMAIL_CONTACT); ?></a></p>
                    </div>
                    </div>
                <div class="contact-info-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <strong>Téléphone</strong>
                        <p>+33 07 65 15 74 69</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <strong>Disponibilité</strong>
                        <p>Réponse sous 24-48h</p>
                    </div>
                </div>
            </div>
            
            <!-- Formulaire de contact -->
            <div class="contact-form-wrapper">
                <?php if ($message_success): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo htmlspecialchars($message_success); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($message_error): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo htmlspecialchars($message_error); ?>
                    </div>
                <?php endif; ?>
                
                <form action="send-email.php" method="POST" class="contact-form" id="contactForm">
                    <div class="form-group">
                        <label for="nom">Nom complet <span class="required">*</span></label>
                        <input type="text" 
                               id="nom" 
                               name="nom" 
                               required 
                               placeholder="Votre nom"
                               class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               required 
                               placeholder="votre.email@example.com"
                               class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="sujet">Sujet <span class="required">*</span></label>
                        <input type="text" 
                               id="sujet" 
                               name="sujet" 
                               required 
                               placeholder="Objet de votre message"
                               class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message <span class="required">*</span></label>
                        <textarea id="message" 
                                  name="message" 
                                  required 
                                  rows="6"
                                  placeholder="Votre message..."
                                  class="form-control"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-submit">
                        <i class="fas fa-paper-plane"></i>
                        Envoyer le message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>


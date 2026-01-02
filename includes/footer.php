<?php
/**
 * FOOTER - Pied de page commun à toutes les pages
 * 
 * Ce fichier contient le pied de page avec les liens sociaux
 * et les informations de copyright.
 */
?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Navigation</h3>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="projets.php">Projets</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Réseaux</h3>
                    <div class="social-links">
                        <!-- Modifiez ces liens selon vos réseaux sociaux -->
                        <a href="https://github.com/Nelson6541" target="_blank" rel="noopener" aria-label="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/nelson-ngoulou" target="_blank" rel="noopener" aria-label="LinkedIn">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="mailto:<?php echo defined('EMAIL_CONTACT') ? EMAIL_CONTACT : ''; ?>" aria-label="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Informations</h3>
                    <p>&copy; <?php echo date('Y'); ?> <?php echo defined('NOM_COMPLET') ? NOM_COMPLET : 'Portfolio'; ?>. Tous droits réservés.</p>
                    <p>Développé avec passion pour la technologie.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts JavaScript -->
    <script src="assets/js/main.js"></script>
</body>
</html>


/**
 * JAVASCRIPT PRINCIPAL
 * 
 * Gère les interactions utilisateur, animations
 * et fonctionnalités dynamiques du site
 */

(function() {
    'use strict';

    // ============================================
    // NAVIGATION MOBILE
    // ============================================
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    const navbar = document.getElementById('navbar');

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
        });

        // Fermer le menu en cliquant sur un lien
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('active');
                navToggle.classList.remove('active');
            });
        });
    }

    // ============================================
    // NAVBAR SCROLL EFFECT
    // ============================================
    if (navbar) {
        let lastScroll = 0;
        
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                navbar.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
            } else {
                navbar.style.boxShadow = '0 1px 2px 0 rgba(0, 0, 0, 0.05)';
            }
            
            lastScroll = currentScroll;
        });
    }

    // ============================================
    // ANIMATION AU SCROLL (Fade In)
    // ============================================
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observer les éléments à animer
    const animateElements = document.querySelectorAll('.projet-card, .skill-item, .contact-form-wrapper, .about-text, .parcours-preview-item');
    animateElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
    
    // Animation séquentielle pour les éléments du parcours
    const parcoursItems = document.querySelectorAll('.parcours-preview-item');
    parcoursItems.forEach((item, index) => {
        item.style.transitionDelay = `${index * 0.1}s`;
    });

    // ============================================
    // VALIDATION DU FORMULAIRE DE CONTACT
    // ============================================
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const nom = document.getElementById('nom').value.trim();
            const email = document.getElementById('email').value.trim();
            const sujet = document.getElementById('sujet').value.trim();
            const message = document.getElementById('message').value.trim();

            let isValid = true;
            let errorMessage = '';

            // Validation basique
            if (!nom || nom.length < 2) {
                isValid = false;
                errorMessage = 'Le nom doit contenir au moins 2 caractères.';
            }

            if (!email || !isValidEmail(email)) {
                isValid = false;
                errorMessage = 'Veuillez entrer une adresse email valide.';
            }

            if (!sujet || sujet.length < 3) {
                isValid = false;
                errorMessage = 'Le sujet doit contenir au moins 3 caractères.';
            }

            if (!message || message.length < 10) {
                isValid = false;
                errorMessage = 'Le message doit contenir au moins 10 caractères.';
            }

            if (!isValid) {
                e.preventDefault();
                alert(errorMessage);
                return false;
            }

            // Désactiver le bouton pendant l'envoi
            const submitBtn = contactForm.querySelector('.btn-submit');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi en cours...';
            }
        });
    }

    // Fonction de validation email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // ============================================
    // SMOOTH SCROLL POUR LES ANCRES
    // ============================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // ============================================
    // GESTION DES IMAGES PLACEHOLDER
    // ============================================
    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('error', function() {
            // Si une image ne charge pas, utiliser un placeholder SVG
            if (!this.src.includes('data:image/svg+xml')) {
                this.src = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="400" height="250"%3E%3Crect fill="%23f1f5f9" width="400" height="250"/%3E%3Ctext fill="%2394a3b8" font-family="sans-serif" font-size="18" x="50%25" y="50%25" text-anchor="middle" dy=".3em"%3EImage non disponible%3C/text%3E%3C/svg%3E';
                this.alt = 'Image non disponible';
            }
        });
    });

    // ============================================
    // ANIMATION DES CARTES PROJET AU HOVER
    // ============================================
    const projetCards = document.querySelectorAll('.projet-card');
    projetCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // ============================================
    // CONSOLE MESSAGE (Optionnel - pour le fun)
    // ============================================
    console.log('%c👋 Bienvenue sur mon portfolio !', 'color: #2563eb; font-size: 16px; font-weight: bold;');
    console.log('%cVous êtes développeur ? Contactez-moi pour échanger !', 'color: #64748b; font-size: 12px;');

})();


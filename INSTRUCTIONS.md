# 🚀 Instructions de Démarrage Rapide

## ✅ Étapes pour mettre en ligne votre portfolio

### 1. Configuration de base

Ouvrez `includes/config.php` et modifiez :
- `NOM_COMPLET` : Votre nom complet
- `TITRE_PROFESSIONNEL` : Votre titre (ex: "Développeur & Spécialiste Cybersécurité")
- `EMAIL_CONTACT` : Votre email de contact
- `PHRASE_ACCROCHE` : Votre phrase d'accroche personnalisée

### 2. Ajout de vos fichiers personnels

#### Photo de profil
- Placez votre photo dans : `assets/images/photo-profil.jpg`
- Format recommandé : JPG, 800x1000px (ou ratio similaire)
- Nom exact requis : `photo-profil.jpg`

#### CV
- Placez votre CV dans : `assets/documents/cv.pdf`
- Format : PDF
- Nom exact requis : `cv.pdf`

#### Images de projets
- Placez les images dans : `assets/images/projets/`
- Nommez-les selon vos projets (ex: `projet1-1.jpg`, `projet2-1.jpg`)
- Référencez-les dans `data/projets.json`

### 3. Configuration des projets

Ouvrez `data/projets.json` et modifiez les projets existants ou ajoutez-en de nouveaux.

**Structure d'un projet :**
```json
{
    "id": 1,
    "titre": "Nom du projet",
    "description": "Description détaillée...",
    "competences": ["PHP", "JavaScript", "MySQL"],
    "images": ["assets/images/projets/nom-image.jpg"],
    "type_hebergement": "local",
    "explication_hebergement": "Projet développé localement...",
    "lien_github": "",
    "lien_demo": "",
    "statut": "complet",
    "date": "2024"
}
```

**Types d'hébergement :**
- `"local"` : Pour les projets développés localement
- `"github"` : Pour les projets sur GitHub (ajoutez le lien dans `lien_github`)

**Statuts :**
- `"complet"` : Projet terminé
- `"en_development"` : En cours
- `"partiellement_fonctionnel"` : Partiellement fonctionnel

### 4. Personnalisation des réseaux sociaux

Ouvrez `includes/footer.php` et modifiez les liens vers :
- GitHub
- LinkedIn
- Autres réseaux

### 5. Test du formulaire de contact

Le formulaire utilise la fonction `mail()` de PHP par défaut.

**Pour XAMPP local :**
- Configurez `php.ini` pour l'envoi d'email
- Ou utilisez un service comme Mailtrap pour les tests

**Pour la production :**
- Utilisez PHPMailer avec SMTP
- Modifiez `send-email.php` selon vos besoins

### 6. Accès au site

Une fois tout configuré :
- Ouvrez votre navigateur
- Allez sur : `http://localhost/portofolio`

## 📝 Notes importantes

- ✅ Vous pouvez ajouter/modifier des projets SANS toucher aux fichiers PHP
- ✅ Tous les projets sont gérés via `data/projets.json`
- ✅ Le design est entièrement responsive
- ✅ Les images manquantes sont gérées automatiquement

## 🎨 Personnalisation avancée

### Couleurs
Modifiez les variables dans `assets/css/style.css` (section `:root`)

### Animations
Les animations sont dans `assets/js/main.js`

## ❓ Problèmes courants

**Les images ne s'affichent pas :**
- Vérifiez les chemins dans `projets.json`
- Assurez-vous que les fichiers existent

**Le formulaire ne fonctionne pas :**
- Vérifiez la configuration email dans `send-email.php`
- Testez avec un service SMTP en production

**Le menu mobile ne s'ouvre pas :**
- Vérifiez que `assets/js/main.js` est bien chargé
- Ouvrez la console du navigateur pour voir les erreurs

---

**Bon courage avec votre portfolio ! 🚀**


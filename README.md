# Portfolio Professionnel

Portfolio moderne et évolutif développé avec PHP, HTML, CSS et JavaScript.

## 📁 Structure du Projet

```
portofolio/
├── index.php              # Page d'accueil
├── projets.php            # Page des projets
├── contact.php            # Page de contact
├── send-email.php         # Traitement du formulaire de contact
├── includes/
│   ├── config.php         # Configuration du site
│   ├── header.php         # En-tête commun
│   └── footer.php         # Pied de page commun
├── assets/
│   ├── css/
│   │   └── style.css      # Styles principaux
│   ├── js/
│   │   └── main.js        # JavaScript principal
│   ├── images/
│   │   ├── photo-profil.jpg    # Votre photo (à ajouter)
│   │   └── projets/            # Images des projets
│   └── documents/
│       └── cv.pdf              # Votre CV (à ajouter)
└── data/
    └── projets.json       # Fichier JSON contenant les projets
```

## 🚀 Installation

1. **Placez les fichiers dans votre serveur web** (XAMPP, WAMP, ou serveur en ligne)

2. **Configurez le fichier `includes/config.php`** :
   - Modifiez vos informations personnelles
   - Ajustez l'email de contact
   - Configurez le chemin vers votre CV

3. **Ajoutez vos fichiers** :
   - Placez votre photo dans `assets/images/photo-profil.jpg`
   - Placez votre CV dans `assets/documents/cv.pdf`
   - Ajoutez les images de vos projets dans `assets/images/projets/`

4. **Configurez l'envoi d'email** :
   - Pour un environnement de production, utilisez PHPMailer avec SMTP
   - Modifiez `send-email.php` selon vos besoins

## ✏️ Ajouter ou Modifier un Projet

**C'est très simple !** Ouvrez le fichier `data/projets.json` et ajoutez/modifiez un projet :

```json
{
    "id": 4,
    "titre": "Mon Nouveau Projet",
    "description": "Description détaillée du projet...",
    "competences": ["PHP", "JavaScript", "MySQL"],
    "images": [
        "assets/images/projets/nouveau-projet-1.jpg"
    ],
    "type_hebergement": "local",
    "explication_hebergement": "Projet développé localement...",
    "lien_github": "",
    "lien_demo": "",
    "statut": "complet",
    "date": "2024"
}
```

**Types d'hébergement disponibles :**
- `"local"` : Projet développé localement (avec explication)
- `"github"` : Projet sur GitHub (avec lien)

**Statuts disponibles :**
- `"complet"` : Projet terminé et fonctionnel
- `"en_development"` : Projet en cours de développement
- `"partiellement_fonctionnel"` : Projet avec certaines fonctionnalités

**Aucune modification des pages PHP n'est nécessaire !** Le système lit automatiquement le fichier JSON.

## 🎨 Personnalisation

### Couleurs
Modifiez les variables CSS dans `assets/css/style.css` (section `:root`)

### Navigation
Modifiez les liens dans `includes/header.php`

### Réseaux sociaux
Modifiez les liens dans `includes/footer.php`

## 📧 Configuration Email

Pour que le formulaire de contact fonctionne correctement :

1. **Environnement local (XAMPP)** :
   - La fonction `mail()` de PHP peut nécessiter une configuration
   - Testez d'abord avec un service comme Mailtrap

2. **Environnement de production** :
   - Utilisez PHPMailer avec authentification SMTP
   - Configurez les constantes dans `includes/config.php`

## 🔒 Sécurité

- Tous les inputs sont nettoyés avec `htmlspecialchars()`
- Validation côté serveur et client
- Protection contre les injections SQL (si vous ajoutez une base de données)

## 📱 Responsive

Le site est entièrement responsive et s'adapte à tous les écrans :
- Desktop
- Tablette
- Mobile

## 🛠️ Technologies Utilisées

- **Front-end** : HTML5, CSS3, JavaScript (Vanilla)
- **Back-end** : PHP 7.4+
- **Design** : CSS Grid, Flexbox, Animations CSS
- **Icônes** : Font Awesome

## 📝 Notes

- Les projets peuvent être présentés même s'ils ne sont pas sur GitHub
- Le système gère intelligemment les différents types d'hébergement
- Le design est orienté recruteur/entreprise tech
- Le code est commenté et facilement modifiable

## 🎯 Prochaines Étapes

1. Ajoutez votre photo et votre CV
2. Personnalisez les projets dans `projets.json`
3. Testez le formulaire de contact
4. Déployez sur votre serveur

---

**Développé avec passion pour la technologie** 🚀


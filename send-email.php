<?php
/**
 * TRAITEMENT DU FORMULAIRE DE CONTACT AVEC PHPMailer
 * * Ce fichier traite les données du formulaire de contact
 * et envoie un email via SMTP avec PHPMailer.
 */

session_start();

// 1. Vérifier l'installation de PHPMailer
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    $_SESSION['contact_error'] = 'Erreur système : PHPMailer n\'est pas installé.';
    header('Location: contact.php');
    exit;
}

// 2. Charger la configuration
require_once 'includes/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// 3. Vérification de la méthode d'envoi
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

// 4. Récupération et nettoyage des données
$nom     = isset($_POST['nom']) ? trim($_POST['nom']) : '';
$email   = isset($_POST['email']) ? trim($_POST['email']) : '';
$sujet   = isset($_POST['sujet']) ? trim($_POST['sujet']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// 5. Validation
$errors = [];
if (empty($nom)) $errors[] = 'Le nom est requis.';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email invalide.';
if (empty($sujet)) $errors[] = 'Le sujet est requis.';
if (empty($message)) $errors[] = 'Le message est requis.';

if (!empty($errors)) {
    $_SESSION['contact_error'] = implode(' ', $errors);
    header('Location: contact.php');
    exit;
}

// 6. Configuration de l'envoi
$mail = new PHPMailer(true);

try {
    // --- Configuration Serveur ---
    // Decommenter la ligne suivante pour voir les erreurs techniques précises si l'envoi échoue
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Port 465
    $mail->Port       = SMTP_PORT;
    $mail->CharSet    = 'UTF-8';

    // --- CORRECTION CRITIQUE POUR LOCALHOST ---
    // Désactive la vérification stricte SSL (nécessaire souvent sur Wamp/Xampp)
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // --- Expéditeur et Destinataire ---
    // IMPORTANT : Gmail exige que le "From" soit VOTRE adresse authentifiée
    $mail->setFrom(SMTP_USER, "Portfolio - " . $nom); 
    
    // Le mail arrive chez vous
    $mail->addAddress(EMAIL_CONTACT, NOM_COMPLET);
    
    // Si vous cliquez sur "Répondre", cela ira au visiteur
    $mail->addReplyTo($email, $nom);

    // --- Contenu ---
    $mail->isHTML(true);
    $mail->Subject = '[Portfolio] ' . $sujet;
    
    // Corps du message en HTML
    $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; color: #333; }
                .container { max-width: 600px; padding: 20px; border: 1px solid #ddd; }
                h2 { color: #0056b3; }
                .info { background: #f4f4f4; padding: 10px; margin-bottom: 20px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Nouveau contact depuis le site</h2>
                <div class='info'>
                    <p><strong>De :</strong> " . htmlspecialchars($nom) . "</p>
                    <p><strong>Email :</strong> " . htmlspecialchars($email) . "</p>
                    <p><strong>Sujet :</strong> " . htmlspecialchars($sujet) . "</p>
                </div>
                <p><strong>Message :</strong></p>
                <p>" . nl2br(htmlspecialchars($message)) . "</p>
            </div>
        </body>
        </html>
    ";

    $mail->AltBody = "Nouveau message de $nom ($email)\nSujet: $sujet\n\nMessage:\n$message";

    $mail->send();
    
    $_SESSION['contact_success'] = 'Votre message a bien été envoyé !';

} catch (Exception $e) {
    // Enregistrement de l'erreur dans les logs serveur (invisible pour l'utilisateur)
    error_log("Erreur Mailer: " . $mail->ErrorInfo);
    
    // Si vous êtes en test et que ça ne marche pas, décommentez la ligne ci-dessous pour voir l'erreur à l'écran :
     die("Erreur : " . $mail->ErrorInfo);

    $_SESSION['contact_error'] = "Une erreur technique est survenue lors de l'envoi.";
}

// Redirection finale
header('Location: contact.php');
exit;
?>
<?php
define('SMTP_HOST', 'smtp-relay.brevo.com');
define('SMTP_PORT', 587);
define('SMTP_USER', '9900d3001@smtp-brevo.com'); // Ex. : smtp_123456@sendinblue.com
define('SMTP_PASS', 'LGt3SJI1rfTqMn5Z'); // La clé générée
?>
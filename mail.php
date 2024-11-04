
<?php

// lance les classes de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// path du dossier PHPMailer % fichier d'envoi du mail
require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPMailer.php';
require 'phpMailer/src/SMTP.php';

  $objet = $_POST['subject'];
  $contenu = "Nom : " . $_POST['name'] . "\n";
  $contenu .= "Email : " . $_POST['email'] . "\n";
  $contenu .= "Message : " . $_POST['msg'] . "\n";
  $expediteur = $_POST['email'];


sendmail($objet, $contenu, $expediteur);

function sendmail($objet, $contenu, $expediteur)
{
    // on crée une nouvelle instance de la classe
    $mail = new PHPMailer(true);
      // puis on l’exécute avec un 'try/catch' qui teste les erreurs d'envoi
      try {
        /* DONNEES SERVEUR */
        #####################
        $mail->setLanguage('fr', '../PHPMailer/language/');   // pour avoir les messages d'erreur en FR
        $mail->SMTPDebug = 0;            // en production (sinon "2")
        // $mail->SMTPDebug = 2;            // décommenter en mode débug
        $mail->isSMTP();                           // envoi avec le SMTP du serveur
        $mail->Host       = 'mail.lean-advancer.com';                            // serveur SMTP
        $mail->SMTPAuth   = true;                  // le serveur SMTP nécessite une authentification ("false" sinon)
        $mail->Username   = 'contact@lean-advancer.com';     // login SMTP
        $mail->Password   = 'eD4!Axyeq_3r5mC';                                                // Mot de passe SMTP
        $mail->SMTPSecure = 'ssl';  // encodage des données TLS (ou juste 'tls') >
                                                            //"Aucun chiffrement des données";
                                                            //sinon PHPMailer::ENCRYPTION_SMTPS (ou juste 'ssl')
        $mail->Port       = 465;              // port TCP (ou 25, ou 465...)
    
        /* DONNEES DESTINATAIRES */
        ##########################
        $mail->setFrom('contact@lean-advancer.com', 'No-Reply');  //adresse de l'expéditeur (pas d'accents)
        $mail->addAddress('contact@lean-advancer.com', 'Clients de Mon_Domaine');        // Adresse du destinataire (le nom est facultatif)
        // $mail->addReplyTo('moi@mon_domaine.fr', 'son nom');     // réponse à un autre que l'expéditeur (le nom est facultatif)
        // $mail->addCC('cc@example.com');            // Cc (copie) : autant d'adresse que souhaité = Cc (le nom est facultatif)
        // $mail->addBCC('bcc@example.com');          // Cci (Copie cachée) :  : autant d'adresse que souhaité = Cci (le nom est facultatif)
    
        /* PIECES JOINTES */
        ##########################
        // $mail->addAttachment('../dossier/fichier.zip');         // Pièces jointes en gardant le nom du fichier sur le serveur
        // $mail->addAttachment('../dossier/fichier.zip', 'nouveau_nom.zip');    // Ou : pièce jointe + nouveau nom
    
        /* CONTENU DE L'EMAIL*/
        ##########################
        $mail->isHTML(true);                                      // email au format HTML
        $mail->Subject = utf8_decode($objet);      // Objet du message (éviter les accents là, sauf si utf8_encode)
        $mail->Body    = $contenu;          // corps du message en HTML - Mettre des slashes si apostrophes
        $mail->AltBody = 'Contenu au format texte pour les clients e-mails qui ne le supportent pas'; // ajout facultatif de texte sans balises HTML (format texte)
    
        $mail->send();
        echo 'Message envoyé. <a href="/">retour à l\'accueil</a>';
      
      }
      // si le try ne marche pas > exception ici
      catch (Exception $e) {
        echo "Le Message n'a pas été envoyé. Mailer Error: {$mail->ErrorInfo}"; // Affiche l'erreur concernée le cas échéant
      }  
    } // fin de la fonction sendmail
?>
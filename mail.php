<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Envoi d'un message par formulaire</title>
</head>

<body>
    <?php

    $to = "juniorridge93@gmail.com";
    $subject = $_POST['subject'];
    $message = $_POST['msg'];
    $headers = "Content-type: text/plain; charset=utf-8\r\n";
    $headers .= "From: " . $_POST['email'];

    $retour = mail($to, $subject, $message, $headers);
    if ($retour)
        echo '<p>Votre message a bien été envoyé.</p>';
    ?>
</body>
</html>
<?php
session_start();

// Vérifier si un code a été reçu dans l'URL après l'autorisation
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Identifiants de l'application Instagram
    $client_id = '3850726875254195'; // Remplace par ton Client ID
    $client_secret = 'c52c2c482cc3ecdc4182931266ac82b5'; // Remplace par ton Client Secret
    $redirect_uri = 'http://localhost/callback.php'; // Remplace par l'URL de redirection

    // URL pour demander le token d'accès
    $url = 'https://api.instagram.com/oauth/access_token';

    // Données à envoyer dans la requête POST
    $data = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => 'authorization_code',
        'redirect_uri' => $redirect_uri,
        'code' => $code
    );

    // Configuration de la requête POST
    $options = array(
        'http' => array(
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );

    // Envoi de la requête POST pour obtenir le token
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    // Conversion du résultat JSON en tableau PHP
    $response = json_decode($result, true);

    // Récupération du token d'accès
    if (isset($response['access_token'])) {
        $access_token = $response['access_token'];

        // Stocker le token d'accès dans la session
        $_SESSION['access_token'] = $access_token;

        // Redirection vers la page de profil
        header("Location: profile.php");
        exit;
    } else {
        echo "Erreur lors de la récupération du token d'accès.";
    }
} else {
    echo "Code d'autorisation non reçu.";
}
?>

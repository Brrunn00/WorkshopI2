<?php
session_start();

// Vérifier si un token d'accès est disponible
if (isset($_SESSION['access_token'])) {
    $access_token = $_SESSION['access_token'];

    // URL pour récupérer les informations de l'utilisateur
    $url = "https://graph.instagram.com/me?fields=id,username&access_token=$access_token";

    // Envoyer la requête GET pour obtenir les informations de l'utilisateur
    $user_info = file_get_contents($url);

    // Conversion du résultat JSON en tableau PHP
    $user = json_decode($user_info, true);

    // Affichage des informations de l'utilisateur
    if (isset($user['username']) && isset($user['id'])) {
        echo "Username : " . htmlspecialchars($user['username']) . "<br>";
        echo "ID : " . htmlspecialchars($user['id']) . "<br>";
    } else {
        echo "Erreur lors de la récupération des informations du profil.";
    }
} else {
    echo "Non connecté. Veuillez vous authentifier via Instagram.";
}
?>

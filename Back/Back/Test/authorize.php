<?php
session_start();

// Identifiants de l'application Instagram
$client_id = '3850726875254195'; // Remplace par ton Client ID
$redirect_uri = 'https://tonsite.com/callback.php'; // Remplace par l'URL de redirection
$scope = 'user_profile,user_media'; // Permet d'accéder aux informations de profil et de médias

// URL d'autorisation
$auth_url = "https://api.instagram.com/oauth/authorize?client_id=$client_id&redirect_uri=$redirect_uri&scope=$scope&response_type=code";

// Redirection vers la page d'autorisation
header("Location: $auth_url");
exit;
?>

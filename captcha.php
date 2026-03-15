<?php
// 1. Tes clés de sécurité
$secretKey = "6LcjK4ssAAAAAKEHypyG3oaE2u7cwATzZJSyJuFv"; // TA CLÉ SECRÈTE (image 2)

// 2. On récupère la réponse du captcha envoyée par le formulaire
$response = $_POST['g-recaptcha-response'];

// 3. On récupère l'IP de l'utilisateur (pour la vérification Google)
$remoteIp = $_SERVER['REMOTE_ADDR'];

// 4. On prépare l'appel à l'API Google
$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp";

// 5. On interroge Google (via file_get_contents ou curl)
$apiResponse = file_get_contents($url);
$decode = json_decode($apiResponse);

// 6. VERDICT
if ($decode->success == true) {
    // LE CAPTCHA EST VALIDE
    echo "Succès.";
    
    // ICI : Tu ajoutes ton code pour envoyer l'email ou enregistrer en SQL
    // Utilise des requêtes préparées (PDO) comme on a vu pour l'E5 !
    
} else {
    // LE CAPTCHA A ÉCHOUÉ (Robot ou tentative de fraude)
    echo "Erreur. Accès refusé.";
    http_response_code(403); // On renvoie un code d'erreur "Interdit"
}
?>
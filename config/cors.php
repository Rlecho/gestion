<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Routes concernées
    'allowed_methods' => ['*'], // Méthodes autorisées (GET, POST, etc.)
    'allowed_origins' => ['http://localhost'], // Autoriser les requêtes depuis localhost
    'allowed_origins' => ['http://localhost:3000'],
    'allowed_origins_patterns' => [], // Modèles d'origines autorisées
    'allowed_headers' => ['*'], // En-têtes autorisés
    'exposed_headers' => [], // En-têtes exposés
    'max_age' => 0, // Durée de mise en cache des pré-vérifications CORS
    'supports_credentials' => false, // Autoriser les cookies et les en-têtes d'authentification
];
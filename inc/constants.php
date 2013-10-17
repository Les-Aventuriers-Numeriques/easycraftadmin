<?php
/**
 * Constantes de configuration pour l'application
 */

switch ($app->config('mode')) {
  case 'development':
    define('ROOT_URL',    'http://localhost/easycraftadmin/');
  break;
  case 'production':
    define('ROOT_URL',    'http://eca.easy-company.fr/');
  break;
}

define('SERVER_IP', '37.59.47.34'); // IP du serveur
define('SERVER_PORT', 20059); // Port pour JSONAPI
define('USER_NAME', 'epoc'); // Utilisateur pour JSONAPI
define('SERVER_PASSWORD', 'redjtarlouze'); // Mot de passe pour JSONAPI
define('SERVER_SALT', 'dsj_kofdq@cmqc!é21'); // Grain de sel pour JSONAPI
define('APP_PASSWORD_HASH', 'f2928fb77fe7fff71403b75b31d2a470bb471581'); // Mot de passe de l'application (salt+mdp)

define('ADMIN_NAME', 'ADMIN'); // Nom affiché quand l'admin parle

define('CHAT_SELECTOR', '§');
?>
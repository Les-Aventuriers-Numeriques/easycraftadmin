<?php
/**
 * Fichier dispatcher de l'application
 */

session_start();

require('inc/slim/Slim.php'); // Le framework

// Classe pour envoyer des commandes à MC
require('inc/JSONAPI.php');
require('inc/EasyCraftAdminNetwork.php');


require('inc/DataValues.php');

function _isAuthenticated() {
  if (!isset($_SESSION['ECA']) or $_SESSION['ECA'] != APP_PASSWORD_HASH or empty($_SESSION['ECA'])) {
    return false;
  } else {
    return true;
  }
}

/**
 * Vérifie si l'utilisateur est authentifié (pour les middlewares des routes)
 */
function routeIsAuthenticated() {
  if (!_isAuthenticated()) {
    Slim::getInstance()->flash('error', 'Vous devez être authentifié pour accèder à ceci.');
    Slim::getInstance()->redirect('login');
  } else {
    return true;
  };
}

/**
 * Vérifie si l'utilisateur est authentifié (pour les templates)
 */
function returnIsAuthenticated() {
  if (!_isAuthenticated()) {
    return false;
  } else {
    return true;
  };
}

// Initialisation de l'application
$app = new Slim(array(
  'mode' => 'development',
  'templates.path' => 'templates'
));

// Configuration de l'application
require('inc/config.php');

require('inc/constants.php');

require('inc/EasyCraftAdmin.php'); // Classe qui permet de communiquer avec le serveur MC
$network = new EasyCraftAdminNetwork();

// Inclusion des différentes routes de l'application
require('inc/routes.php');
require('inc/routes_ajax.php');

$app->run(); // On lance tout
?>
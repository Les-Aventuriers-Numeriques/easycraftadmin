<?php
// Modes d'exécution
$app->configureMode('production', function () use ($app) {
  $app->config(array(
    'debug' => false,
    'log.enable' => true,
    'log.path' => 'logs'
  ));
});

$app->configureMode('development', function () use ($app) {
  $app->config(array(
    'debug' => true,
    'log.enable' => false
  ));
});

// Page 404
$app->notFound(function () use ($app) {
  $app->render('general/header.php', array('app' => $app, 'breadcrumb' => array('Erreur 404')));
  $app->render('404.php');
  $app->render('general/footer.php');
});

// Page d'erreur ghénérale
$app->error(function (Exception $e) use ($app) {
  $app->render('general/header.php', array('app' => $app, 'breadcrumb' => array('Erreur')));
  $app->render('error.php', array('e' => $e));
  $app->render('general/footer.php');
});
?>
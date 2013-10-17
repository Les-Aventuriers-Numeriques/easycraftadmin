<?php
/**
 * Routes génériques de l'application
 */

// -------------------------------------------------------------------------- //
// ACCUEIL
// -------------------------------------------------------------------------- //
$app->get('/', 'routeIsAuthenticated', function () use ($app, $network) {
  $server = $network->getServer();

  $app->render('general/header.php', array('app' => $app, 'breadcrumb' => array()));
  $app->render('home.php', array('app' => $app, 'server' => $server));
  $app->render('general/footer.php');
});

// -------------------------------------------------------------------------- //
// ACCUEIL
// -------------------------------------------------------------------------- //
$app->get('/home', 'routeIsAuthenticated', function () use ($app) {
  $app->redirect(ROOT_URL);
});

// -------------------------------------------------------------------------- //
// CONNEXION
// -------------------------------------------------------------------------- //
$app->get('/login', function () use ($app, $network) {
  $app->render('general/header.php', array('app' => $app, 'breadcrumb' => array('Connexion')));

  $test = $network->getServer();

  if (empty($test)) {
    $app->render('error.php', array('e' => new Exception('Le serveur est down ou JSONAPI n\'est pas installé ! Vérifiez la configuration')));
  } else {
    $app->render('login.php');
  }

  $app->render('general/footer.php');
});

$app->post('/login', function () use ($app) {
  $password = $app->request()->post('password');

  if (empty($password)) {
    $app->flash('alert', 'Veuillez renseigner un mot de passe.');
    $app->redirect(ROOT_URL.'login');
  }

  $password_sha1 = sha1(SERVER_SALT.$password);

  if ($password_sha1 == APP_PASSWORD_HASH) {
    $app->flash('success', 'Vous êtes authentifié !');
    $_SESSION['ECA'] = $password_sha1;
    $app->redirect(ROOT_URL.'home');
  } else {
    $app->flash('error', 'Mot de passe incorrect.');
    $app->redirect(ROOT_URL.'login');
  }
});

// -------------------------------------------------------------------------- //
// DECONNEXION
// -------------------------------------------------------------------------- //
$app->get('/logout', function () use ($app) {
  unset($_SESSION['ECA']);
  session_destroy();
  $app->flash('success', 'A bientôt !');
  $app->redirect(ROOT_URL.'login');
});

// -------------------------------------------------------------------------- //
// A PROPOS
// -------------------------------------------------------------------------- //
$app->get('/about', function () use ($app) {
  $app->render('general/header.php', array('app' => $app, 'breadcrumb' => array('about' => 'A propos')));
  $app->render('about.php');
  $app->render('general/footer.php');
});

// -------------------------------------------------------------------------- //
// JOUEURS
// -------------------------------------------------------------------------- //
$app->get('/players', 'routeIsAuthenticated', function () use ($app, $network) {
  $current_players_count = $network->getPlayercount();
  $max_player_count = $network->getPlayerLimit();
  $player_list = $network->getPlayers();

  $app->render('general/header.php', array('app' => $app, 'breadcrumb' => array('players' => 'Joueurs')));
  $app->render('players.php', array('app' => $app, 'current_players_count' => $current_players_count, 'max_player_count' => $max_player_count, 'player_list' => $player_list));
  $app->render('general/chat.php');
  $app->render('general/footer.php');
});

// -------------------------------------------------------------------------- //
// SERVEUR
// -------------------------------------------------------------------------- //
$app->get('/server', 'routeIsAuthenticated', function () use ($app, $network) {
  $app->render('general/header.php', array('app' => $app, 'breadcrumb' => array('server' => 'Serveur')));
  $app->render('server.php', array('app' => $app));
  $app->render('general/chat.php');
  $app->render('general/footer.php');
});

// -------------------------------------------------------------------------- //
// SERVEUR : GRAPHIQUE USAGE JAVA
// -------------------------------------------------------------------------- //
$app->get('/server_java_usage', 'routeIsAuthenticated', function () use ($app, $network) {
  $response = $app->response();
  $response['Content-Type'] = 'image/png';

  $java_memory_total = round($network->getJavaMemoryTotal() / (1024*1024), 2);
  $java_memory_usage = round($network->getJavaMemoryUsage() / (1024*1024), 2);
  $java_memory_free = $java_memory_total - $java_memory_usage;

  require('inc/pchart/class/pData.class.php');
  require('inc/pchart/class/pDraw.class.php');
  require('inc/pchart/class/pPie.class.php');
  require('inc/pchart/class/pImage.class.php');

  $calc_java_memory_usage = (100 * $java_memory_usage) / $java_memory_total;
  $calc_java_memory_free = (100 * $java_memory_free) / $java_memory_total;

  $JavaUsageData = new pData();
  $JavaUsageData->addPoints(array($calc_java_memory_usage, $calc_java_memory_free), 'Value');
  $JavaUsageData->addPoints(array('Utilisée ('.$java_memory_usage.' Mo)', 'Disponible ('.$java_memory_free.' Mo)'), 'Legend');
  $JavaUsageData->setAbscissa('Legend');

  $JavaUsageImage = new pImage(340, 165, $JavaUsageData);
  $JavaUsageImage->setFontProperties(array('FontName' => 'inc/pchart/fonts/verdana.ttf', 'FontSize' => 10));
  $JavaUsageImage->drawText(10, 18, 'Total : '.$java_memory_total.' Mo', array('R' => 0, 'G' => 0, 'B' => 0));

  $JavaUsagePie = new pPie($JavaUsageImage, $JavaUsageData);
  $JavaUsagePie->setSliceColor(0, array('R' => 0, 'G' => 136, 'B' => 204));
  $JavaUsagePie->setSliceColor(1, array('R' => 170, 'G' => 170, 'B' => 170));
  $JavaUsagePie->draw3DPie(85, 85, array('WriteValues' => TRUE, 'Border' => TRUE));
  $JavaUsagePie->drawPieLegend(15, 145, array('Mode' => LEGEND_HORIZONTAL, 'R' => 200, 'G' => 200, 'B' => 200));

  $JavaUsageImage->stroke();
});

// -------------------------------------------------------------------------- //
// SERVEUR : GRAPHIQUE USAGE DISQUE
// -------------------------------------------------------------------------- //
$app->get('/server_disk_usage', 'routeIsAuthenticated', function () use ($app, $network) {
  $response = $app->response();
  $response['Content-Type'] = 'image/png';

  $disk_free_space = round($network->getDiskFreeSpace() / (1024*1024*1024), 2);
  $disk_size = round($network->getDiskSize() / (1024*1024*1024), 2);
  $disk_usage = round($network->getDiskUsage() / (1024*1024*1024), 2);

  require('inc/pchart/class/pData.class.php');
  require('inc/pchart/class/pDraw.class.php');
  require('inc/pchart/class/pPie.class.php');
  require('inc/pchart/class/pImage.class.php');

  $calc_disk_memory_usage = (100 * $disk_usage) / $disk_size;
  $calc_disk_memory_free = (100 * $disk_free_space) / $disk_size;

  $DiskUsageData = new pData();
  $DiskUsageData->addPoints(array($calc_disk_memory_usage, $calc_disk_memory_free), 'Value');
  $DiskUsageData->addPoints(array('Utilisé ('.$disk_usage.' Go)', 'Disponible ('.$disk_free_space.' Go)'), 'Legend');
  $DiskUsageData->setAbscissa('Legend');

  $DiskUsageImage = new pImage(340, 165, $DiskUsageData);
  $DiskUsageImage->setFontProperties(array('FontName' => 'inc/pchart/fonts/verdana.ttf', 'FontSize' => 10));
  $DiskUsageImage->drawText(10, 18, 'Total : '.$disk_size.' Go', array('R' => 0, 'G' => 0, 'B' => 0));

  $DiskUsagePie = new pPie($DiskUsageImage, $DiskUsageData);
  $DiskUsagePie->setSliceColor(0, array('R' => 0, 'G' => 136, 'B' => 204));
  $DiskUsagePie->setSliceColor(1, array('R' => 170, 'G' => 170, 'B' => 170));
  $DiskUsagePie->draw3DPie(85, 85, array('WriteValues' => TRUE, 'Border' => TRUE));
  $DiskUsagePie->drawPieLegend(15, 145, array('Mode' => LEGEND_HORIZONTAL, 'R' => 200, 'G' => 200, 'B' => 200));

  $DiskUsageImage->stroke();
});

// -------------------------------------------------------------------------- //
// PERMISSIONS
// -------------------------------------------------------------------------- //
$app->get('/permissions', 'routeIsAuthenticated', function () use ($app, $network) {
  $permission_list = $network->getAllPermissions();
  $group_list = $network->getAllGroups();

  $app->render('general/header.php', array('app' => $app, 'breadcrumb' => array('permissions' => 'Permissions')));
  $app->render('permissions.php', array('app' => $app, 'permission_list' => $permission_list, 'group_list' => $group_list));
  $app->render('general/chat.php');
  $app->render('general/footer.php');
});

// -------------------------------------------------------------------------- //
// PLUGINS
// -------------------------------------------------------------------------- //
$app->get('/plugins', 'routeIsAuthenticated', function () use ($app, $network) {
  $plugin_list = $network->getPlugins();

  $app->render('general/header.php', array('app' => $app, 'breadcrumb' => array('plugins' => 'Plugins')));
  $app->render('plugins.php', array('app' => $app, 'plugin_list' => $plugin_list));
  $app->render('general/chat.php');
  $app->render('general/footer.php');
});

// -------------------------------------------------------------------------- //
// MONDES
// -------------------------------------------------------------------------- //
$app->get('/worlds', 'routeIsAuthenticated', function () use ($app, $network) {
  $world_list = $network->getWorlds();

  $app->render('general/header.php', array('app' => $app, 'breadcrumb' => array('worlds' => 'Mondes')));
  $app->render('worlds.php', array('app' => $app, 'world_list' => $world_list));
  $app->render('general/chat.php');
  $app->render('general/footer.php');
});

// -------------------------------------------------------------------------- //
// WHITELIST
// -------------------------------------------------------------------------- //
$app->get('/whitelist', 'routeIsAuthenticated', function () use ($app, $network) {
  $whitelist = $network->getWhitelist();
  sort($whitelist);

  $app->render('general/header.php', array('app' => $app, 'breadcrumb' => array('whitelist' => 'Whitelist')));
  $app->render('whitelist.php', array('app' => $app, 'whitelist' => $whitelist));
  $app->render('general/chat.php');
  $app->render('general/footer.php');
});
?>
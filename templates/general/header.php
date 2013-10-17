<?php
$active_section = $app->request()->getResourceUri();

if (isset($app->view()->data['breadcrumb'])) {
  $breadcrumb = EasyCraftAdmin::generateBreadcrumb($app->view()->data['breadcrumb']);
  $breadcrumb_html_title = EasyCraftAdmin::generateBreadcrumb($app->view()->data['breadcrumb'], true);
} else {
  $breadcrumb = EasyCraftAdmin::generateBreadcrumb(array('Erreur 404'));
  $breadcrumb_html_title = EasyCraftAdmin::generateBreadcrumb(array('Erreur 404'), true);
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>=EaSy= CraftAdmin <?php echo $breadcrumb_html_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="=EaSy= CraftAdmin">
    <meta name="author" content="Epoc">

    <link href="<?php echo ROOT_URL; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ROOT_URL; ?>css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo ROOT_URL; ?>css/easycraftadmin.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="<?php echo ROOT_URL; ?>img/minecraft_icon.png">
  </head>

  <body>
    <div class="modal" id="modal_dialog">

    </div>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="home">=EaSy= CraftAdmin</a>
          <div class="nav-collapse">
            <ul class="nav">
              <?php if (returnIsAuthenticated()): ?>
              <li <?php if ($active_section == '/players') echo 'class="active"'; ?>><a href="<?php echo ROOT_URL; ?>players" rel="tooltip" title="Gérer les joueurs">Joueurs</a></li>
              <li <?php if ($active_section == '/whitelist') echo 'class="active"'; ?>><a href="<?php echo ROOT_URL; ?>whitelist" rel="tooltip" title="Gérer la liste d'accès">Whitelist</a></li>
              <li <?php if ($active_section == '/banlist') echo 'class="active"'; ?>><a href="<?php echo ROOT_URL; ?>#" rel="tooltip" title="Gérer les joueurs bannis">Banlist</a></li>
              <li <?php if ($active_section == '/permissions') echo 'class="active"'; ?>><a href="<?php echo ROOT_URL; ?>permissions" rel="tooltip" title="Gérer les permissions des joueurs">Permissions</a></li>
              <li <?php if ($active_section == '/economy') echo 'class="active"'; ?>><a href="<?php echo ROOT_URL; ?>#" rel="tooltip" title="Gérer l'économie">Economie</a></li>
              <li <?php if ($active_section == '/plugins') echo 'class="active"'; ?>><a href="<?php echo ROOT_URL; ?>plugins" rel="tooltip" title="Gérer les plugins">Plugins</a></li>
              <li <?php if ($active_section == '/worlds') echo 'class="active"'; ?>><a href="<?php echo ROOT_URL; ?>worlds" rel="tooltip" title="Gérer les mondes">Mondes</a></li>
              <li <?php if ($active_section == '/server') echo 'class="active"'; ?>><a href="<?php echo ROOT_URL; ?>server" rel="tooltip" title="Gérer le serveur lui-même">Serveur</a></li>
              <li <?php if ($active_section == '/logs') echo 'class="active"'; ?>><a href="<?php echo ROOT_URL; ?>#" rel="tooltip" title="Voir les logs">Logs</a></li>
              <?php endif; ?>
              <li <?php if ($active_section == '/about') echo 'class="active"'; ?>><a href="<?php echo ROOT_URL; ?>about" rel="tooltip" title="A propos de =EaSy= CraftAdmin">A propos</a></li>
            </ul>
            <?php if (returnIsAuthenticated()): ?>
            <a href="<?php echo ROOT_URL; ?>logout" class="btn btn-inverse btn-small pull-right" rel="tooltip" title="Fermer la session actuelle"><i class="icon-minus-sign icon-white"></i> Déconnexion</a>
            <?php endif; ?>
         </div>
          <?php if (!returnIsAuthenticated()): ?>
          <div style="margin:0; padding:0; margin-top: 11px; padding-bottom: 11px">&nbsp;</div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="container">
      <ul class="breadcrumb">
        <?php echo $breadcrumb; ?>
      </ul>

      <?php
      if (isset($_SESSION['slim.flash']['error'])) {
        echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a> '.$_SESSION['slim.flash']['error'].'</div>';
      } elseif (isset($_SESSION['slim.flash']['success'])) {
        echo '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a> '.$_SESSION['slim.flash']['success'].'</div>';
      } elseif (isset($_SESSION['slim.flash']['alert'])) {
        echo '<div class="alert"><a class="close" data-dismiss="alert">×</a> '.$_SESSION['slim.flash']['alert'].'</div>';
      }
      ?>
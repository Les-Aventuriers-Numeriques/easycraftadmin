<div class="hero-unit">
  <h1><?php echo $server['serverName']; ?> <small><?php echo $server['name'].' '.$server['version']; ?></small></h1>
  <p>&nbsp;</p>
  <p>IP : <?php echo SERVER_IP; ?>:<?php echo $server['port']; ?></p>
  <p>Actuellement <?php echo count($server['players']); ?> joueur(s) sur un maximum de <?php echo $server['maxPlayers']; ?> sur <?php echo count($server['worlds']); ?> monde(s)</p>
  <p>&nbsp;</p>
  <p>
    <a class="btn btn-primary btn-large" href="<?php echo ROOT_URL; ?>players">Liste des joueurs <i class="icon-forward icon-white"></i></a>
  </p>
</div>
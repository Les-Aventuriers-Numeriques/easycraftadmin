<div class="page-header">
  <h1>Joueurs</h1>
</div>

<p>Il y a actuellement <b><?php echo $current_players_count; ?></b> joueur(s) en ligne sur un maximum de <b><?php echo $max_player_count; ?></b>.</p>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Monde</th>
      <th>Santé</th>
      <th>Dernière connexion</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (!empty($player_list)):
      foreach ($player_list as $key => $player_infos):
        $player_online = true;

        if (isset($player_infos['lastPlayed'])) {
          $player_online = false;
        }

        $class_player_health = '';
        $player_op = false;
        $player_op_style = 'none';
        $player_deop_style = 'none';
        $player_last_played = '';
        $world_name = '';
        $player_health_text = '';
        $player_banned = false;
        $player_whitelisted = false;
        $more_infos = '';

        $player_name = $player_infos['name'];

        if (!$player_online) { // Joueur hors ligne
          $player_last_played = date('d/m/Y H:m:s', $player_infos['lastPlayed']);
          $player_banned = $player_infos['banned'];
          $player_whitelisted = $player_infos['whitelisted'];
        } else {
          $player_health = $player_infos['health'];
          $player_op = $player_infos['op'];
          $world_name = $player_infos['worldInfo']['name'];

          if ($player_health > 15) {
            $class_player_health = 'success';
          } elseif ($player_health <= 15 and $player_health > 7) {
            $class_player_health = 'warning';
          } else {
            $class_player_health = 'error';
          }

          $player_health_text = '<span class="label label-'.$class_player_health.'">'.$player_health.'/20</span>';

          if ($player_op === true) {
            $player_op_style = 'none';
            $player_deop_style = 'block';
          } else {
            $player_op_style = 'block';
            $player_deop_style = 'none';
          }

          $player_ip = $player_infos['ip'];
          $player_level = $player_infos['level'];
          $player_xp = $player_infos['experience'];
          $player_foodlevel = $player_infos['foodLevel'];

          if ($player_foodlevel > 15) {
            $class_player_foodlevel = 'success';
          } elseif ($player_foodlevel <= 15 and $player_foodlevel > 7) {
            $class_player_foodlevel = 'warning';
          } else {
            $class_player_foodlevel = 'error';
          }

          $player_in_vehicle = $player_infos['inVehicle'];
          $player_sleeping = $player_infos['sleeping'];
          $player_sneaking = $player_infos['sneaking'];
          $player_sprinting = $player_infos['sprinting'];

          $player_location_z = round($player_infos['location']['z']);
          $player_location_y = round($player_infos['location']['y']);
          $player_location_x = round($player_infos['location']['x']);

          $more_infos_content = '<b>IP :</b> '.$player_ip.'<br />';
          $more_infos_content .= '<b>Niveau :</b> '.$player_level.'<br />';
          $more_infos_content .= '<b>Expérience :</b> '.$player_xp.'<br />';
          $more_infos_content .= '<b>Niveau de faim :</b> <span class="label label-'.$class_player_foodlevel.'">'.$player_foodlevel.'/20</span><br />';
          $more_infos_content .= '<b>Dans véhicule :</b> '.(($player_in_vehicle) ? 'Oui' : 'Non').'<br />';
          $more_infos_content .= '<b>Dort :</b> '.(($player_sleeping) ? 'Oui' : 'Non').'<br />';
          $more_infos_content .= '<b>Se faufile :</b> '.(($player_sneaking) ? 'Oui' : 'Non').'<br />';
          $more_infos_content .= '<b>Sprinte :</b> '.(($player_sprinting) ? 'Oui' : 'Non').'<br />';
          $more_infos_content .= '<b>Localisation :</b> Z : '.$player_location_z.' Y : '.$player_location_y.' X : '.$player_location_x;

          $more_infos = '<span class="label" data-content="'.htmlspecialchars($more_infos_content).'" data-original-title="Détails de '.$player_name.'" rel="popover">Plus d\'infos</span>';
        }
        ?>
        <tr id="tr_<?php echo $player_name; ?>">
          <td class="player_name_op"><?php echo $player_name; ?> <?php echo ($player_op === true) ? '<span class="label label-important player_admin">Admin</span>' : ''; ?> <?php echo ($player_banned === true) ? '<span class="label label-important">Banni</span>' : ''; ?> <?php echo ($player_whitelisted === true) ? '<span class="label label-success">Whitelisté</span>' : ''; ?> <?php echo $more_infos; ?></td>
          <td class="world_name"><?php echo $world_name; ?></td>
          <td class="player_health"><?php echo $player_health_text; ?></td>
          <td class="player_last_played"><?php echo $player_last_played; ?></td>
          <td class="player_actions">
            <?php if ($player_online): ?>
            <div class="btn-group">
              <button class="btn btn-primary dropdown-toggle btn-mini" data-toggle="dropdown" href="#">Actions <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="#" class="player_ban">Bannir</a></li>
                <li><a href="#" class="player_kick">Ejecter</a></li>
                <li class="divider"></li>
                <li style="display: <?php echo $player_deop_style; ?>" class="player_deop"><a href="#" class="player_deop">Dé-opper</a></li>
                <li style="display: <?php echo $player_op_style; ?>" class="player_op"><a href="#" class="player_op">Opper</a></li>
                <li class="divider"></li>
                <li><a href="#" class="player_delfromwhitelist">Retirer de la whitelist</a></li>
                <li class="divider"></li>
                <li><a href="#">Donner de l'expérience...</a></li>
                <li><a href="#">Enlever de l'expérience...</a></li>
                <li class="divider"></li>
                <li><a href="#" class="player_tp">Téléporter...</a></li>
                <li><a href="#" class="player_give">Donner un objet...</a></li>
                <li><a href="#" class="player_inv">Voir son inventaire</a></li>
              </ul>
            </div>
            <?php endif; ?>
          </td>
        </tr>
        <?php
        endforeach;
    else:
    ?>
      <tr>
        <td colspan="4">Il n'y a actuellement aucun joueur connecté :(</td>
      </tr>
    <?php
    endif;
    ?>
  </tbody>
</table>

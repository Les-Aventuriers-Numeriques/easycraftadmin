<?php
/**
 * Routes spécifiques AJAX de l'application
 */

// -------------------------------------------------------------------------- //
// RECUPERATION DERNIERS CONTENUS CHAT
// -------------------------------------------------------------------------- //
$app->get('/ajax/getlatestchat', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    echo $network->getLatestChat();
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// ENVOI D'UN MESSAGE SUR LE CHAT
// -------------------------------------------------------------------------- //
$app->post('/ajax/textmsg', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $textmsg = $app->request()->post('textmsg');

    if (!empty($textmsg)) {
      $network->broadcast(str_replace('&', '&&', $textmsg));
    }
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// CHANGEMENT METEO
// -------------------------------------------------------------------------- //
$app->get('/ajax/switchweather', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $network->broadcast('Changement de la météo', '[SERVEUR]');
    $network->switchWeather();
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// CHANGEMENT HEURE
// -------------------------------------------------------------------------- //
$app->post('/ajax/changetime', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $time = $app->request()->post('time');

    if (!empty($time)) {
      switch ($time) {
        case 'day':
          $text = 'jour';
        break;
        case 'night':
          $text = 'nuit';
        break;
      }

      $network->broadcast('Changement d\'heure : il fait maintenant '.$text, '[SERVEUR]');
      $network->changeTime($time);
    }
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// UTILISATION WHITELIST
// -------------------------------------------------------------------------- //
$app->post('/ajax/whitelistuse', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $use = $app->request()->post('use');

    if (!empty($use)) {
      switch ($use) {
        case 'on':
          $text = 'ACTIVE';
        break;
        case 'off':
          $text = 'INACTIVE';
        break;
      }

      $network->broadcast('La whitelist est maintenant '.$text, '[SERVEUR]');
      $network->whitelistUse($use);
    }
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// RECHARGEMENT WHITELIST
// -------------------------------------------------------------------------- //
$app->get('/ajax/whitelistreload', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $network->whitelistReload();
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// FENETRE MODALE : INVENTAIRE JOUEUR
// -------------------------------------------------------------------------- //
$app->get('/ajax/modal/player_inv', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $player_name = $app->request()->get('player_name');
    $player = $network->getPlayer($player_name);

    echo $app->render('modal/inv.php', array('player_inv' => $player['inventory']));
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// FENETRE MODALE : KICK
// -------------------------------------------------------------------------- //
$app->get('/ajax/modal/player_kick', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    echo $app->render('modal/kick.php');
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// FENETRE MODALE : BAN
// -------------------------------------------------------------------------- //
$app->get('/ajax/modal/player_ban', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    echo $app->render('modal/ban.php');
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// FENETRE MODALE : TELEPORTER
// -------------------------------------------------------------------------- //
$app->get('/ajax/modal/player_tp', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $player_list = $network->getPlayersNames();

    echo $app->render('modal/tp.php', array('player_list' => $player_list));
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// FENETRE MODALE : DONNER AU JOUEUR
// -------------------------------------------------------------------------- //
$app->get('/ajax/modal/player_give', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $data_values = new DataValues();

    echo $app->render('modal/give.php', array('data_values' => $data_values));
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// ACTIONS SUR UN PLUGIN : DESACTIVER
// -------------------------------------------------------------------------- //
$app->post('/ajax/plugin/disable', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $plugin_name = $app->request()->post('plugin_name');

    if (!empty($plugin_name)) {
      $network->disablePlugin($plugin_name);
    }
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// ACTIONS SUR UN PLUGIN : ACTIVER
// -------------------------------------------------------------------------- //
$app->post('/ajax/plugin/enable', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $plugin_name = $app->request()->post('plugin_name');

    if (!empty($plugin_name)) {
      $network->enablePlugin($plugin_name);
    }
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// ACTIONS SUR UN JOUEUR : KICK
// -------------------------------------------------------------------------- //
$app->post('/ajax/player/kick', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $player_name = $app->request()->post('player_name');
    $reason = $app->request()->post('reason');

    if (!empty($player_name)) {
      if (!empty($reason)) {
        $info = 'Vous avez été éjecté du serveur : '.$reason;
        $reason = ' (Raison : '.$reason.')';
      } else {
        $info = '';
      }

      $network->broadcast('Le joueur '.$player_name.' a été éjecté'.$reason, '[SERVEUR]');

      if (empty($info)) {
        $info = 'Vous avez été éjecté du serveur';
      }

      $network->playerKick($player_name, $info);
    }
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// ACTIONS SUR UN JOUEUR : BAN
// -------------------------------------------------------------------------- //
$app->post('/ajax/player/ban', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $player_name = $app->request()->post('player_name');
    $reason = $app->request()->post('reason');

    if (!empty($player_name)) {
      if (!empty($reason)) {
        $info = 'Vous avez été banni du serveur : '.$reason;
        $reason = ' (Raison : '.$reason.')';
      } else {
        $info = '';
      }

      $network->broadcast('Le joueur '.$player_name.' a été banni'.$reason, '[SERVEUR]');

      if (empty($info)) {
        $info = 'Vous avez été banni du serveur';
      }

      $network->playerBan($player_name, $info);
    }
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// ACTIONS SUR UN JOUEUR : OPPER
// -------------------------------------------------------------------------- //
$app->post('/ajax/player/op', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $player_name = $app->request()->post('player_name');

    if (!empty($player_name)) {
      $network->broadcast($player_name.' est maintenant admin du serveur', '[SERVEUR]');
      $network->playerOp($player_name);
    }
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// ACTIONS SUR UN JOUEUR : DE-OPPER
// -------------------------------------------------------------------------- //
$app->post('/ajax/player/deop', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $player_name = $app->request()->post('player_name');

    if (!empty($player_name)) {
      $network->broadcast($player_name.' n\'est plus admin du serveur', '[SERVEUR]');
      $network->playerDeop($player_name);
    }
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// ACTIONS SUR UN JOUEUR : TELEPORTER
// -------------------------------------------------------------------------- //
$app->post('/ajax/player/tp', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $player_name = $app->request()->post('player_name');
    $tp_to = $app->request()->post('tp_to');

    if (!empty($player_name) and !empty($tp_to)) {
      $network->broadcast($player_name.' a été téléporté vers '.$tp_to, '[SERVEUR]');
      $network->playerTp($player_name, $tp_to);
    }
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// ACTIONS SUR UN JOUEUR : RETIRER DE LA WHITELIST
// -------------------------------------------------------------------------- //
$app->post('/ajax/player/delfromwhitelist', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $player_name = $app->request()->post('player_name');

    if (!empty($player_name)) {
      $network->broadcast($player_name.' a été supprimé de la whitelist !', '[SERVEUR]');
      $network->playerDelFromWhiteList($player_name);
    }
  } else {
    $app->halt(405);
  }
});

// -------------------------------------------------------------------------- //
// ACTIONS SUR UN JOUEUR : RETIRER DE LA WHITELIST
// -------------------------------------------------------------------------- //
$app->post('/ajax/player/give', 'isAuthenticated', function () use ($app, $network) {
  if ($app->request()->isAjax()) {
    $player_name = $app->request()->post('player_name');
    $item_id = $app->request()->post('item_id');
    $amount = $app->request()->post('amount');

    if (!empty($player_name) and !empty($item_id)) {
      $item_id = explode(':', $item_id);

      $network->playerGive($player_name, $item_id[0], $item_id[1], (empty($amount) ? 0 : $amount));
    }
  } else {
    $app->halt(405);
  }
});
?>
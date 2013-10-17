<?php
/**
 * Classe permettant de communiquer avec le serveur MC
 */
class EasyCraftAdminNetwork extends JSONAPI {
  /**
   * Constructeur
   */
  public function __construct() {
    parent::__construct(SERVER_IP, SERVER_PORT, USER_NAME, SERVER_PASSWORD, SERVER_SALT);
  }

  /**
   * Traite les réponses des appels à JSONAPI
   */
  private function getResult($result, $multiple = false) {
    $return = array();

    if ($multiple === true) {
      foreach ($result['success'] as $res) {
        $return = array_merge($return, $res['success']);
      }

      return $return;
    } else {
      return $result['success'];
    }
  }

  /**
   * Récupère les infos générales du serveur
   */
  public function getServer() {
    return $this->getResult($this->call('getServer'));
  }

  /**
   * Récupère les 50 dernières lignes du chat
   */
  public function getLatestChat() {
    $result = array_reverse($this->getResult($this->call('getLatestChats')));

    foreach ($result as $key => $value) {
      $result[$key]['message'] = EasyCraftAdmin::MCColorToHtml($value['message']);
      $result[$key]['player'] = EasyCraftAdmin::MCColorToHtml($value['player']);
    }

    return json_encode($result);
  }

  /**
   * Récupère la liste des mondes du serveur
   */
  public function getWorlds() {
    return $this->getResult($this->call('getWorlds'));
  }

  /**
   * Récupère la whitelist du serveur
   */
  public function getWhitelist() {
    return $this->getResult($this->call('getWhitelist'));
  }

  /**
   * Récupère la liste des plugins du serveur
   */
  public function getPlugins() {
    return $this->getResult($this->call('getPlugins'));
  }

  /**
   * Désactive un plugin
   */
  public function disablePlugin($plugin_name) {
    $this->call('disablePlugin', array($plugin_name));
  }

  /**
   * Désactiver un plugin
   */
  public function enablePlugin($plugin_name) {
    $this->call('enablePlugin', array($plugin_name));
  }

  /**
   * Retourne le nombre de joueurs actuellement connectés
   */
  public function getPlayercount() {
    return $this->getResult($this->call('getPlayerCount'));
  }

  /**
   * Retourne le nombre de joueurs maximum possible
   */
  public function getPlayerLimit() {
    return $this->getResult($this->call('getPlayerLimit'));
  }

  /**
   * Envoie un message normal sur le chat
   */
  public function broadcast($msg) {
    $this->call('broadcastWithName', array(CHAT_SELECTOR.'6'.$msg, CHAT_SELECTOR.'c'.ADMIN_NAME));
  }

  /**
   * Récupère l'objet représentant un joueur
   */
  public function getPlayer($player_name) {
    return $this->getResult($this->call('getPlayer', array($player_name)));
  }

  /**
   * Retourne la liste des joueurs actuellement connectés en tant qu'objet
   * RETOURNE EGALEMENT LES JOUEURS QUI SE SONT DEJA CONNECTES (OFFLINE)
   */
  public function getPlayers() {
    return $this->getResult($this->callMultiple(array('getPlayers', 'getOfflinePlayers'), array(array(), array())), true);
  }

  /**
   * Retourne la liste des nom des joueurs
   */
  public function getPlayersNames() {
    return $this->getResult($this->call('getPlayerNames'));
  }

  /**
   * Change la météo
   */
  public function switchWeather() {
    $this->call('runConsoleCommand', array('toggledownfall'));
  }

  /**
   * Change l'heure
   */
  public function changeTime($time) {
    $this->call('runConsoleCommand', array('time '.$time));
  }

  /**
   * Utilisation de la whitelist
   */
  public function whitelistUse($use) {
    $this->call('runConsoleCommand', array('whitelist '.$use));
  }

  /**
   * Rechargement de la whitelist
   */
  public function whitelistReload() {
    $this->call('runConsoleCommand', array('whitelist reload'));
  }

  /**
   * Ejecte un joueur
   */
  public function playerKick($player_name, $reason) {
    $this->call('kickPlayer', array($player_name, $reason));
  }

  /**
   * Banni un joueur
   */
  public function playerBan($player_name, $reason) {
    if (!empty($reason)) {
      $this->call('banWithReason', array($player_name, $reason));
    } else {
      $this->call('ban', array($player_name));
    }
  }

  /**
   * Oppe un joueur
   */
  public function playerOp($player_name) {
    $this->call('opPlayer', array($player_name));
  }

  /**
   * Dé-oppe un joueur
   */
  public function playerDeop($player_name) {
    $this->call('deopPlayer', array($player_name));
  }

  /**
   * Téléporte un joueur
   */
  public function playerTp($player_name, $tp_to) {
    $this->call('teleport', array($player_name, $tp_to));
  }

  /**
   * Supprime un joueur de la whitelist
   */
  public function playerDelFromWhiteList($player_name) {
    $this->call('removeFromWhitelist', array($player_name));
  }

  /**
   * Donne un objet à un joueur
   */
  public function playerGive($player_name, $item_id, $value, $amount = 64) {
    $this->call('givePlayerItemWithData', array($player_name, $item_id, $amount, $value));
  }

  /**
   * Retourne les permissions de tous les joueurs
   */
  public function getAllPermissions() {
    return $this->getResult($this->call('permissions.getAllPermissions'));
  }

  /**
   * Retourne tous les groupes de permission du serveur
   */
  public function getAllGroups() {
    return $this->getResult($this->call('permissions.getAllGroups'));
  }

  /**
   * Récupère l'espace disque libre en bits
   */
  public function getDiskFreeSpace() {
    return $this->getResult($this->call('system.getDiskFreeSpace'));
  }

  /**
   * Récupère la taille totale du disque en bits
   */
  public function getDiskSize() {
    return $this->getResult($this->call('system.getDiskSize'));
  }

  /**
   * Récupère l'espace disque utilisé sur le disque
   */
  public function getDiskUsage() {
    return $this->getResult($this->call('system.getDiskUsage'));
  }

  /**
   * Récupère la taille mémoire allouée à Java
   */
  public function getJavaMemoryTotal() {
    return $this->getResult($this->call('system.getJavaMemoryTotal'));
  }

  /**
   * Récupère la taille mémoire utilisée par Java
   */
  public function getJavaMemoryUsage() {
    return $this->getResult($this->call('system.getJavaMemoryUsage'));
  }
}
?>
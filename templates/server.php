<div class="page-header">
  <h1>Serveur</h1>
</div>

<form class="form-horizontal">
  <fieldset>
    <div class="control-group">
      <label class="control-label">Serveur</label>
      <div class="controls">
        <div class="btn-group">
          <a class="btn">Démarrer</a>
          <a class="btn btn-danger" data-content="Le serveur s'arrêteras et ne redémarreras pas !" data-placement="bottom" data-original-title="Avertissement" rel="popover">Arrêter</a>
          <a class="btn btn-danger" data-content="Le serveur redémarreras mais la console web ne seras pas accessible pendant ce temps !" data-placement="bottom"  data-original-title="Avertissement" rel="popover">Redémarrer</a>
        </div>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Changer de météo</label>
      <div class="controls">
        <a class="btn" href="#" id="server_switchweather">Changer</a>
        <p class="help-block">S'il pleut, il feras beau et  vice versa</p>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Changer l'heure</label>
      <div class="controls">
        <div class="btn-group" data-toggle="buttons-radio">
          <a class="btn server_changetime" id="night">Nuit</a>
          <a class="btn server_changetime" id="day">Jour</a>
        </div>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Utilisation de la whitelist</label>
      <div class="controls">
        <div class="btn-group">
          <a class="btn server_whitelistuse" id="on">Activer</a>
          <a class="btn btn-danger server_whitelistuse" id="off" data-content="Toute le monde pourras accèder au serveur !" data-placement="bottom" data-original-title="Avertissement" rel="popover">Désactiver</a>
        </div>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Recharger la whitelist</label>
      <div class="controls">
        <a class="btn" href="#" id="server_whitelistreload">Recharger</a>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Mémoire Java</label>
      <div class="controls">
        <img src="<?php echo ROOT_URL; ?>server_java_usage" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Espace disque</label>
      <div class="controls">
        <img src="<?php echo ROOT_URL; ?>server_disk_usage" />
      </div>
    </div>
 </fieldset>
</form>
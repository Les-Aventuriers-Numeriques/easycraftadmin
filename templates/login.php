<div class="page-header">
  <h1>Veuillez vous authentifier</h1>
</div>

<form action="<?php echo ROOT_URL; ?>login" method="post" class="well form-horizontal">
  <fieldset>
    <div class="control-group">
      <label class="control-label" for="input01">Mot de passe : </label>
      <div class="controls">
        <input name="password" class="input-xlarge" type="password" />
      </div>
    </div>

    <div class="control-group">
      <div class="controls">
        <button class="btn btn-primary" type="submit">Connexion</button>
      </div>
    </div>
  </fieldset>
</form>
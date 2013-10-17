<div class="page-header">
  <h1>Whitelist</h1>
</div>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th colspan="2"><a class="btn btn-primary" href="<?php echo ROOT_URL; ?>#">Ajouter un joueur...</a></th>
    </tr>
    <tr>
      <th>Nom</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (!empty($whitelist)):
      foreach ($whitelist as $key => $player_name):
        ?>
        <tr id="tr_<?php ?>">
          <td><?php echo $player_name; ?></td>
          <td>&nbsp;</td>
        </tr>
        <?php
        endforeach;
    else:
    ?>
      <tr>
        <td colspan="2">La whitelist est vide</td>
      </tr>
    <?php
    endif;
    ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="2"><a class="btn btn-primary" href="<?php echo ROOT_URL; ?>#">Ajouter un joueur...</a></th>
    </tr>
  </tfoot>
</table>

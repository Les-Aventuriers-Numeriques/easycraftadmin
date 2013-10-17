<div class="page-header">
  <h1>Plugins</h1>
</div>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Version</th>
      <th>Activé ?</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (!empty($plugin_list)):
      foreach ($plugin_list as $key => $plugin_infos):
        $plugin_name = $plugin_infos['name'];
        $plugin_version = $plugin_infos['version'];
        
        if ($plugin_infos['enabled'] === true) {
          $plugin_enabled_style = 'inline-block';
          $plugin_disabled_style = 'none';
          $plugin_action_enable_style = 'none';
          $plugin_action_disable_style = 'inline-block';
        } else {
          $plugin_enabled_style = 'none';
          $plugin_disabled_style = 'inline-block';
          $plugin_action_enable_style = 'inline-block';
          $plugin_action_disable_style = 'none';
        }
        
        if (!empty($plugin_infos['website'])) {
          $plugin_website = ' <a class="label" href="'.$plugin_infos['website'].'">Site</a>';
        } else {
          $plugin_website = '';
        }
        
        if (!empty($plugin_infos['description'])) {
          $plugin_description = ' <span class="label" rel="popover" data-original-title="Description" data-content="'.$plugin_infos['description'].'">Description</span>';
        } else {
          $plugin_description = '';
        }
        ?>
        <tr id="tr_<?php echo $plugin_name; ?>">
          <td><b><?php echo $plugin_name; ?></b><?php echo $plugin_website; ?><?php echo $plugin_description; ?></td>
          <td><?php echo $plugin_version; ?></td>
          <td><span class="label label-success" style="display: <?php echo $plugin_enabled_style; ?>">Oui</span><span class="label label-important" style="display: <?php echo $plugin_disabled_style; ?>">Non</span></td>
          <td><a class="btn btn-danger btn-mini plugin_disable" href="#" style="display: <?php echo $plugin_action_disable_style; ?>">Désactiver</a> <a class="btn btn-success btn-mini plugin_enable" href="#" style="display: <?php echo $plugin_action_enable_style; ?>">Activer</a></td>
        </tr>
        <?php
        endforeach;
    else:
    ?>
      <tr>
        <td colspan="4">Il n'y a aucun plugin installé</td>
      </tr>
    <?php
    endif;
    ?>
  </tbody>
</table>

<div class="page-header">
  <h1>Mondes</h1>
</div>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Heure</th>
      <th>Temps total</th>
      <th>Environnement</th>
      <th>Tempête ?</th>
      <th>Orage ?</th>
      <th>Actions</th>
   </tr>
  </thead>
  <tbody>
    <?php
    if (!empty($world_list)):
      foreach ($world_list as $key => $world_infos):
        $world_name = $world_infos['name'];
        
        if ($world_infos['hasStorm']) {
          $world_storm = 'Oui';
        } else {
          $world_storm = 'Non';
        }
        
        if ($world_infos['isThundering']) {
          $world_thunder = 'Oui';
        } else {
          $world_thunder = 'Non';
        }
        
        $world_time = $world_infos['time'];
        
        $world_environment = $world_infos['environment'];
        
        $world_full_time = $world_infos['fullTime'];
        ?>
        <tr id="tr_<?php ?>">
          <td><?php echo $world_name; ?></td>
          <td><?php echo $world_time; ?></td>
          <td><?php echo $world_full_time; ?></td>
          <td><?php echo ucfirst($world_environment); ?></td>
          <td><?php echo $world_storm; ?></td>
          <td><?php echo $world_thunder; ?></td>
          <td>&nbsp;</td>
        </tr>
        <?php
        endforeach;
    else:
    ?>
      <tr>
        <td colspan="7">Il n'y a aucun monde active sur le serveur</td>
      </tr>
    <?php
    endif;
    ?>
  </tbody>
</table>

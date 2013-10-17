<?php
$data_values = Slim::getInstance()->view()->data['data_values'];
$all_data_values = $data_values->getAll();
?>
<form class="form-horizontal">
  <fieldset>
    <div class="control-group">
      <label class="control-label">Objet à donner</label>
      <div class="controls">
        <select id="give_object">
          <?php
          foreach ($all_data_values as $id => $infos):
            foreach ($infos as $subid => $name):
            ?>
            <option value="<?php echo $id; ?>:<?php echo $subid; ?>" style="height: 25px; line-height: 25px; padding-left: 30px; background: transparent url(<?php echo $data_values->getImage($id, $subid); ?>) no-repeat left center"><?php echo $name; ?></option>
            <?php
            endforeach;
          endforeach;
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Quantité</label>
      <div class="controls">
        <input type="text" id="give_amount" class="span1" />
        <p class="help-block">Optionnel</p>
      </div>
    </div>
 </fieldset>
</form>

<script type="text/javascript">
$(document).ready(function() {
  $('a#modal_apply').click(function() {
    var player_name = '<?php echo Slim::getInstance()->request()->get('player_name'); ?>';
    var item_id = $('select[id="give_object"]').val();
    var amount = $('input[id="give_amount"]').val();

    $.post('<?php echo ROOT_URL; ?>ajax/player/give', {player_name: player_name, item_id: item_id, amount: amount},
      function (data) {
        $('div#modal_dialog').modal('hide');
      }
    );
  });
});
</script>
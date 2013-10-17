<?php
$player_list = Slim::getInstance()->view()->data['player_list'];
$player_name = Slim::getInstance()->request()->get('player_name');

if (count($player_list) == 1):
?>
<div class="alert alert-error">Il n'y a personne vers qui téléporter <?php echo $player_name; ?> !</div>
<script type="text/javascript">
$(document).ready(function() {
  $('a#modal_apply').remove();
});
</script>
<?php
else:
?>
<form class="form-horizontal">
  <fieldset>
    <div class="control-group">
      <label class="control-label">Téléporter vers...</label>
      <div class="controls">
        <select id="tp_to">
          <?php foreach ($player_list as $target_player_name): ?>
            <?php if ($target_player_name != $player_name): ?>
            <option value="<?php echo $target_player_name; ?>"><?php echo $target_player_name; ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
 </fieldset>
</form>

<script type="text/javascript">
$(document).ready(function() {
  $('a#modal_apply').click(function() {
    var tp_to = $('select[id="tp_to"]').val();
    var player_name = '<?php echo $player_name; ?>';

    $.post('<?php echo ROOT_URL; ?>ajax/player/tp', {player_name: player_name, tp_to: tp_to},
      function (data) {
        $('div#modal_dialog').modal('hide');
      }
    );
  });
});
</script><?php
endif;
?>
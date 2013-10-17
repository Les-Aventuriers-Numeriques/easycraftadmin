<form class="form-horizontal">
  <fieldset>
    <div class="control-group">
      <label class="control-label">Raison</label>
      <div class="controls">
        <input type="text" id="kick_reason" />
        <p class="help-block">Optionnel</p>
      </div>
    </div>
 </fieldset>
</form>

<script type="text/javascript">
$(document).ready(function() {
  $('a#modal_apply').click(function() {
    var reason = $('input[id="kick_reason"]').val();
    var player_name = '<?php echo Slim::getInstance()->request()->get('player_name'); ?>';
    var tr = getPlayerTr(player_name);

    $.post('<?php echo ROOT_URL; ?>ajax/player/kick', {player_name: player_name, reason: reason},
      function (data) {
        tr.fadeOut(300, function() { tr.remove(); });
        $('div#modal_dialog').modal('hide');
      }
    );
  });
});
</script>
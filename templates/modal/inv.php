<script type="text/javascript">
$(document).ready(function() {
  $('a#modal_apply').remove();
});
</script>

<?php
echo EasyCraftAdmin::getPlayerInventory($player_inv);
?>

<p align="center"><a href="#" class="btn btn-danger">Tout supprimer</a></p>
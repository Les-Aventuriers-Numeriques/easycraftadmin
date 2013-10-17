<div class="page-header">
  <h1>Oups <small>Une erreur est survenue...</small></h1>
</div>
<pre>
Erreur <?php echo $e->getCode(); ?> : <?php echo $e->getMessage(); ?>

Fichier : <?php echo $e->getFile(); ?> à la ligne <?php echo $e->getLine(); ?>
</pre>
<p align="center"><a class="btn btn-large btn-primary" href="<?php echo ROOT_URL; ?>home"><i class="icon-backward icon-white"></i> Retour à l'accueil</a></p>
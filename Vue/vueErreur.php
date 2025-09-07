// vueErreur.php
<?php $titre = 'Erreur'?>
<?php ob_start(); ?>
<p>Une errer est survenue : <?= $msgErreur?></p>
<?php $contenu = ob_get_clean(); ?>
<?php require 'gabarit.php'; ?>
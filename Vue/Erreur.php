// vueErreur.php
<?php $titre = 'Erreur'?>
<?php ob_start(); ?>
<p>Une erreur est survenue : <?= $message?></p>
<?php $contenu = ob_get_clean(); ?>
<?php require 'gabarit.php'; ?>
<?php ob_start(); require('templates/header/navbar.php');?>
<h1>Intranet Landry-Sintec AVI</h1>
<p>Une erreur est survenue : <?= $errorMessage ?></p>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>

<?php ob_start(); ?>
<?php
$id = $_SESSION['id'];
 ?>
<!-- Navbar -->
<nav class="navbar navbar-expand-sm fixed-top navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?action=connected&id=<?=$id?>"
      ><img
        id="MDB-logo"
        src="assets/img/LOGO.png"
        alt="MDB Logo"
        draggable="false"
        height="30"
    /></a>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link mx-2" href="index.php?action=createUser&id=<?=$id?>"><i class="fas fa-plus-circle pe-2"></i>Utilisateurs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mx-2" href="index.php?action=demandeconges&id=<?=$id?>"><i class="fas fa-plus-circle pe-2"></i>Gérer les congés</a>
        </li>
      </ul>
        <li class="nav-item">
          <a class="btn btn-danger" href="index.php?action=createConges&id=<?=$id?>"><i class="fas fa-heart pe-2"></i>Demander un congés</a>
        </li>
      <li class="nav-item ms-3">
          <a class="btn btn-primary btn-rounded" href='index.php?action=deconnection'><span>Se déconnecter</span></a>
        </li>
    </div>
  </div>
</nav>
<!-- Navbar -->
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>
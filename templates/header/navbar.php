<?php ob_start(); ?>
<?php 
    $id = $_SESSION['id'];
    $id_poste = $_SESSION['id_poste'];
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?action=connected&id=<?=$id?>"><img id="MDB-logo" src="assets/img/LOGO.png" alt="MDB Logo" draggable="false" height="30" /></a>
            <div class="collapse navbar-collapse" id="mynavbar">
                <?php
                if($_SESSION['id_poste'] == 1){
                ?>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Gestion des utilisateurs
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="index.php?action=createUser&id=<?=$id?>">Créer un Utilisateurs</a>
                            <li><a class="dropdown-item" href="#">Tous les congés</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Gestion de congés
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="index.php?action=crudconges&id=<?=$id?>">Congés en attente</a></li>
                            <li><a class="dropdown-item" href="#">Tous les congés</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <?php
                }
                ?>
                <div class="ms-auto p-2 bd-highlight">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item ">
                            <a class="btn btn-danger" href="index.php?action=createConges&id=<?=$id?>">Demander un congés</a>
                        </li>
                        <li class="nav-item ms-3">
                            <a class="btn btn-primary btn-rounded" href='index.php?action=deconnection'><span>Se déconnecter</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<!-- Navbar -->
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>
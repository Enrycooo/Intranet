<?php ob_start(); ?>
<?php 
    $id = $_SESSION['id'];
    $id_poste = $_SESSION['id_poste'];
    $id_service = $_SESSION['id_service'];
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?action=connected&id=<?=$id?>"><img id="MDB-logo" src="assets/img/LOGO.png" alt="MDB Logo" draggable="false" height="30" /></a>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <?php
                    if($_SESSION['id_poste'] == 1){
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="index.php?action=crudRaison&id=<?=$id?>">Toutes les raisons</a></li>
                            <li><a class="dropdown-item" href="index.php?action=crudService&id=<?=$id?>">Tous les services</a></li>
                            <li><a class="dropdown-item" href="index.php?action=crudPoste&id=<?=$id?>">Tous les postes</a></li>
                            <li><a class="dropdown-item" href="index.php?action=crudEtat&id=<?=$id?>">Tous les états</a></li>
                            <li><a class="dropdown-item" href="index.php?action=crudManager&id=<?=$id?>">Tous les manager</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Gestion des utilisateurs
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="index.php?action=crudusers&id=<?=$id?>">Tous les utilisateurs</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                    <?php
                    if($_SESSION['id_poste'] == 1 OR $_SESSION['id_poste'] == 3){
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Congés
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="index.php?action=crudcongesenattente&id=<?=$id?>">Congés en attente</a></li>
                            <li><a class="dropdown-item" href="index.php?action=crudconges&id=<?=$id?>">Tout les congés</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
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
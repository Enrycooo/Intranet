<?php ob_start(); ?>
<div class="container">
    <div class="row mt-4">
      <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <div>
            <?php
            if($_GET['action'] == 'crudcongesenattente'){
                ?>
          <h4 class="text-primary">Toutes les demandes de congés en attente !</h4>
            <?php
            }else{
                ?>
          <h4 class="text-primary">Toutes les demandes de congés accepter ou refuser !</h4>
            <?php
            }
            ?>
        </div>
          <div>
              <a class="btn btn-danger" href="index.php?action=createConges&id=<?=$id?>"><i class="fas fa-heart pe-2"></i>Ajouter un congés</a>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12">
        <div id="showAlert"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table class="table table-striped table-bordered text-center">
            <thead>
              <tr>
                <th>ID</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Durée</th>
                <th>Raison</th>
                <th>Etat</th>
                <th>Commentaire</th>
                <th>Employé</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    foreach($cruds as $crud)
                    {
                ?>
                <tr>
                    <td><?= $crud->id_conges ?></td>
                    <td><?= $crud->date_debut ?></td>
                    <td><?= $crud->date_fin ?></td>
                    <td><?= $crud->duree ?></td>
                    <td><?= $crud->raison ?></td>
                    <td><?= $crud->etat ?></td>
                    <td><?= $crud->commentaire ?></td>
                    <td><?= $crud->nom ." ". $crud->prenom?></td>
                    <td>
                        <?php
                        if($_GET['action'] == 'crudcongesenattente'){
                            ?>
                        <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-heart pe-2"></i>Accepter</a>
                        <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-heart pe-2"></i>Refuser</a>
                        <?php
                        }else{
                            ?>
                        <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-heart pe-2"></i>Accepter</a>
                        <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-heart pe-2"></i>Annuler</a>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
                    }
                    ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>
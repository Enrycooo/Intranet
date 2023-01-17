<?php ob_start(); ?>
<div class="container">
    <div class="row mt-4">
      <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <div>
          <h4 class="text-primary">Toutes les utilisateurs !</h4>
        </div>
          <div>
              <a class="btn btn-danger" href="index.php?action=createUser&id=<?=$id?>"><i class="fas fa-heart pe-2"></i>Ajouter un Utilisateur</a>
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
                <th>nom&prenom</th>
                <th>username</th>
                <th>email</th>
                <th>poste</th>
                <th>Manager</th>
                <th>Service</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    foreach($cruds as $crud)
                    {
                ?>
                <tr>
                    <td><?= $crud->id_employe ?></td>
                    <td><?= $crud->nom." ".$crud->prenom ?></td>
                    <td><?= $crud->username ?></td>
                    <td><?= $crud->email ?></td>
                    <td><?= $crud->poste ?></td>
                    <td><?= $crud->nomM." ".$crud->prenomM ?></td>
                    <td><?= $crud->service ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-heart pe-2"></i>Modifier</a>
                        <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-heart pe-2"></i>Supprimer</a>
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
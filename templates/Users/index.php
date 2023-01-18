<?php ob_start(); ?>
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Intranet Landry-Sintec AVI</h4>
      </div>

      <!--Body-->
      <form name="form4" action='index.php?action=cruduers&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="nom">Nom de l'utilisateur</label>
          <input type="text" id="nom" class="form-control validate" name='nom'>
          <label data-error="wrong" data-success="right" for="prenom">Prenom de l'utilisateur</label>
          <input type="text" id="prenom" class="form-control validate" name='prenom'>
          <label data-error="wrong" data-success="right" for="email">Email de l'utilisateur</label>
          <input type="mail" id="email" class="form-control validate" name='email'>
          <input type="hidden" name="action" value="create">

        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Créer un utilisateur</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- End create modal -->

<!-- Edit modal -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Intranet Landry-Sintec AVI</h4>
      </div>

      <!--Body-->
      <form name="form4" action='index.php?action=crudusers&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="nomedit">Nom du manager</label>
          <input type="text" id="nomedit" class="form-control validate" name='nom'>
          <label data-error="wrong" data-success="right" for="prenomedit">Prenom du manager</label>
          <input type="text" id="prenomedit" class="form-control validate" name='prenom'>
          <label data-error="wrong" data-success="right" for="emailedit">Email du manager</label>
          <input type="mail" id="emailedit" class="form-control validate" name='email'>
          <input type="hidden" id="dataId" name="id_employe">
          <input type="hidden" name="action" value="update">
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button id="saveChanges" type="submit" class="btn btn-primary">Modifier le manager</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- End update modal -->
  <div class="container">
    <div class="row mt-4">
      <div class="col-lg-6 d-flex justify-content-between align-items-center">
        <div>
          <h4 class="text-primary">Tout les utilisateurs !</h4>
        </div>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
            Ajouter un nouvelle utilisateur
            </button>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table class="table table-striped table-bordered text-center" id="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>nom</th>
                <th>prenom</th>
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
                foreach($cruds as $crud){
                    $id_employe = $crud->id_employe;
                ?>
                <tr>
                    <td data-id="<?= $id_employe ?>"><?= $id_employe ?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->nom?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->prenom?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->username ?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->email ?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->poste ?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->nomM." ".$crud->prenomM ?></td>
                    <td data-id="<?= $id_employe ?>"><?= $crud->service ?></td>
                    <td>
                        <div class='d-flex text-center'>
                        <button data-id="<?= $id_employe ?>" type="button" class="btn btn-sm btn-primary update" data-bs-toggle="modal" data-bs-target="#update">Modifier</button>
                        &nbsp;
                        <form action='index.php?action=crudusers&id=<?=$id?>' method='post'>
                            <input type="hidden" name='id_employe' value='<?=$id_employe?>'>
                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            <input type="hidden" name="action" value="delete">
                        </form>
                        </div>
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
<script>
    // Récupération des données de la cellule lorsque le bouton "Modifier" est cliqué
    var editButtons = document.querySelectorAll(".update");

    editButtons.forEach(function(button) {
      button.addEventListener("click", function() {
        var dataId = button.getAttribute("data-id");
        var row = document.querySelector(`td[data-id="${dataId}"]`).parentNode;
        var cellData1 = row.querySelector("td:nth-child(2)").textContent;
        var cellData2 = row.querySelector("td:nth-child(3)").textContent;
        var cellData3 = row.querySelector("td:nth-child(4)").textContent;
        var cellData4 = row.querySelector("td:nth-child(5)").textContent;
        var cellData5 = row.querySelector("td:nth-child(6)").textContent;
        var cellData6 = row.querySelector("td:nth-child(7)").textContent;
        var cellData7 = row.querySelector("td:nth-child(8)").textContent;

        // Mise des données récupérées dans l'input du modal
        document.querySelector("#nomedit").value = cellData1;
        document.querySelector("#prenomedit").value = cellData2;
        document.querySelector("#usernameedit").value = cellData3;
        document.querySelector("#emailedit").value = cellData4;
        document.querySelector("#posteedit").value = cellData5;
        document.querySelector("#manageredit").value = cellData6;
        document.querySelector("#serviceedit").value = cellData7;
        document.querySelector("#dataId").value = dataId;
      });
    });
</script>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>
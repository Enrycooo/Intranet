<?php ob_start();?>
<!-- New raison modal -->
<div class="modal fade" id="newRaison" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Intranet Landry-Sintec AVI</h4>
      </div>

      <!--Body-->
      <form name="form4" action='index.php?action=crudRaison&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="form3">Libellé de la raison</label>
          <input type="text" id="form3" class="form-control validate" name='libelle'>

        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Créer une raison</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- End new raison modal -->
<!-- Edit raison modal -->
<div class="modal fade" id="editRaison" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Intranet Landry-Sintec AVI</h4>
      </div>

      <!--Body-->
      <form name="form4" action='index.php?action=crudRaison&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="libelleedit">Libellé de la raison</label>
          <input type="text" id="libelleedit" class="form-control validate" name='libelle' value=''>

        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Modifier la raison</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- End edit raison modal -->
  <div class="container">
    <div class="row mt-4">
      <div class="col-lg-6 d-flex justify-content-between align-items-center">
        <div>
          <h4 class="text-primary">Toutes les raisons !</h4>
        </div>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newRaison">
            Ajouter une nouvelle raison
            </button>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-4">
        <div class="table-responsive">
          <table class="table table-striped table-bordered text-center">
            <thead>
              <tr>
                <th>ID</th>
                <th>Raison</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php
                foreach($cruds as $crud){
                    $id_raison = $crud->id_raison;
                ?>
                <tr>
                    <td><?= $id_raison ?></td>
                    <td><?= $crud->libelle ?></td>
                    <td>
                        <div class='d-flex text-center'>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editRaison" id='modif' value='<?=$crud->libelle?>'>Modifier</button>
                        &nbsp;
                        <form action='index.php?action=deleteRaison&id=<?=$id?>' method='post'>
                            <input type="hidden" name='id_raison' value='<?=$id_raison?>'>
                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
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
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>
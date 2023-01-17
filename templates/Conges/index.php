<?php ob_start(); ?>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.6/dist/xlsx.full.min.js"></script>
<div class="container">
    <div class="row mt-4">
      <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <div>
            <?php
            if($_GET['action'] == 'crudcongesenattente'){
                ?>
          <h4 class="text-primary">Toutes les demandes de congés en attente !</h4>
            <?php
            }elseif($_GET['action'] == 'crudconges'){
                ?>
          <h4 class="text-primary">Toutes les demandes de congés accepter ou refuser ou en attente!</h4>
            <?php
            }
            ?>
        </div>
          <div>
              <button class="btn btn-primary" id="button" onclick="htmlTableToExcel('xls')">Exporter la table</button>
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
          <table class="table table-striped table-bordered text-center" id="tblToExcl">
            <thead>
              <tr>
                <th>ID</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Durée</th>
                <?php
                    if($_SESSION['id_poste'] == 1){
                    ?>
                <th>Raison</th>
                <?php
                    }
                    ?>
                <th>État</th>
                <?php
                    if($_SESSION['id_poste'] == 1){
                    ?>
                <th>Commentaire</th>
                <?php
                    }
                    ?>
                <th>Employé</th>
                <?php
                if($_SESSION['id_poste'] == 1){
                ?>
                <th>Actions</th>
                <?php
                }
                ?>
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
                    <?php
                    if($_SESSION['id_poste'] == 1){
                    ?>
                    <td><?= $crud->raison ?></td>
                    <?php
                    }
                    ?>
                    <td><?= $crud->etat ?></td>
                    <?php
                    if($_SESSION['id_poste'] == 1){
                    ?>
                    <td><?= $crud->commentaire ?></td>
                    <?php
                    }
                    ?>
                    <td><?= $crud->nom ." ". $crud->prenom?></td>
                    <?php
                    if($_SESSION['id_poste'] == 1){
                    ?>
                    <td>
                        <a class="btn btn-primary btn-sm" href="#"><i class="fas fa-heart pe-2"></i>Accepter</a>
                        <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-heart pe-2"></i>Refuser</a>
                    </td>
                    <?php
                    }
                    ?>
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
<script type="text/javascript">
    function htmlTableToExcel(type){
        var data = document.getElementById('tblToExcl');
        var excelFile = XLS.utils.table_to_book(data, {dateNF:'mm/dd/yyyy;@',cellDates:true, raw: true, sheet: "sheet1"});
        XLS.write(excelFile, { bookType: type, bookSST: true, type: 'base64' });
        XLS.writeFile(excelFile, 'ExportedFile:HTMLTableToExcel.' + type);
   }
</script>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>
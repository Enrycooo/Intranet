<?php ob_start();?>
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
      <form name="form4" action='index.php?action=crudconges&id=<?=$id?>' method='post'>
      <div class="modal-body">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Date de début<span class="text-danger"></span></label> 
                    <input type="date" id="date_debut" name="date_debut"> 
                </div>
                <div class="col-sm-6 flex-column d-flex">
                    <label class="form-control-label px-3">&nbsp;<span class="text-danger"></span></label>
                    <select class="select form-control-lg" id="time" name='debut_type'>
                        <option value="Matin">Matin</option>
                        <option value="Après-midi">Après-midi</option>
                    </select> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Date de fin<span class="text-danger"></span></label> 
                    <input type="date" id="date_fin" name="date_fin"> 
                </div>
                <div class="col-sm-6 flex-column d-flex">
                    <label class="form-control-label px-3">&nbsp;<span class="text-danger"></span></label>
                    <select class="select form-control-lg" id="time2" name='fin_type'>
                        <option value="Matin">Matin</option>
                        <option value="Après-midi">Après-midi</option>
                    </select> 
                </div>
            </div> 
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Raison<span class="text-danger"></span></label>
                    <select class="select form-control-lg" name="raison" id="raison">
                        <option value="0" hidden>Choisissez une raison</option>
                        <?php
                        foreach($raisons as $raison){
                        ?>
                        <option value="<?= htmlspecialchars($raison->id_raison) ?>">
                        <?= htmlspecialchars($raison->libelle) ?></option>
                        <?php
                        } 
                        ?>
                     </select>
                </div>
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">État<span class="text-danger"></span></label>
                    <select class="select form-control-lg" name="etat" id="etat">
                        <option value="0" hidden>Choisissez un état</option>
                        <?php
                        foreach($etats as $etat){
                        ?>
                        <option value="<?= htmlspecialchars($etat->id_etat) ?>">
                        <?= htmlspecialchars($etat->libelle) ?></option>
                        <?php
                        } 
                        ?>
                     </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label">Commentaire<span class="text-danger"></span></label>
                    <input type="text" id="commentaire" name="commentaire"> 
                </div>
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Duree<span class="text-danger"></span></label> 
                    <input type="text" id="duration" name="duree" value=""> 
                </div>
            </div>
            <input type="hidden" id="dataId" name="id_conges">
            <input type="hidden" name="action" value="update">
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button id="saveChanges" type="submit" class="btn btn-primary">Modifier le congés</button>
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
          <h4 class="text-primary">Tout les états !</h4>
        </div>
        <div>
            <a class="btn btn-danger" href="index.php?action=createConges&id=<?=$id?>"><i class="fas fa-heart pe-2"></i>Ajouter un congés</a>
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
                <th>Début</th>
                <th>Fin</th>
                <th>Début type</th>
                <th>Fin type</th>
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
                foreach($cruds as $crud){
                    $id_conges = $crud->id_conges;
                ?>
                <tr>
                    <td data-id="<?= $id_conges ?>"><?= $id_conges ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->date_debut ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->date_fin ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->debut_type ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->fin_type ?></td>
                    <td data-id="<?= $id_conges ?>"><?= $crud->duree ?></td>
                    <?php
                    if($_SESSION['id_poste'] == 1){
                    ?>
                    <td data-id="<?= $id_conges ?>"><?= $crud->raison ?></td>
                    <?php
                    }
                    ?>
                    <td data-id="<?= $id_conges ?>"><?= $crud->etat ?></td>
                    <?php
                    if($_SESSION['id_poste'] == 1){
                    ?>
                    <td data-id="<?= $id_conges ?>"><?= $crud->commentaire ?></td>
                    <?php
                    }
                    ?>
                    <td data-id="<?= $id_conges ?>"><?= $crud->nom ." ". $crud->prenom?></td>
                    <?php
                    if($_SESSION['id_poste'] == 1){
                    ?>
                    <td>
                        <div class='d-flex text-center'>
                        <button data-id="<?= $id_conges ?>" type="button" class="btn btn-sm btn-primary update" data-bs-toggle="modal" data-bs-target="#update">Modifier</button>
                        &nbsp;
                        <form action='index.php?action=crudconges&id=<?=$id?>' method='post'>
                            <input type="hidden" name='id_conges' value='<?=$id_conges?>'>
                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            <input type="hidden" name="action" value="delete">
                        </form>
                        </div>
                    </td>
                    <td style="display:none;" data-id="<?= $id_conges ?>"><?= $crud->id_raison ?></td>
                    <td style="display:none;" data-id="<?= $id_conges ?>"><?= $crud->id_etat ?></td>
                </tr>
                <?php
                }
                }
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<script src='assets/js/moment.js'></script>
<script type="text/javascript">
    function treatAsUTC(date) {
        var result = new Date(date);
        result.setMinutes(result.getMinutes() - result.getTimezoneOffset());
        return result;
    }
    
    // Récupération des données de la cellule lorsque le bouton "Modifier" est cliqué
    var editButtons = document.querySelectorAll(".update");

    editButtons.forEach(function(button) {
      button.addEventListener("click", function() {
        var dataId = button.getAttribute("data-id");
        var row = document.querySelector(`td[data-id="${dataId}"]`).parentNode;
        //Stockage de toutes les cellules du tableau dans une var
        var dataCell = row.querySelector("td:nth-child(2)").textContent;
        var dataCell2 = row.querySelector("td:nth-child(3)").textContent;
        var cellData3 = row.querySelector("td:nth-child(4)").textContent;
        var cellData4 = row.querySelector("td:nth-child(5)").textContent;
        var cellData5 = row.querySelector("td:nth-child(6)").textContent;
        var cellData6 = row.querySelector("td:nth-child(12)").textContent;
        var cellData7 = row.querySelector("td:nth-child(13)").textContent;
        var cellData8 = row.querySelector("td:nth-child(9)").textContent;
        
        //Envoie des dates au modal
        //du à des problème de format de date, nous utilisons moment.js
        //une librairie JS pour les format de date
        var dateMomentObject = moment(dataCell, "DD/MM/YYYY");
        var dateMomentObject2 = moment(dataCell2, "DD/MM/YYYY");
        var dataDate = dateMomentObject.toDate();
        var dataDate2 = dateMomentObject2.toDate();
        var dateInput = document.querySelector("#date_debut");
        dateInput.value = dataDate.toISOString().slice(0 ,10);
        var dateInput2 = document.querySelector("#date_fin");
        dateInput2.value = dataDate2.toISOString().slice(0 ,10);
        
        //Envoie des options de temps au modal
        var optionValue = cellData3;
        var selectInput = document.querySelector("#time");
        selectInput.value = optionValue;
        var option = document.createElement("option");
        option.textContent = optionValue;
        option.value = optionValue;
        
        var optionValue2 = cellData4;
        var selectInput2 = document.querySelector("#time2");
        selectInput2.value = optionValue2;
        var option2 = document.createElement("option");
        option2.textContent = optionValue2;
        option2.value = optionValue2;
        
        //Envoie des options de raison et d'état au modal
        var optionValue4 = cellData6;
        var selectInput4 = document.querySelector("#raison");
        selectInput4.value = optionValue4;
        var option4 = document.createElement("option");
        option4.textContent = optionValue4;
        option4.value = optionValue4;
        
        var optionValue5 = cellData7;
        var selectInput5 = document.querySelector("#etat");
        selectInput5.value = optionValue5;
        var option5 = document.createElement("option");
        option5.textContent = optionValue5;
        option5.value = optionValue5;
        
        //Envoie des valeur d'input au modal
        document.querySelector("#commentaire").value = cellData8;
        document.querySelector("#dataId").value = dataId;
        document.querySelector("#duration").value = cellData5;
        
        setTimeout(difference,1000);
        
        function difference(){
            setTimeout(difference,1000);
        var time = document.querySelector('#time').selectedIndex;
        var time2 = document.querySelector('#time2').selectedIndex;
        var date1 = new Date(document.querySelector('#date_debut').value);
        var date2 = new Date(document.querySelector('#date_fin').value);
        var millisecondsPerDay = 24 * 60 * 60 * 1000;
        const diffDays = ((treatAsUTC(date2) - treatAsUTC(date1)) / millisecondsPerDay);
        
        // Get the difference in whole weeks
        var wholeWeeks = diffDays / 7 | 0;

        // Estimate business days as number of whole weeks * 5
        var days = wholeWeeks * 5;

        // If not even number of weeks, calc remaining weekend days
        if (diffDays % 7) {
          date1.setDate(date1.getDate() + wholeWeeks * 7);

          while (date1 < date2) {
            date1.setDate(date1.getDate() + 1);

            // If day isn't a Sunday or Saturday, add to business days
            if (date1.getDay() !== 5 && date1.getDay() !== 6) {
              ++days;
            }
          }
        }
        
        if(time === 1 && time2 === 0){
            days = (days - 1);
        }
        if(time === 1 && time2 === 1){
            days = (days - 0.5);
        }
        if(time === 0 && time2 === 0){
            days = (days - 0.5);
        }
        
        document.querySelector('#duration').value = days + 1;
        }
      });
    });
</script>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>
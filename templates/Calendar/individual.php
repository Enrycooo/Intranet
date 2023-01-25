<?php ob_start(); ?>
<script src='templates/Calendar/dist/index.global.js'></script>
<script src='templates/Calendar/packages/jquery/jquery.js'></script>
<script src="templates/Calendar/packages/core/locales/fr.global.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src='assets/js/moment.js'></script>
<script type="module">

document.addEventListener('DOMContentLoaded', function() {
    
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        eventTimeFormat: { // will produce something like "Tuesday, September 18, 2018"
            month: '2-digit',
            year: 'numeric',
            day: '2-digit'
        },
        locale:'fr',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        <?php 
        if($_SESSION['id_poste'] !==2){
        echo 'navLinks: true, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: true,';
        }
        ?>
        eventSources: [
        {
          url: 'templates/Calendar/api/load.php'
        }
        ],
        eventColor: '#378006',
        hiddenDays: [6, 0],
        <?php 
        if($_SESSION['id_poste'] !==2){
        echo"
        eventClick: function(info) {
            openEditModal(info.event);
            function openEditModal(event) {
            
                var options = {
                    'backdrop' : 'static',
                    'show':true,
                    'display': 'block'
                };
                let start = event.start.toString();
                let end = event.end.toString();
                let dataDate = new Date(start);
                let dataDate2 = new Date(end);
                
                dataDate.setHours(dataDate.getHours() - 3);
                dataDate2.setHours(dataDate2.getHours() - 3);

                console.log(dataDate);
                console.log(dataDate2);
                
                //insert id, title and date to modal
                document.querySelector('#event-id').value = event.id;
                document.querySelector('#event-title').value = event.title;
                var dateInput = document.querySelector('#event-start');
                dateInput.value = dataDate.toISOString().slice(0 ,16);
                var dateInput2 = document.querySelector('#event-end');
                dateInput2.value = dataDate2.toISOString().slice(0 ,16);
                document.cookie = 'js_var_value = ' + localStorage.value

                // afficher le modal
                var modal = document.getElementById('editeventmodal');
                modal.style.display = 'block';
            }
            function updateEvent() {
                // Récupération des données du modal
                var title = document.getElementById('event-title').value;
                var start = document.getElementById('event-start').value;
                var end = document.getElementById('event-end').value;

                // Mise à jour de l'événement dans le calendrier
                event.setProp('title', title);
                event.setProp('start', start);
                event.setProp('end', end);

                // Envoi des données en BDD
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'api/update.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            alert('Evénement mis à jour avec succès !');
                        } else {
                            alert('Erreur lors de la mise à jour de l\'événement : ' + response.error);
                        }
                    }
                };
                xhr.send('event_id=' + event.id + '&title=' + title + '&start=' + start + '&end=' + end);

                // Fermeture du modal
                var modal = document.getElementById('editeventmodal');
                modal.style.display = 'none';
            }
        }";
        }
        ?>
    });
    calendar.render();
  });
  function fermer(){
    var modal = document.getElementById('editeventmodal');
                modal.style.display = 'none';
  }
  document.getElementById("fermer").addEventListener("click", fermer);
</script>
<style>
  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

</style>
<!-- Edit modal -->
<div class="modal" id="editeventmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    <label class="form-control-label px-3">Raison<span class="text-danger"></span></label> 
                    <input type="text" id="event-title" name="date_debut"> 
                </div>
                <!--<div class="col-sm-6 flex-column d-flex">
                    <label class="form-control-label px-3">&nbsp;<span class="text-danger"></span></label>
                    <select class="select form-control-lg" id="time" name='debut_type'>
                        <option value="Matin">Matin</option>
                        <option value="Après-midi">Après-midi</option>
                    </select> 
                </div>-->
            </div>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Date de début<span class="text-danger"></span></label> 
                    <input type="datetime-local" id="event-start" name="date_debut"> 
                </div>
                <!--<div class="col-sm-6 flex-column d-flex">
                    <label class="form-control-label px-3">&nbsp;<span class="text-danger"></span></label>
                    <select class="select form-control-lg" id="time" name='debut_type'>
                        <option value="Matin">Matin</option>
                        <option value="Après-midi">Après-midi</option>
                    </select> 
                </div>-->
            </div>
            <div class="row">
                <div class="col-sm-6 flex-column d-flex"> 
                    <label class="form-control-label px-3">Date de fin<span class="text-danger"></span></label> 
                    <input type="datetime-local" id="event-end" name="date_fin"> 
                </div>
                <!--<div class="col-sm-6 flex-column d-flex">
                    <label class="form-control-label px-3">&nbsp;<span class="text-danger"></span></label>
                    <select class="select form-control-lg" id="time2" name='fin_type'>
                        <option value="Matin">Matin</option>
                        <option value="Après-midi">Après-midi</option>
                    </select> 
                </div>-->
            </div>
            <!--<div class="row">
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
            </div>-->
            <input type="hidden" id="event-id" name="id_conges">
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id='fermer'>Fermer</button>
          <button id="saveChanges" type="submit" class="btn btn-primary">Modifier le congés</button>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>
  <div id='calendar'></div>
<?php $content = ob_get_clean(); ?>
<?php require('templates/layout.php') ?>
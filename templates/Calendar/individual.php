<?php ob_start(); ?>
<script src='templates/Calendar/dist/index.global.js'></script>
<script src='templates/Calendar/packages/jquery/jquery.js'></script>
<script src="templates/Calendar/packages/core/locales/fr.global.js"></script>
<script
  src="https://code.jquery.com/jquery-3.6.3.js"
  integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
  crossorigin="anonymous"></script>
<script>
    
document.addEventListener('DOMContentLoaded', function() {
    
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
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
                
                document.querySelector('#event-id').value = event.id;
                document.querySelector('#event-title').value = event.title;
                document.querySelector('#event-start').value = event.start.toString();
                document.querySelector('#event-end').value = event.end.toString();
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
            function fermer() {
                var modal = document.getElementById('editeventmodal');
                modal.style.display = 'none';
            }
        }";
        }
        ?>
    });
    calendar.render();
  });
            function fermer() {
            // Fermeture du modal
                var modal = document.getElementById('editeventmodal');
                modal.style.display = 'none';
            }
</script>

<div class="modal" id="editeventmodal">
    <div class="modal-dialog modal-notify modal-warning" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Visualiser le conges </h5>
            </div>

            <div class="modal-body">

                <div class="md-form mb-5">

                    <form id="update-form" class="form-horizontal">
                    <input type="hidden" id="event-id" name="event-id" value="">

                    <div class="row">

                        <div class="col-md-6">

                            <div id="edit-title-group" class="form-group">
                                <label class="control-label" for="editEventTitle">Raison</label>
                                <input type="text" class="form-control" id="event-title" name="title">
                                <!-- errors will go here -->
                            </div>

                            <div id="edit-startdate-group" class="form-group">
                                <label class="control-label" for="editStartDate">Date de début</label>
                                <input type="text" class="form-control datetimepicker" id="event-start" name="event-start">
                                <!-- errors will go here -->
                            </div>

                            <div id="edit-enddate-group" class="form-group">
                                <label class="control-label" for="editEndDate">Date de fin</label>
                                <input type="text" class="form-control datetimepicker" id="event-end" name="event-end">
                                <!-- errors will go here -->
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="fermer()">Fermer</button>
                        <button type="submit" class="btn btn-primary" onclick="updateEvent()">Enregistrer</button>
                    </div>

                    </form>

                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  <div id='calendar'></div>
<?php $content = ob_get_clean(); ?>
<?php require('templates/layout.php') ?>
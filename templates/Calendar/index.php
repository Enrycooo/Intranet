<?php ob_start();?>
<link href='templates/Calendar/packages/core/main.css' rel='stylesheet' />
<link href='templates/Calendar/packages/daygrid/main.css' rel='stylesheet' />
<link href='templates/Calendar/packages/timegrid/main.css' rel='stylesheet' />
<link href='templates/Calendar/packages/list/main.css' rel='stylesheet' />
<link href='templates/Calendar/packages/bootstrap/css/bootstrap.css' rel='stylesheet' />
<link href="templates/Calendar/packages/jqueryui/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
<link href='templates/Calendar/packages/datepicker/datepicker.css' rel='stylesheet' />
<link href='templates/Calendar/packages/colorpicker/bootstrap-colorpicker.min.css' rel='stylesheet' />
<link href='templates/Calendar/style.css' rel='stylesheet' />

<script src='templates/Calendar/packages/core/main.js'></script>
<script src='templates/Calendar/packages/daygrid/main.js'></script>
<script src='templates/Calendar/packages/timegrid/main.js'></script>
<script src='templates/Calendar/packages/list/main.js'></script>
<script src='templates/Calendar/packages/interaction/main.js'></script>
<script src='templates/Calendar/packages/jquery/jquery.js'></script>
<script src='templates/Calendar/packages/jqueryui/jqueryui.min.js'></script>
<script src='templates/Calendar/packages/bootstrap/js/bootstrap.js'></script>
<script src='templates/Calendar/packages/datepicker/datepicker.js'></script>
<script src='templates/Calendar/packages/colorpicker/bootstrap-colorpicker.min.js'></script>
<script src='templates/Calendar/packages/core/locales/fr.js'></script>
<link href="assets/css/bootstrap.min.css" rel="stylesheet" media="all">
<script>
document.addEventListener('DOMContentLoaded', function() {

    var url ='templates/Calendar/';
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
        locale:'fr',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        navLinks: true, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: true,
        //uncomment to have a default date
        //defaultDate: '2020-04-07',
        events: url+'api/load.php'
        
    });
    calendar.render();
});
</script>
<div class="modal fade" id="addeventmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Ajouter un cours </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="container-fluid">

                    <form id="createEvent" class="form-horizontal">

                    <div class="row">

                        <div class="col-md-6">

                            <div id="title-group" class="form-group">
                                <label class="control-label" for="title">Titre</label>
                                <input type="text" class="form-control" name="title">
                                <!-- errors will go here -->
                            </div>

                            <div id="startdate-group" class="form-group">
                                <label class="control-label" for="startDate">Date de début</label>
                                <input type="text" class="form-control datetimepicker" id="startDate" name="startDate">
                                <!-- errors will go here -->
                            </div>

                            <div id="enddate-group" class="form-group">
                                <label class="control-label" for="endDate">Date de fin</label>
                                <input type="text" class="form-control datetimepicker" id="endDate" name="endDate">
                                <!-- errors will go here -->
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div id="color-group" class="form-group">
                                <label class="control-label" for="color">Couleur</label>
                                <input type="text" class="form-control colorpicker" name="color" value="#6453e9">
                                <!-- errors will go here -->
                            </div>

                            <div id="textcolor-group" class="form-group">
                                <label class="control-label" for="textcolor">Couleur de texte</label>
                                <input type="text" class="form-control colorpicker" name="text_color" value="#ffffff">
                                <!-- errors will go here -->
                            </div>
                            
                            <div id="textcolor-group" class="form-group">
                                <label class="control-label" for="textcolor">Récurrence :</label>
                                <select name="recurrence" id="recurrence">
                                    <option>--Choisissez une option--</option>
                                    <option value='0'>Pas de récurrence</option>
                                    <option value="1">Journalier</option>
                                    <option value="2">Hebdomadaire</option>
                                    <option value="3">Mensuel</option>
                                </select>
                                
                                <!-- errors will go here -->
                            </div>

                        </div>

                    </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>

            </form>

                    </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="editeventmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Mettre à jour un cours</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="container-fluid">

                    <form id="editEvent" class="form-horizontal">
                    <input type="hidden" id="editEventId" name="editEventId" value="">

                    <div class="row">

                        <div class="col-md-6">

                            <div id="edit-title-group" class="form-group">
                                <label class="control-label" for="editEventTitle">Titre</label>
                                <input type="text" class="form-control" id="editEventTitle" name="editEventTitle">
                                <!-- errors will go here -->
                            </div>

                            <div id="edit-startdate-group" class="form-group">
                                <label class="control-label" for="editStartDate">Date de début</label>
                                <input type="text" class="form-control datetimepicker" id="editStartDate" name="editStartDate">
                                <!-- errors will go here -->
                            </div>

                            <div id="edit-enddate-group" class="form-group">
                                <label class="control-label" for="editEndDate">Date de fin</label>
                                <input type="text" class="form-control datetimepicker" id="editEndDate" name="editEndDate">
                                <!-- errors will go here -->
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div id="edit-color-group" class="form-group">
                                <label class="control-label" for="editColor">Couleur</label>
                                <input type="text" class="form-control colorpicker" id="editColor" name="editColor" value="#6453e9">
                                <!-- errors will go here -->
                            </div>

                            <div id="edit-textcolor-group" class="form-group">
                                <label class="control-label" for="editTextColor">Couleur de texte</label>
                                <input type="text" class="form-control colorpicker" id="editTextColor" name="editTextColor" value="#ffffff">
                                <!-- errors will go here -->
                            </div>

                        </div>

                    </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary">Enregistrer</button>
              <button type="button" class="btn btn-danger" id="deleteEvent" data-id>Supprimer</button>
              <button type="button" class="btn btn-danger" id="deleteREvent" data-idR>Supprimer tout les cours récurent</button>
            </div>

            </form>

                    </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div>
    <div class="row flex-nowrap">
        <div class="col">
            <div class="container">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='templates/Calendar/dist/index.global.js'></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <script src='templates/Calendar/packages/core/locales/fr.global.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,   timeGridWeek,timeGridDay'
            },
            locale : 'fr',
            themeSystem: 'bootstrap5',
            height: 650,
            events: [
                { // this object will be "parsed" into an Event Object
                    title: 'The Title', // a property!
                    start: '2023-01-01', // a property!
                    end: '2023-01-11' // a property! ** see important note below about 'end' **
                }
            ]
        });
        calendar.render();
      });

    </script>
    <style>
  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }
</style>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>
<?php $content = ob_get_clean(); ?>

<?php require('templates/layout.php') ?>
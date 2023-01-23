<meta charset='utf-8' />
<script src='templates/Calendar/dist/index.global.js'></script>
<script src="templates/Calendar/packages/core/locales/fr.global.js"></script>
<script>
    
document.addEventListener('DOMContentLoaded', function() {
    var url ='./templates/Calendar/';
    
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale:'fr',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
      businessHours: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: url+'conges.php'
    });
    calendar.render();
  });

</script>
<style>
  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

</style>

  <div id='calendar'></div>
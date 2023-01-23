<meta charset='utf-8' />
<script src='templates/Calendar/dist/index.global.js'></script>
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
        events: [
            {
              id: 'a',
              title: 'test',
              start: '2023-01-01'
            }
          ],
        eventSources: [
        {
          url: 'templates/Calendar/conges.php',
          success: function(){
              alert('success');
          },
          failure: function() {
            alert('there was an error while fetching events!');
          }
        }
        ]
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
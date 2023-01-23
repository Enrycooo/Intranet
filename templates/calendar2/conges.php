<?php
header('Content-Type: application/json');

$events = array();
foreach($calendars as $calendar){
    $events[] = array(
        'id' => $calendar->id,
        'title' => $calendar->title,
        'startStr' =>$calendar->start_date,
        'endStr' =>$calendar->end_date
    );
}
echo json_encode($events);
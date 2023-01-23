<?php
header('Content-Type: application/json');

$events = [];
foreach($calendars as $calendar){
    $events[] = [
        'id' => $calendar->id,
        'title' => $calendar->title,
        'start' =>$calendar->start_date,
        'end' =>$calendar->end_date
    ];
}
echo json_encode($events);
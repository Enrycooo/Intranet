<?php
include("../config.php");

if (isset($_POST['title'])) {

    //collect data
    $error      = null;
    $title      = $_POST['title'];
    $start      = $_POST['startDate'];
    $end        = $_POST['endDate'];
    $color      = $_POST['color'];
    $text_color = $_POST['text_color'];

    //validation
    if ($title == '') {
        $error['title'] = 'Title is required';
    }

    if ($start == '') {
        $error['start'] = 'Start date is required';
    }

    if ($end == '') {
        $error['end'] = 'End date is required';
    }

    //if there are no errors, carry on
    if (! isset($error)) {

        //format date
        $start = date('Y-m-d H:i:s', strtotime($start));
        $end = date('Y-m-d H:i:s', strtotime($end));
        
        $data['success'] = true;
        $data['message'] = 'Success!';

        //store
        $dateT = $start;
        $dateF = date('Y-m-d H:i:s', strtotime($dateT. ' + 4 hours'));
        while($dateT<$end){
            $insert = [
            'title'       => $title,
            'start_event' => $dateT,
            'end_event'   => $dateF,
            'color'       => $color,
            'text_color'  => $text_color
        ];
            $db->insert('cours', $insert);
            $dateT = date('Y-m-d H:i:s', strtotime($dateT. ' + 7 days'));
        }
      
    } else {

        $data['success'] = false;
        $data['errors'] = $error;
    }

    echo json_encode($data);
}

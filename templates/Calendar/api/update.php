<?php
include("db.php");

if (isset($_POST['id'])) {

    //collect data
    $error      = null;
    $id         = $_POST['id_conges'];
    $start      = $_POST['date_debut'];
    $end        = $_POST['date_fin'];

    //optional fields
    $title      = isset($_POST['title']) ? $_POST['title']: '';

    //validation
    if ($start == '') {
        $error['start'] = 'Start date is required';
    }

    if ($end == '') {
        $error['end'] = 'End date is required';
    }

    //if there are no errors, carry on
    if (! isset($error)) {

        //reformat date
        $start = date('Y-m-d H:i:s', strtotime($start));
        $end = date('Y-m-d H:i:s', strtotime($end));
        
        $data['success'] = true;
        $data['message'] = 'Success!';

        //set core update array
        $update = [
            'start_event' => date('Y-m-d H:i:s', strtotime($_POST['date_debut'])),
            'end_event' => date('Y-m-d H:i:s', strtotime($_POST['date_fin']))
        ];

        //check for additional fields, and add to $update array if they exist
        if ($title !='') {
            $update['title'] = $title;
        }

        //set the where condition ie where id = 2
        $where = ['id' => $_POST['id_conges']];

        //update database
        $conn->update('cours', $update, $where);
      
    } else {

        $data['success'] = false;
        $data['errors'] = $error;
    }

    echo json_encode($data);
}
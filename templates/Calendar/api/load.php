<?php
include('db.php');

$result = $conn->prepare("SELECT id_conges, date_debut, date_fin, R.libelle AS raison
                        FROM conges C INNER JOIN raison R ON C.id_raison=R.id_raison");
$result->execute();
$res = $result->fetchALL(PDO::FETCH_OBJ);

$data = [];
foreach($res as $row) {
    $data[] = [
        'id'              => $row->id_conges,
        'title'           => $row->raison,
        'start'           => $row->date_debut,
        'end'             => $row->date_fin
    ];
}

echo json_encode($data);

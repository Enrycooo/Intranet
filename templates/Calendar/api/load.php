<?php
include('db.php');

$result = $conn->prepare("SELECT id_conges, date_debut, date_fin, E.nom AS nom
                        FROM conges C INNER JOIN employe E ON C.id_employe = E.id_employe");
$result->execute();
$res = $result->fetchALL(PDO::FETCH_OBJ);

$data = [];
foreach($res as $row) {
    $data[] = [
        'id'              => $row->id_conges,
        'title'           => $row->nom,
        'start'           => $row->date_debut,
        'end'             => $row->date_fin
    ];
}

echo json_encode($data);

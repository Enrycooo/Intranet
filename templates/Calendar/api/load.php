<?php
try {
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "intranet";

    // connect to DB
    $conn = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
}
catch (PDOException $e) {
    //throw $th;
}

$result = $conn->query("SELECT id_conges, date_debut, date_fin, R.libelle AS raison
                    FROM conges C INNER JOIN raison R ON C.id_raison=R.id_raison");
$data = [];
foreach($result as $row) {
    $data[] = [
        'id'              => $row->id_conge,
        'title'           => $row->commentaire,
        'start'           => $row->date_debut,
        'end'             => $row->date_fin
    ];
}

echo json_encode($data);

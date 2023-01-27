<?php
include('db.php');
//J'ai du refaire une connexion à la BDD et des requêtes spéciales pour le calendrier
//car j'avais des problèmes de lien entre les fichiers et de variable non défini.
$result = $conn->prepare("SELECT id_conges, date_debut, date_fin, E.nom AS nom, E.prenom AS prenom
                        FROM conges C INNER JOIN employe E ON C.id_employe = E.id_employe");
$result->execute();
$res = $result->fetchALL(PDO::FETCH_OBJ);

$data = [];
foreach($res as $row) {
    $data[] = [
        'id'              => $row->id_conges,
        'title'           => $row->nom." ".$row->prenom,
        'start'           => $row->date_debut,
        'end'             => $row->date_fin
    ];
}

echo json_encode($data); //json_encode permet d'encoder l'array $data en json pour que fullcalendar puisse
//l'utiliser. Et le 'echo' est obligatoire

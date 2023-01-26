<?php
include('db.php');

$result = $conn->prepare("SELECT COUNT(id_conges) FROM conges WHERE id_etat = 2");
$result->execute();
$data = $result->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
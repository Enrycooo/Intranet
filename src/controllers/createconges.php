<?php

namespace Application\Controllers\CreateConges;

require_once('src/lib/database.php');
require_once('src/model/Conges.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Conges\Conges_model;

class CreateConges
{
    public function execute(?array $input, int $id_employe)
    {
        $id = $id_employe;
        
        if($input !== null){
            $date_debut = null;
            $date_fin = null;
            $id_raison = null;
            $duree = null;
            $commentaire = null;
            if (!empty($input['date_debut']) && !empty($input['date_fin']) && !empty($input['id_raison']) && !empty($input['duree']) && !empty($input['commentaire'])) {
                $id_employe = $_SESSION['id'];
                $id_raison = $input['id_raison'];
                $date_debut = $input['date_debut'];
                $date_fin = $input['date_fin'];
                $duree = $input['duree'];
                $commentaire = $input['commentaire'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }

            $congesModel = new Conges_model();
            $congesModel->connection = new DatabaseConnection();
            $success = $congesModel->createConge($id_employe, $id_raison, $date_debut, $date_fin, $duree, $commentaire);
            if (!$success) {
                throw new \Exception('Impossible d\'ajouter le conges !');
            } else {
                $id = $_SESSION['id'];
                header("Location: index.php?action=connected&id=$id");
            }
        }
        
        $raisonModel = new Conges_model();
        $raisonModel->connection = new DatabaseConnection();
        $raisons = $raisonModel->getRaisons();
        
        if($_SESSION['username'] !== ""){
        require('templates/Conges/createconges.php');
        }else{
            header("Location: index.php");
        }
    }
}

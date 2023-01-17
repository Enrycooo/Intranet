<?php

namespace Application\Controllers\CrudRaison;

require_once('src/lib/database.php');
require_once('src/model/raison.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Raison\Raison_model;

class CrudRaison
{
    public function execute(int $id_employe, ?array $input)
    {
        if($input !== null){
            $libelle = null;
            if (!empty($input['libelle'])){
                $libelle = $input['libelle'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $raison_model = new Raison_model();
            $raison_model->connection = new DatabaseConnection();
            $success = $raison_model->createRaison($libelle);
            if (!$success) {
                throw new \Exception('Impossible d\'ajouter l\'utilisateur !');
            } else {
            }
        }
        
        $id = $id_employe;
        
        $crudModel = new Raison_model();
        $crudModel->connection = new DatabaseConnection();
        $cruds = $crudModel->getRaisons();
        
        if($_SESSION['id'] !== ""){
            require('templates/Admin/crudraison.php');
        }else{
            header("Location: index.php");
        }
    }
    
    public function deleteRaison(int $id_employe,?array $input){
        $id = $id_employe;
        
        if($input !== null){
            $id_raison = null;
            if (!empty($input['id_raison'])){
                $id_raison = $input['id_raison'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $crudModel = new Raison_model();
            $crudModel->connection = new DatabaseConnection();
            $crudModel->deleteRaison($id_raison);
        
            if($_SESSION['id'] !== ""){
            }else{
                header("Location: index.php");
            }
        }
    }
}
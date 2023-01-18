<?php

namespace Application\Controllers\CrudManager;

require_once('src/lib/database.php');
require_once('src/model/manager.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Manager\Manager_Model;

class CrudManager
{
    
    public function CRUD(int $id_employe, ?array $input){
        
        $id = $id_employe;
        $action = $_REQUEST["action"];
        
        if ($action === 'create') {
            if($input !== null){
                $nom = null;
                $prenom = null;
                $email = null;
                if (!empty($input['nom']) && !empty($input['prenom']) && !empty($input['email'])){
                    $nom = $input['nom'];
                    $prenom = $input['prenom'];
                    $email = $input['email'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $manager_model = new Manager_Model();
                $manager_model->connection = new DatabaseConnection();
                $success = $manager_model->createManager($nom, $prenom, $email);
                if (!$success) {
                    throw new \Exception('Impossible d\'ajouter le manager !');
                } else {
                }
            }
        } else if ($action === 'update') {
            if($input !== null){
                $id_manager = null;
                $nom = null;
                $prenom = null;
                $email = null;
                if (!empty($input['nom']) && !empty($input['prenom']) && !empty($input['email'])){
                    $id_manager = $input['id_manager'];
                    $nom = $input['nom'];
                    $prenom = $input['prenom'];
                    $email = $input['email'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $manager_model = new Manager_Model();
                $manager_model->connection = new DatabaseConnection();
                $success = $manager_model->updateManager($id_manager, $nom, $prenom, $email);
            }
        } else if ($action === 'delete') {
            if($input !== null){
                $id_manager = null;
                if (!empty($input['id_manager'])){
                    $id_manager = $input['id_manager'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $manager_model = new Manager_Model();
                $manager_model->connection = new DatabaseConnection();
                $success = $manager_model->deleteManager($id_manager);
            }
        }
        
        $manager_model = new Manager_Model();
        $manager_model->connection = new DatabaseConnection();
        $cruds = $manager_model->getManagers();
        
        if($_SESSION['id'] !== ""){
            require('templates/Admin/crudmanager.php');
        }else{
            header("Location: index.php");
        }
    }
}
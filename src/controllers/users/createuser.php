<?php

namespace Application\Controllers\CreateUser;

require_once('src/lib/database.php');
require_once('src/model/Manager.php');
require_once('src/model/Poste.php');
require_once('src/model/User.php');
require_once('src/model/Service.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Manager\Manager_Model;
use Application\Model\Poste\Poste_Model;
use Application\Model\User\User_Model;
use Application\Model\Service\Service_model;

class CreateUser
{
    public function execute(?array $input, int $id_employe)
    {   
        $id = $id_employe;
        
        if($input !== null){
            $nom = null;
            $prenom = null;
            $username = null;
            $email = null;
            $password = null;
            $id_poste = null;
            $id_manager = null;
            if (!empty($input['nom']) && !empty($input['prenom']) && !empty($input['username']) && !empty($input['email']) && !empty($input['password']) && !empty($input['id_poste']) && !empty($input['id_manager']) && !empty($input['id_service'])) {
                $nom = $input['nom'];
                $prenom = $input['prenom'];
                $username = $input['username'];
                $email = $input['email'];
                $password = hash('sha512', $input['password']);
                $id_poste = $input['id_poste'];
                $id_manager = $input['id_manager'];
                $id_service = $input['id_service'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }

            $user_model = new User_Model();
            $user_model->connection = new DatabaseConnection();
            $success = $user_model->createUser($nom, $prenom, $username, $email, $password, $id_poste, $id_manager, $id_service);
            if (!$success) {
                throw new \Exception('Impossible d\'ajouter l\'utilisateur !');
            } else {
                $id = $_SESSION['id'];
                header("Location: index.php?action=connected&id=$id");
            }
        }
        
        $posteModel = new Poste_Model();
        $posteModel->connection = new DatabaseConnection();
        $postes = $posteModel->getPostes();
        
        $managerModel = new Manager_Model();
        $managerModel->connection = new DatabaseConnection();
        $managers = $managerModel->getManagers();
        
        $serviceModel = new Service_model();
        $serviceModel->connection = new DatabaseConnection();
        $services = $serviceModel->getServices();
        
        if($_SESSION['username'] !== ""){
        require('templates/Users/createuser.php');
        }else{
            header("Location: index.php");
        }
    }
}

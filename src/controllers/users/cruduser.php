<?php

namespace Application\Controllers\CrudUser;

require_once('src/lib/database.php');
require_once('src/model/User.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\User\User_Model;

class CrudUser
{
    
    public function CRUD(int $id_employe, ?array $input){
        
        $id = $id_employe;
        $action = $_REQUEST["action"];
        
        if ($action === 'create') {
            if($input !== null){
                $nom = null;
                $prenom = null;
                $username = null;
                $email = null;
                $password = null;
                $poste = null;
                $manager = null;
                $service = null;
                if (!empty($input['nom']) && !empty($input['prenom']) && !empty($input['username']) && !empty($input['email']) && !empty($input['password']) && !empty($input['poste']) && !empty($input['manager']) && !empty($input['service'])){
                    $nom = $input['nom'];
                    $prenom = $input['prenom'];
                    $username = $input['username'];
                    $email = $input['email'];
                    $password = $input['password'];
                    $poste = $input['poste'];
                    $manager = $input['manager'];
                    $service = $input['service'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $user_model = new User_Model();
                $user_model->connection = new DatabaseConnection();
                $success = $user_model->createUser($nom, $prenom, $username, $email, $password, $poste, $manager, $service);
                if (!$success) {
                    throw new \Exception('Impossible d\'ajouter l\'Utilisateur !');
                } else {
                }
            }
        } else if ($action === 'update') {
            if($input !== null){
                $nom = null;
                $prenom = null;
                $username = null;
                $email = null;
                $password = null;
                $poste = null;
                $manager = null;
                $service = null;
                if (!empty($input['nom']) && !empty($input['prenom']) && !empty($input['username']) && !empty($input['email']) && !empty($input['password']) && !empty($input['poste']) && !empty($input['manager']) && !empty($input['service'])){
                    $nom = $input['nom'];
                    $prenom = $input['prenom'];
                    $username = $input['username'];
                    $email = $input['email'];
                    $password = $input['password'];
                    $poste = $input['poste'];
                    $manager = $input['manager'];
                    $service = $input['service'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $user_model = new User_Model();
                $user_model->connection = new DatabaseConnection();
                $user_model->updateUser($id_employe, $nom, $prenom, $username, $email, $password, $poste, $manager, $service);
            }
        } else if ($action === 'delete') {
            if($input !== null){
                $id_employe = null;
                if (!empty($input['id_employe'])){
                    $id_employe = $input['id_employe'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $user_model = new User_Model();
                $user_model->connection = new DatabaseConnection();
                $user_model->deleteUser($id_employe);
            }
        }
        
        $user_model = new User_Model();
        $user_model->connection = new DatabaseConnection();
        $cruds = $user_model->getCrudUsers();
        
        if($_SESSION['id'] !== ""){
            require('templates/Users/index.php');
        }else{
            header("Location: index.php");
        }
    }
}
/*
namespace Application\Controllers\CrudUsers;

require_once('src/lib/database.php');
require_once('src/model/user.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\User\User_Model;

class CrudUsers
{
    public function execute(int $id_employe)
    {
        $id = $id_employe;
        
        $crudModel = new User_Model();
        $crudModel->connection = new DatabaseConnection();
        $cruds = $crudModel->getCrudUsers();
        
        if($_SESSION['id'] !== ""){
            require('templates/Users/index.php');
        }else{
            header("Location: index.php");
        }
    }
}
*/
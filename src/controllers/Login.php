<?php

namespace Application\Controllers\Login;

require_once('src/lib/database.php');
require_once('src/model/User.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\User\User_Model;

class Login{
	
	public function execute(array $input)
	{
                $username = null;
                $password = null;
                if (!empty($input['username']) && !empty($input['password'])) {
                    $username = $input['username'];
                    $password = hash('sha512',$input['password']);
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $userModel = new User_Model();
                $userModel->connection = new DatabaseConnection();
                $users = $userModel->getUser($username,$password);
                
                if($users) // nom d'utilisateur et mot de passe correctes
                {
                        $_SESSION['username'] = $username;
                        $_SESSION['id'] = $users->id_employe;
                        $_SESSION['id_poste'] = $users->id_poste;
                        $id = $_SESSION['id'];
                        $poste = $_SESSION['id_poste'];
                        header("Location: index.php?action=connected&id=$id");
                }else{
                    throw new \Exception('Votre compte est désactivée ou alors le nom d\'utilisateur et/ou le mot de passe sont incorrectes !');
                }
	}
	
	
	/* logging out the user */
	public function logout()
	{
                session_destroy();
		header('location: index.php');
		exit;
	}
}
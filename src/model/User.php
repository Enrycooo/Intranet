<?php
namespace Application\Model\User;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class User
{
    public int $id_employe;
    public string $nom;
    public string $prenom;
    public string $username;
    public string $email;
    public string $password;
    public int $id_poste;
    public int $id_manager;
}

class CRUD
{
    public int $id_employe;
    public string $nom;
    public string $prenom;
    public string $username;
    public string $email;
    public string $poste;
    public string $nomM;
    public string $prenomM;  
    public string $service;
}

class User_Model
{
        public DatabaseConnection $connection;
        
	public function createUser(string $nom, string $prenom, string $username, string $email, string $password, int $id_poste, int $id_manager)
	{
                $stmt = $this->connection->getConnection()->prepare(
                'INSERT INTO employe(nom, prenom, username, email, password, actif, id_poste, id_manager)
                VALUES(:nom, :prenom, :username, :email, :password, 1, :id_poste, :id_manager)'
                );
                $stmt->bindValue(':nom', $nom);
                $stmt->bindValue(':prenom', $prenom);
                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':password', $password);
                $stmt->bindValue(':id_poste', $id_poste);
                $stmt->bindValue(':id_manager', $id_manager);
                $affectedLines = $stmt->execute();

                return ($affectedLines > 0);
	}
        
        public function getUser(string $username, string $password){
            
                $res= $this->connection->getConnection()->prepare("SELECT * FROM employe WHERE username = :username AND password = :password");
                $res->bindValue(':username',$username);
                $res->bindValue(':password',$password);
                $res->execute();
                
                
                $row = $res->fetch();
                
                if ($row === false) {
                    return null;
                }
                
                $user = new User();
                $user->nom = $row['nom'];
                $user->prenom = $row['prenom'];
                $user->username = $row['username'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->id_poste = $row['id_poste'];
                $user->id_manager = $row['id_manager'];
                $user->id_employe = $row['id_employe'];

                return $user;
        }
        
        public function getUsers(){
            
                $stmt= $this->connection->getConnection()->query("SELECT * FROM employe");
                
                $users = [];
                while (($row = $stmt->fetch())) {
                    $user = new User();
                    $user->nom = $row['nom'];
                    $user->prenom = $row['prenom'];
                    $user->username = $row['username'];
                    $user->email = $row['email'];
                    $user->password = $row['password'];
                    $user->id_poste = $row['id_poste'];
                    $user->id_manager = $row['id_manager'];
                    $user->id_employe = $row['id_employe'];

                    $users[] = $user;
                }

                return $users;
        }
        
        public function getCrudUsers(){
                    $stmt= $this->connection->getConnection()->query("
                    SELECT id_employe, E.nom, E.prenom, username, E.email, P.libelle AS poste, M.nom AS nomM, M.prenom AS prenomM, S.libelle AS service
                    FROM employe E 
                    INNER JOIN poste P ON E.id_poste = P.id_poste
                    INNER JOIN manager M ON E.id_manager = M.id_manager
                    INNER JOIN service S ON E.id_service = S.id_service
                    WHERE actif = 1;
                    ");
                
                $cruds = [];
                while (($row = $stmt->fetch())) {
                    $crud = new Crud();
                    $crud->id_employe = $row['id_employe'];
                    $crud->nom = $row['nom'];
                    $crud->prenom = $row['prenom'];
                    $crud->username = $row['username'];
                    $crud->email = $row['email'];
                    $crud->poste = $row['poste'];
                    $crud->nomM = $row['nomM'];
                    $crud->prenomM = $row['prenomM'];
                    $crud->service = $row['service'];
                    
                    $cruds[] = $crud;
                }
                
                return $cruds;
        }
		
}

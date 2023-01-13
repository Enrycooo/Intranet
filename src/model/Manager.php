<?php
namespace Application\Model\Manager;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Manager
{
    public int $id_manager;
    public string $nom;
    public string $prenom;
}

class Manager_Model
{
        public DatabaseConnection $connection;
        
	public function createManager(string $nom, string $prenom, string $email)
	{
                $stmt = $this->connection->getConnection()->prepare(
                'INSERT INTO manager(nom, prenom, email)
                VALUES(:nom, :prenom, :email)'
                );
                $stmt->bindValue(':nom', $nom);
                $stmt->bindValue(':prenom', $prenom);
                $stmt->bindValue(':email', $email);
                $affectedLines = $stmt->execute();

                return ($affectedLines > 0);
	}
        
        public function getManagers(): array {
            
                $stmt= $this->connection->getConnection()->query("SELECT id_manager, nom, prenom FROM manager");
                
                $managers = [];
                while (($row = $stmt->fetch())) {
                    $manager = new Manager();
                    $manager->id_manager = $row['id_manager'];
                    $manager->nom = $row['nom'];
                    $manager->prenom = $row['prenom'];

                    $managers[] = $manager;
                }

                return $managers;
        }
        
        public function getManager(int $id_manager){
            $stmt = $this->connection->getConnection()->prepare("SELECT * FROM manager WHERE id_manager = :id_manager");
            $stmt->bindValue(':id_manager', $id_manager);
            $stmt->execute();
            
            $row = $stmt->fetch();
            $manager = new Manager();
            $manager->id_manager = $row['id_manager'];
            $manager->nom = $row['nom'];
            $manager->prenom = $row['prenom'];
            $manager->email = $row['email'];
            
            return $manager;
        }
		
}